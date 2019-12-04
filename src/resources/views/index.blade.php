@extends('fileman::layouts.base')

@section('content')
    <div class="content">
        <div class="side">
            <div class="path">
                @include('fileman::components.path', [
                    'path' => $path,
                ])
            </div>
            <div class="directory">
                @include('fileman::components.folder', [
                    'folder' => $directory,
                ])
            </div>
        </div>
        <div class="main">
                @foreach ($folder->files as $file)
                    <div>
                        <a href="{{ $file->getUrl() }}">
                            <div style="background-image: url({{ $file->getPreview() }})"></div>
                            <span>{{ $file->name }}</span>
                        </a>
                    </div>
                @endforeach
        </div>
    </div>
{{--    <div>--}}
{{--        <a class="fm-action" href="{{ route('fileman.folder.create', ['folder' => $folder]) }}">+Add Folder</a><br>--}}
{{--        <a class="fm-action" href="{{ route('fileman.file.create', ['folder' => $folder]) }}">+Add File</a>--}}
{{--    </div>--}}
@endsection