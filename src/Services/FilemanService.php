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
    public static function import()
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
                    FileService::newFileFromS3($folder, Storage::getMetaData($filePath));
                }
            }
        }
    }
}
