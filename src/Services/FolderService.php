<?php

namespace DcodeGroup\FileMan\Services;

use DcodeGroup\FileMan\Models\File;
use DcodeGroup\FileMan\Models\Folder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class FolderService
{
    /**
     * @param  null  $path
     * @return |null
     */
    public static function getFolder($path = null)
    {
        if (!$path) {
            return Folder::whereNull('parent_id')->first();
        }

        $folder = null;
        $folderNames = explode('/', $path);

        if (count($folderNames) > 0) {
            $folder = Folder::where('name', 'LIKE', '%'.$folderNames[0].'%')->first();

            foreach ($folderNames as $index => $folderName) {
                if ($index !== 0) {
                    $folder = $folder->getChild($folderName);
                }
            }
        }

        return $folder;
    }

    public static function getDirectoryStructure(Collection $folders, $parent_id = null)
    {
        $tree = [];
        foreach ($folders as $index => $folder) {
            if ($folder->parent_id === $parent_id) {
                $folders->pull($index);
                $tree[] = [
                    'name' => $folder->name,
                    'url' => route('fileman.folder.index', $folder->id),
                    'children' => self::getDirectoryStructure($folders, $folder->id),
                ];
            }
        }
        return $tree;
    }

    /**
     * @param  Folder|null  $folder
     * @param  array  $saveData
     * @return Folder
     */
    public static function save(Folder $folder = null, $saveData = [])
    {
        if (!$folder) {
            $folder = Folder::firstOrNew([
                'parent_id' => $saveData['parent_id'],
                'name' => $saveData['name'],
            ]);
        }

        $folder->name = $saveData['name'];
        $folder->save();

        return $folder;
    }

    /**
     * @return bool
     */
    public static function sync()
    {
        $folderPaths = Storage::disk('s3')->allDirectories();

        $root = Folder::firstOrCreate([
            'parent_id' => null,
            'name' => '_root',
        ]);

        foreach ($folderPaths as $folderPath) {
            $folderNames = explode('/', $folderPath);

            $folder = Folder::firstOrCreate([
                'parent_id' => $root->id,
                'name' => $folderNames[0],
            ]);

            foreach ($folderNames as $index => $folderName) {
                if ($index !== 0) {
                    $folder = Folder::firstOrCreate([
                        'parent_id' => $folder->id,
                        'name' => $folderName,
                    ]);
                }

                $filePaths = Storage::disk('s3')->files($folderPath);

                foreach ($filePaths as $filePath) {
                    $file = File::firstOrNew([
                        'folder_id' => $folder->id,
                        'name' => substr($filePath, strrpos($filePath, '/') + 1),
                    ]);
                    $file->source = $filePath;
                    $file->size = Storage::disk('s3')->size($filePath);
                    $file->type = substr($filePath, strpos($filePath, '.') + 1);
                    $file->save();
                }
            }
        }

        return true;
    }
}
