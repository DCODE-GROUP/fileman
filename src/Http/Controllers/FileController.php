<?php

namespace DcodeGroup\FileMan\Http\Controllers;

use DcodeGroup\FileMan\Http\Requests\FileRequest;
use DcodeGroup\FileMan\Models\File;
use DcodeGroup\FileMan\Models\Folder;
use DcodeGroup\FileMan\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class FileController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('file-man::file.edit')
            ->with('parent', Folder::find(request('parent')));
    }

    /**
     * @param  FileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FileRequest $request)
    {
        FileService::save(null, $request->all());
        $path = Folder::find(request('folder_id'))->path;

        return redirect()
            ->route('file-man.folder.index')
            ->with(['path' => $path]);
    }

    /**
     * @param  File  $file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(File $file)
    {
        return view('file-man::file.edit')
            ->with('parent', Folder::find(request('parent')))
            ->with('file', $file);
    }

    /**
     * @param  FileRequest  $request
     * @param  File  $file
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FileRequest $request, File $file)
    {
        FileService::save($file, $request->all());
        $path = Folder::find(request('folder_id'))->path;

        return redirect()
            ->route('file-man.folder.index', ['path' => $path]);
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
            ->route('file-man::file.index');
    }
}
