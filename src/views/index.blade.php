@extends('fileman::layouts.base')

@section('content')
    <div>
        @include('fileman::components.path-display', ['folder' => $folder])<br>
        @include('fileman::components.folders-display', ['folder' => $folder])
        @include('fileman::components.files-display', ['folder' => $folder])
    </div>
    <div>
        <a class="fm-action" href="{{ route('fileman.folder.create', ['folder' => $folder]) }}">+Add Folder</a><br>
        <a class="fm-action" href="{{ route('fileman.file.create', ['folder' => $folder]) }}">+Add File</a>
    </div>
@endsection