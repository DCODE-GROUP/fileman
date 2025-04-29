<?php

namespace DcodeGroup\Fileman\Services;

use DcodeGroup\Fileman\Models\Folder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FilemanService
{
    public static function import($parentFolder=null,$folderName = null): void
    {
        $folderPaths = FileService::getDisk()->directories($folderName ?? '');
        if($parentFolder == null){
            $parent =  Folder::firstOrCreate([
                'parent_id' => null,
            ],[
                'parent_id' => null,
                'name' => 'Root',
            ]);
        }else{
            $parent = $parentFolder;
        }
        foreach ($folderPaths as $folderPath) {
            $folderNames = explode('/', $folderPath);
            $folder = Folder::firstOrCreate([
                'parent_id' => $parent->id,
                'name' => $folderNames[count($folderNames) - 1],
            ]);
            self::import($folder,$folderPath);
        }
        $filePaths = FileService::getDisk()->files($folderName?? '');
        foreach ($filePaths as $filePath) {
            // @phpstan-ignore-next-line
            FileService::newFileFromS3($parent, [
                'filename' => basename($filePath),
                'path' => $filePath,
                'mimetype' => Storage::disk('s3')->mimeType($filePath),
                'size' => Storage::disk('s3')->size($filePath),
            ]);
        }
    }
}
