@extends('fileman::layouts.page')

@section('main')
    <div class="flex">
        <div class="flex-1">
            {{--   including breadcrumbs, filters     --}}
            @include('fileman::components.page.header', [
                'path' => $path,
            ])
            {{--    Folders --}}
            @include('fileman::components.page.folder', [
                'folders' => $folders,
            ])

            {{--    Files --}}
            @include('fileman::components.page.file', [
                'folder' => $folder,
                'files' => $files,
            ])
        </div>
        <fileman-file-detail></fileman-file-detail>
        <fileman-rename-file-popup></fileman-rename-file-popup>
        <fileman-delete-file-popup></fileman-delete-file-popup>
        <fileman-add-folder-popup></fileman-add-folder-popup>
        <fileman-rename-folder-popup></fileman-rename-folder-popup>
        <fileman-delete-folder-popup></fileman-delete-folder-popup>

    </div>

@endsection
