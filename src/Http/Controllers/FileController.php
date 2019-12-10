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
    public function show(Folder $parent, File $file)
    {
        $directory = FolderService::getDirectoryStructure();
        $path = $parent->getPath();

        return view('fileman::file.show')
            ->with([
                'file' => $file,
                'parent' => $parent,
                'directory' => $directory,
                'path' => $path,
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Folder $parent)
    {
        $method = 'post';
        $action = route('fileman.file.store', $parent->id);
        $directory = FolderService::getDirectoryStructure();
        $path = $parent->getPath();

        return view('fileman::file.edit')
            ->with([
                'parent' => $parent,
                'directory' => $directory,
                'path' => $path,
                'action' => $action,
                'method' => $method,
            ]);
    }

    /**
     * @param  FileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FileRequest $request, Folder $parent)
    {
        FileService::newFile(
            $parent,
            request()->file('file'),
            request()->input('name')
        );

        return redirect()
            ->route('fileman.folder.index', $parent->id);
    }

    public function edit(Folder $parent, File $file)
    {
        $method = 'put';
        $action = route('fileman.file.update', [$parent->id, $file->id]);
        $directory = FolderService::getDirectoryStructure();
        $path = $parent->getPath();

        return view('fileman::file.edit')
            ->with([
                'file' => $file,
                'parent' => $parent,
                'directory' => $directory,
                'path' => $path,
                'action' => $action,
                'method' => $method,
            ]);
    }

    public function update(Folder $parent, File $file)
    {
        $file->rename(request()->input('name'));

        return redirect()
            ->route('fileman.folder.index', $parent->id);
    }

    public function destroy(Folder $parent, File $file)
    {
        $file->delete();

        return redirect()
            ->route('fileman.folder.index', $parent->id);
    }
}
