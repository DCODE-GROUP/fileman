<?php

namespace DcodeGroup\FileMan\Services;

use DcodeGroup\FileMan\Models\File;
use DcodeGroup\FileMan\Models\Folder;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * @param  File|null  $file
     * @param  array  $saveData
     * @return File
     */
    public static function save(File $file = null, $saveData = [])
    {
        if (!$file) {
            $file = File::firstOrNew([
                'folder_id' => $saveData['folder_id'],
                'name' => $saveData['name'],
            ]);
        }

        $folder = Folder::find(request('folder_id'));

        $fileData = Storage::disk('s3')->put($folder->realPath.'/'.$saveData['name'], $saveData['file']);

        $file->name = $saveData['name'];
        $file->source = $fileData;
        $file->type = $saveData['file']->getMimeType();
        $file->size = $saveData['file']->getSize();
        $file->save();

        return $file;
    }
}
