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

        return view('fileman::index')
            ->with([
                'path' => $path,
                'folder' => $folder,
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $method = 'post';
        $action = route('fileman.folder.store');
        $parent = Folder::find(request()->query('folder'));

        return view('fileman::folder.edit')
            ->with([
                'method' => $method,
                'action' => $action,
                'parent' => $parent,
            ]);
    }

    /**
     * @param  FolderRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FolderRequest $request)
    {
        $path = Folder::find(request()->input('parent_id'))->path;

        FolderService::save(null, $request->all());

        return redirect()
            ->route('fileman.folder.index')
            ->with([
                'path' => $path,
            ]);
    }

    /**
     * @param  Folder  $folder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Folder $folder)
    {
        $method = 'put';
        $action = route('fileman.folder.update', $folder->id);
        $parent = Folder::find(request()->query('folder'));

        return view('fileman::folder.edit')
            ->with([
                'method' => $method,
                'action' => $action,
                'parent' => $parent,
                'folder' => $folder,
            ]);
    }

    /**
     * @param  FolderRequest  $request
     * @param  Folder  $folder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FolderRequest $request, Folder $folder)
    {
        $path = Folder::find(request()->input('parent_id'))->path;

        FolderService::save($folder, $request->all());

        return redirect()
            ->route('fileman.folder.index')
            ->with([
                'path' => $path,
            ]);
    }

    /**
     * @param  Folder  $folder
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Folder $folder)
    {
        $path = Folder::find(request()->input('parent_id'))->path;

        $folder->delete();

        return redirect()
            ->route('fileman.folder.index')
            ->with([
                'path' => $path,
            ]);
    }
}
