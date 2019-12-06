@extends('fileman::layouts.page')

@section('main')
    <div class="file-window">
        <div class="actions">
            <a class="button" href="{{ route('fileman.folder.create', $folder) }}">
                <i class="fas fa-folder-plus"></i>
                <span>New Folder</span>
            </a>
            <a class="button" href="{{ route('fileman.file.create', $folder) }}">
                <i class="fas fa-file-import"></i>
                <span>New File</span>
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
@endsection