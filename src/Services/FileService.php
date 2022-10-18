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
        $filename = uniqid().'-'.$name;
        $source = Storage::disk('s3')->putFileAs($path, $file, $filename);

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
}
