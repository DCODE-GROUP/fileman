<?php

namespace DcodeGroup\Fileman\Services;

use DcodeGroup\Fileman\Models\File;
use DcodeGroup\Fileman\Models\Folder;
use Illuminate\Support\Facades\Storage;

class FilemanService
{
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
    }
}
