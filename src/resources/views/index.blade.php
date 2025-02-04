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
    </div>
{{--    <div class="actions">--}}
{{--        <a class="button" href="{{ route('fileman.folder.create', $folder) }}">--}}
{{--            <i class="fas fa-folder-plus"></i>--}}
{{--            <span>{{__('fileman.buttons.new_folder')}}</span>--}}
{{--        </a>--}}
{{--        <a class="button" href="{{ route('fileman.file.create', $folder) }}">--}}
{{--            <i class="fas fa-file-import"></i>--}}
{{--            <span>{{__('fileman.buttons.new_file')}}</span>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="grid">--}}
{{--        @foreach ($folder->files as $file)--}}
{{--            <div class="cell">--}}
{{--                @include('fileman::components.file', [--}}
{{--                    'file' => $file,--}}
{{--                ])--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}



@endsection
