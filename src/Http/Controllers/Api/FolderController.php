<?php

namespace DcodeGroup\Fileman\Http\Controllers\Api;

use DcodeGroup\Fileman\Http\Requests\FolderRequest;
use DcodeGroup\Fileman\Models\Folder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;

class FolderController extends BaseController
{
    public function store(FolderRequest $request, Folder $parent): JsonResource
    {
        return new JsonResource([
            'success' => true,
            'redirect' => route('fileman.folder.index', Folder::create([
                'name' => $request->input('name'),
                'parent_id' => $parent->id,
            ])),
        ]);
    }

    public function update(FolderRequest $request, Folder $folder): JsonResource
    {
        $folder->update($request->validated());

        return new JsonResource([
            'success' => true,
            'redirect' => route('fileman.folder.index', $folder->id),
        ]);
    }

    public function destroy(Folder $folder): JsonResource|JsonResponse
    {
        if ($folder->isRoot()) {
            // return 403
            return response()->json([
                'success' => false,
                'message' => __('Cannot delete root folder'),
            ], 403);
        }

        $folder->delete();

        return new JsonResource([
            'success' => true,
            'redirect' => route('fileman.folder.index', $folder->parent_id),
        ]);
    }
}
