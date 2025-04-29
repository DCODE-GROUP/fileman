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
use Illuminate\Support\Facades\Log;

class FileController extends BaseController
{
    public function show(Folder $parent, File $file): View
    {
        // @phpstan-ignore-next-line
        return view('fileman::file.show')
            ->with([
                'file' => $file,
                'parent' => $parent,
                'directory' => FolderService::getDirectoryStructure($parent),
                'path' => $parent->getPath(),
                'folder' => $parent,
            ]);
    }

    public function create(Folder $parent): View
    {
        // @phpstan-ignore-next-line
        return view('fileman::file.edit')
            ->with([
                'parent' => $parent,
                'directory' => FolderService::getDirectoryStructure($parent),
                'path' => $parent->getPath(),
                'action' => route(config('fileman.route_name').'.file.store', $parent->id),
                'method' => 'post',
                'folder' => $parent,
            ]);
    }

    public function store(FileRequest $request, Folder $parent): RedirectResponse
    {
        try{
            FileService::newFile(
                $parent,
                $request->file('file'),
                $request->input('name')
            );
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

        return redirect()
            ->route(config('fileman.route_name').'.folder.index', $parent->id);
    }

    public function edit(Folder $parent, File $file): View
    {
        // @phpstan-ignore-next-line
        return view('fileman::file.edit')
            ->with([
                'file' => $file,
                'parent' => $parent,
                'directory' => FolderService::getDirectoryStructure($parent),
                'path' => $parent->getPath(),
                'action' => route(config('fileman.route_name').'.file.update', [$parent->id, $file->id]),
                'method' => 'put',
                'folder' => $parent,
            ]);
    }

    public function update(Folder $parent, File $file): RedirectResponse
    {
        $file->rename(request()->input('name'));

        return redirect()
            ->route(config('fileman.route_name').'.folder.index', $parent->id);
    }

    public function destroy(Folder $parent, File $file): RedirectResponse
    {
        $file->delete();

        return redirect()
            ->route(config('fileman.route_name').'.folder.index', $parent->id);
    }
}
