@extends('file-man::layouts.base')

@section('content')
    <div>
        @include('file-man::components.path-display', ['folder' => $folder])<br>
        @include('file-man::components.folders-display', ['folder' => $folder])
        @include('file-man::components.files-display', ['folder' => $folder])
        <a href="{{ route('file-man.folder.create', ['folder' => $folder]) }}">+Add Folder</a><br>
        <a href="{{ route('file-man.file.create', ['folder' => $folder]) }}">+Upload File</a>
    </div>
@endsection