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
            ])
        </div>

        <fileman-file-detail></fileman-file-detail>
    </div>

@endsection
