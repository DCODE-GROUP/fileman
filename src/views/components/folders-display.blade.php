@foreach ($folder->children as $childFolder)
    <a class="fm-folder" href="{{ route('fileman.folder.index', ['path' => $path . '/' . $childFolder->name]) }}">{{ $childFolder->name }}</a><br>
@endforeach
