@foreach ($folder->children as $childFolder)
    <a href="{{ route('admin.folder.index', ['path' => $path . '/' . $childFolder->name]) }}">{{ $childFolder->name }}</a><br>
@endforeach
