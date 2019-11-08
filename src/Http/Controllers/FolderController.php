<?php

namespace DcodeGroup\FileMan\Http\Controllers;

use DcodeGroup\FileMan\Http\Requests\FolderRequest;
use DcodeGroup\FileMan\Models\Folder;
use DcodeGroup\FileMan\Services\FolderService;
use Illuminate\Routing\Controller as BaseController;

class FolderController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $folder = FolderService::getFolder(request('path'));
        $path = request('path') ?? '_root';

        return view('file-man::folder')
            ->with('path', $path)
            ->with('folder', $folder);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('file-man::folder.edit')
            ->with('parent', Folder::find(request('parent')));
    }

    /**
     * @param  FolderRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FolderRequest $request)
    {
        FolderService::save(null, $request->all());

        $path = Folder::find(request('parent_id'))->path;

        return redirect()
            ->route('file-man.folder.index', ['path' => $path])
            ->with('flashNotice', 'Folder saved.');
    }

    /**
     * @param  Folder  $folder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Folder $folder)
    {
        return view('file-man::folder.edit')
            ->with('parent', Folder::find(request('parent')))
            ->with('record', $folder);
    }

    /**
     * @param  FolderRequest  $request
     * @param  Folder  $folder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FolderRequest $request, Folder $folder)
    {
        FolderService::save($folder, $request->all());
        $path = Folder::find(request('parent_id'))->path;

        return redirect()
            ->route('file-man.folder.index', ['path' => $path])
            ->with('flashNotice', 'Folder saved.');
    }

    /**
     * @param  Folder  $folder
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Folder $folder)
    {
        $folder->delete();
        $path = Folder::find(request('parent_id'))->path;

        return redirect()
            ->route('file-man.folder.index', ['path' => $path])
            ->with('flashNotice', 'Folder deleted.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sync()
    {
        FolderService::sync();

        return redirect()
            ->route('file-man.folder.index', ['path' => ''])
            ->with('flashNotice', 'Folders synced.');
    }
}
