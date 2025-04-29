<?php

namespace DcodeGroup\Fileman\Services;

use DcodeGroup\Fileman\Models\File;
use DcodeGroup\Fileman\Models\Folder;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function newFile(Folder $parent, UploadedFile $file, ?string $name = null)
    {
        $path = 'fileman';
        $name = $name ?: $file->getClientOriginalName();
        $filename = self::getSeoFriendlyName($name, $parent);

        if (count($parent->getPath()) > 1) {
            $path = $path.'/'.$parent->getFolderPath();
        }
        $source = FileService::getDisk()->putFileAs($path, $file, $filename);

        return File::updateOrCreate([
            'folder_id' => $parent->id,
            'name' => $filename,
        ], [
            'source' => $source,
            'type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);
    }

    public static function newFileFromS3(Folder $parent, array $metaData)
    {
        File::updateOrCreate([
            'folder_id' => $parent->id,
            'name' => $metaData['filename'],
        ], [
            'source' => $metaData['path'],
            'type' => $metaData['mimetype'],
            'size' => $metaData['size'],
        ]);
    }

    public static function getDisk(): Filesystem
    {
        return Storage::disk(config('filesystems.default'));
    }

    public static function countFolder(?Folder $folder = null): int
    {
        return File::query()
            ->when($folder, function ($query) use ($folder) {
                return $query->where('folder_id', $folder->id);
            })
            ->count();
    }

    public static function countAllFiles(): int
    {
        return self::countFolder(null);
    }

    public function isValidFileNames($fileName): bool
    {
        // Check for null, empty, or whitespace-only strings
        if (empty($fileName) || strlen(trim($fileName)) === 0) {
            return false;
        }

        // Trim whitespace and check the length
        $trimmedName = trim($fileName);
        if (strlen($trimmedName) > config('fileman.maxFileNameLength')) {
            return false;
        }

        // Check for invalid characters
        if (preg_match(config('fileman.validCharacters'), $trimmedName)) {
            return false;
        }

        // Check for reserved names (case-insensitive)
        if (in_array(strtoupper($trimmedName), config('fileman.reservedNames'))) {
            return false;
        }

        // Check if the file has a valid extension (optional)
        $extension = strtolower(pathinfo($trimmedName, PATHINFO_EXTENSION)); // Extracts the extension
        if (! empty($extension) && ! in_array($extension, config('fileman.validExtensions'))) {
            return false;
        }

        return true;
    }

    public function isValidFileTypes($fileType): bool
    {
        return ! in_array($fileType, config('fileman.restrictedFileFormats'));
    }

    public function searchFiles($search, $folderId, bool $current = false): Collection
    {
        return File::query()->with('folder')
            ->when($current, function ($query) use ($folderId, $search) {
                return $query->where('folder_id', $folderId)
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    })
                    ->take(config('fileman.searchLimit.current'));
            })
            ->when(! $current, function ($query) use ($folderId, $search) {
                return $query->where('folder_id', '!=', $folderId)
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    })
                    ->take(config('fileman.searchLimit.other'));
            })
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public static function getSeoFriendlyName($fileName, Folder $folder): string
    {
        // extension
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        // Sanitize and make the file name SEO-friendly
        $name = preg_replace('/[^a-zA-Z0-9\s\-]/', '', pathinfo($fileName, PATHINFO_FILENAME)); // Remove special characters
        $name = strtolower(trim($name)); // Convert to lowercase and trim whitespace
        $name = preg_replace('/\s+/', '-', $name); // Replace spaces with hyphens
        $name = preg_replace('/-+/', '-', $name); // Remove duplicate hyphens

        return self::getUniqueName($name, $folder, $extension);
    }

    public static function getUniqueName($name, $folder, $extension): string
    {
        if (File::query()->where('folder_id', $folder->id)
            ->where('name', $name.'.'.$extension)->exists()) {
            return self::getUniqueName($name.'_copy', $folder, $extension);
        }

        return $name.'.'.$extension;
    }
}
