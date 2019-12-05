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
            <div class="actions">
                <a href="{{ route('fileman.folder.create', ['folder' => $folder]) }}">
                    +Add Folder
                </a>
                <a href="{{ route('fileman.file.create', ['folder' => $folder]) }}">
                    +Add File
                </a>
            </div>
            <div class="grid">
                @foreach ($folder->files as $file)
                    <div class="cell">
                        @include('fileman::components.file', [
                            'file' => $file,
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection