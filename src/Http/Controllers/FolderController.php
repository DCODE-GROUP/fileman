<?php

namespace DcodeGroup\Fileman\Http\Controllers;

use DcodeGroup\Fileman\Http\Requests\FolderRequest;
use DcodeGroup\Fileman\Http\Resources\List\FileCollection;
use DcodeGroup\Fileman\Http\Resources\List\FolderCollection;
use DcodeGroup\Fileman\Models\Folder;
use DcodeGroup\Fileman\Services\FolderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class FolderController extends BaseController
{
    public function index(?Folder $folder = null): View
    {
        if (! $folder) {
            $folder = Folder::getRoot();
        }

        $folder->loadMissing(['files.folder', 'children']);

        return view('fileman::index')
            ->with([
                'folder' => $folder,
                'directory' => FolderService::getDirectoryStructure($folder),
                'path' => $folder->getPath(),
                'files' => (new FileCollection($folder->files))->toArray(request()),
                'folders' => (new FolderCollection($folder->children))->toArray(request()),
            ]);
    }

    public function create(Folder $parent): View
    {
        return view('fileman::folder.edit')
            ->with([
                'directory' => FolderService::getDirectoryStructure($parent),
                'path' => $parent->getPath(),
                'method' => 'post',
                'action' => route('fileman.folder.store', $parent),
                'parent' => $parent,
            ]);
    }

    public function store(FolderRequest $request, Folder $parent): RedirectResponse
    {
        return redirect()
            ->route('fileman.folder.index', Folder::create([
                'name' => $request->name,
                'parent_id' => $parent->id,
            ]));
    }
}
