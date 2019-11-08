@foreach ($folder->children as $childFolder)
    <a href="{{ route('file-man.folder.index', ['path' => $path . '/' . $childFolder->name]) }}">{{ $childFolder->name }}</a><br>
@endforeach
