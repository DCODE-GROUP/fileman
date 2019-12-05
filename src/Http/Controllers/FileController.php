<?php

namespace DcodeGroup\Fileman\Http\Controllers;

use DcodeGroup\Fileman\Http\Requests\FileRequest;
use DcodeGroup\Fileman\Models\File;
use DcodeGroup\Fileman\Models\Folder;
use DcodeGroup\Fileman\Services\FileService;
use DcodeGroup\Fileman\Services\FolderService;
use Illuminate\Routing\Controller as BaseController;

class FileController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Folder $parent)
    {
        $method = 'post';
        $action = route('fileman.file.store', $parent);
        $directory = FolderService::getDirectoryStructure(Folder::with('children')->get())[0];
        $path = $parent->getPath();

        return view('fileman::file.edit')
            ->with([
                'directory' => $directory,
                'path' => $path,
                'parent' => $parent,
                'action' => $action,
                'method' => $method,
            ]);
    }

    /**
     * @param  FileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FileRequest $request)
    {
        $path = Folder::find(request()->input('folder_id'))->path;

        FileService::save(null, $request->all());

        return redirect()
            ->route('fileman.folder.index')
            ->with([
                'path' => $path,
            ]);
    }
}
