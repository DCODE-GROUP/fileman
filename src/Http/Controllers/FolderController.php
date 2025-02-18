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

        // @phpstan-ignore-next-line
        return view('fileman::index')
            ->with('folder', $folder)
            ->with('directory', FolderService::getDirectoryStructure($folder))
            ->with('path', $folder->getPath())
            ->with('files', (new FileCollection($folder->files))->toArray(request()))
            ->with('folders', (new FolderCollection($folder->loadMissing('children')->children))->toArray(request()));
    }

    public function create(Folder $parent): View
    {
        // @phpstan-ignore-next-line
        return view('fileman::folder.edit')
            ->with('directory', FolderService::getDirectoryStructure($parent))
            ->with('path', $parent->getPath())
            ->with('method', 'post')
            ->with('action', route(config('fileman.route_name').'.folder.store', $parent))
            ->with('parent', $parent);
    }

    public function store(FolderRequest $request, Folder $parent): RedirectResponse
    {
        return redirect()
            ->route(config('fileman.route_name').'.folder.index', Folder::create([
                'name' => $request->input('name'),
                'parent_id' => $parent->id,
            ]));
    }
}
