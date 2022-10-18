<?php

namespace DcodeGroup\Fileman\Http\Controllers;

use DcodeGroup\Fileman\Http\Requests\FileRequest;
use DcodeGroup\Fileman\Models\File;
use DcodeGroup\Fileman\Models\Folder;
use DcodeGroup\Fileman\Services\FileService;
use DcodeGroup\Fileman\Services\FolderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class FileController extends BaseController
{
    public function show(Folder $parent, File $file): View
    {
          return view('fileman::file.show')
            ->with([
                'file' => $file,
                'parent' => $parent,
                'directory' => FolderService::getDirectoryStructure(),
                'path' => $parent->getPath(),
            ]);
    }

    public function create(Folder $parent): View
    {
        return view('fileman::file.edit')
            ->with([
                'parent' => $parent,
                'directory' => FolderService::getDirectoryStructure(),
                'path' =>  $parent->getPath(),
                'action' => route('fileman.file.store', $parent->id),
                'method' => 'post',
            ]);
    }

    public function store(FileRequest $request, Folder $parent): RedirectResponse
    {
        FileService::newFile(
            $parent,
            $request->file('file'),
            $request->input('name')
        );

        return redirect()
            ->route('fileman.folder.index', $parent->id);
    }

    public function edit(Folder $parent, File $file): View
    {
        return view('fileman::file.edit')
            ->with([
                'file' => $file,
                'parent' => $parent,
                'directory' =>  FolderService::getDirectoryStructure(),
                'path' =>  $parent->getPath(),
                'action' => route('fileman.file.update', [$parent->id, $file->id]),
                'method' => 'put',
            ]);
    }

    public function update(Folder $parent, File $file): RedirectResponse
    {
        $file->rename(request()->input('name'));

        return redirect()
            ->route('fileman.folder.index', $parent->id);
    }

    public function destroy(Folder $parent, File $file): RedirectResponse
    {
        $file->delete();

        return redirect()
            ->route('fileman.folder.index', $parent->id);
    }
}
