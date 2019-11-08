@extends('file-man::layouts.base')

@section('content')
    <div>
        <a class="fm-action" href="{{ route('file-man.folder.sync') }}">Sync</a><br>
    </div>
    <div>
        @include('file-man::components.path-display', ['folder' => $folder])<br>
        @include('file-man::components.folders-display', ['folder' => $folder])
        @include('file-man::components.files-display', ['folder' => $folder])
    </div>
    <div>
        <a class="fm-action" href="{{ route('file-man.folder.create', ['folder' => $folder]) }}">+Add Folder</a><br>
        <a class="fm-action" href="{{ route('file-man.file.create', ['folder' => $folder]) }}">+Add File</a>
    </div>
@endsection