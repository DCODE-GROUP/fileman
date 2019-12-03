<?php

namespace DcodeGroup\FileMan\Http\Controllers;

use DcodeGroup\FileMan\Http\Requests\FileRequest;
use DcodeGroup\FileMan\Models\File;
use DcodeGroup\FileMan\Models\Folder;
use DcodeGroup\FileMan\Services\FileService;
use Illuminate\Routing\Controller as BaseController;

class FileController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $method = 'post';
        $action = route('fileman.file.store');
        $folder = Folder::find(request()->query('folder'));

        return view('fileman::file.edit')
            ->with([
                'action' => $action,
                'method' => $method,
                'folder' => $folder,
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

    /**
     * @param  File  $file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(File $file)
    {
        $method = 'put';
        $action = route('fileman.file.update', $file->id);
        $folder = Folder::find(request()->query('folder'));

        return view('fileman::file.edit')
            ->with([
                'action' => $action,
                'method' => $method,
                'folder' =>  $folder,
                'file' =>  $file,
            ]);

    }

    /**
     * @param  FileRequest  $request
     * @param  File  $file
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FileRequest $request, File $file)
    {
        $path = Folder::find(request()->input('folder_id'))->path;

        FileService::save($file, $request->all());

        return redirect()
            ->route('fileman.folder.index')
            ->with([
                'path' => $path,
            ]);
    }

    /**
     * @param  File  $file
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(File $file)
    {
        $file->delete();

        return redirect()
            ->route('fileman::file.index');
    }
}
