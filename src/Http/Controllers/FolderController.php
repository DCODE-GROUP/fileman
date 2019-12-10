<?php

namespace DcodeGroup\Fileman\Http\Controllers;

use DcodeGroup\Fileman\Http\Requests\FolderRequest;
use DcodeGroup\Fileman\Models\Folder;
use DcodeGroup\Fileman\Services\FolderService;
use Illuminate\Routing\Controller as BaseController;

class FolderController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Folder $folder = null)
    {
        if (!$folder) {
            $folder = Folder::getRoot();
        }

        $directory = FolderService::getDirectoryStructure();
        $path = $folder->getPath();
        $files = $folder->files;

        return view('fileman::index')
            ->with([
                'folder' => $folder,
                'directory' => $directory,
                'path' => $path,
                'files' => $files
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Folder $parent)
    {
        $method = 'post';
        $action = route('fileman.folder.store', $parent);
        $directory = FolderService::getDirectoryStructure();
        $path = $parent->getPath();

        return view('fileman::folder.edit')
            ->with([
                'directory' => $directory,
                'path' => $path,
                'method' => $method,
                'action' => $action,
                'parent' => $parent,
            ]);
    }

    /**
     * @param  FolderRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FolderRequest $request, Folder $parent)
    {
        $folder = Folder::create([
            'name' => request()->input('name'),
            'parent_id' => $parent->id,
        ]);

        return redirect()
            ->route('fileman.folder.index', $folder);
    }
}
