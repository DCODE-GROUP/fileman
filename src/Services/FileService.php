<?php

namespace DcodeGroup\Fileman\Services;

use DcodeGroup\Fileman\Models\File;
use DcodeGroup\Fileman\Models\Folder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function newFile(Folder $parent, UploadedFile $file, String $name = null)
    {
        $path = 'fileman';
        $name = $name ?: $file->getClientOriginalName();
        $filename = uniqid().'-' . str_replace(' ', '_', $name);
        if(count($parent->getPath()) > 1){
            $path = $path.'/'.$parent->getFolderPath();
        }
        $source = FileService::getDisk()->putFileAs($path, $file, $filename);
        return File::updateOrCreate([
            'folder_id' => $parent->id,
            'name' => $name,
        ], [
            'source' => $source,
            'type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);
    }

    public static function newFileFromS3(Folder $parent, Array $metaData)
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

    public static function getDisk() : \Illuminate\Contracts\Filesystem\Filesystem
    {
        return Storage::disk(env('FILESYSTEM_DISK', 'local'));
    }

    public static function countFolder(?Folder $folder = null) : int{
        return File::query()
            ->when($folder, function($query) use ($folder){
                return $query->where('folder_id', $folder->id);
            })
            ->count();
    }

    public static function countAllFiles() : int
    {
        return self::countFolder(null);
    }


}
