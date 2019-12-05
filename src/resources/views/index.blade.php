@extends('fileman::layouts.page')

@section('actions')
    <a href="{{ route('fileman.folder.create', $folder) }}">
        +Add Folder
    </a>
    <a href="{{ route('fileman.file.create', $folder) }}">
        +Add File
    </a>
@endsection

@section('content')
    <div class="grid">
        @foreach ($folder->files as $file)
            <div class="cell">
                @include('fileman::components.file', [
                    'file' => $file,
                ])
            </div>
        @endforeach
    </div>
@endsection