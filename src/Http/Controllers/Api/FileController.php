<?php

namespace DcodeGroup\Fileman\Http\Controllers\Api;

use DcodeGroup\Fileman\Http\Requests\UpdateFileRequest;
use DcodeGroup\Fileman\Models\File;
use DcodeGroup\Fileman\Models\Folder;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;

class FileController extends BaseController
{
    public function update(UpdateFileRequest $request, Folder $parent, File $file): JsonResource
    {
        $file->rename($request->name);

        return new JsonResource([
            'success' => true,
            'redirect' => route('fileman.folder.index', $parent->id),
        ]);

    }

    public function destroy(Folder $parent, File $file): JsonResource
    {
        $file->delete();

        return new JsonResource([
            'success' => true,
            'redirect' => route('fileman.folder.index', $parent->id),
        ]);

    }
}
