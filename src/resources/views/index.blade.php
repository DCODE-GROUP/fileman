@extends('fileman::layouts.page')

@section('main')
    <div>
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

@endsection
