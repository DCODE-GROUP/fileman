<?php

namespace DcodeGroup\Fileman\Services;

use DcodeGroup\Fileman\Models\File;
use DcodeGroup\Fileman\Models\Folder;
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
            $file = new File();
        }

        $name = isset($saveData['name']) ? $saveData['name'] : $saveData['file']->getClientOriginalName();

        $path = 'fileman';
        $filename = uniqid().'-'.$name;
        $source = Storage::disk('s3')->putFileAs($path, $saveData['file'], $filename);

        $file->source = $source;
        $file->name = $name;
        $file->folder_id = $saveData['folder_id'];
        $file->type = $saveData['file']->getMimeType();
        $file->size = $saveData['file']->getSize();
        $file->save();

        return $file;
    }
}
