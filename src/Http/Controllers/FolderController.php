<?php

namespace DcodeGroup\Fileman\Http\Controllers;

use DcodeGroup\Fileman\Http\Requests\FolderRequest;
use DcodeGroup\Fileman\Models\Folder;
use DcodeGroup\Fileman\Services\FolderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class FolderController extends BaseController
{
    public function index(Folder $folder = null): View
    {
        if (!$folder) {
            $folder = Folder::getRoot();
        }

        return view('fileman::index')
            ->with([
                'folder' => $folder,
                'directory' => FolderService::getDirectoryStructure(),
                'path' =>  $folder->getPath(),
                'files' => $folder->files
            ]);
    }

    public function create(Folder $parent): View
    {
        return view('fileman::folder.edit')
            ->with([
                'directory' => FolderService::getDirectoryStructure(),
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
                'name' => request()->input('name'),
                'parent_id' => $parent->id,
            ]));
    }
}
