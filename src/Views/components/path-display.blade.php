@foreach ($folder->pathArray as $path)
    <a href="{{ route('file-man.folder.index') . '?path=' . $path['path'] }}">{{ $path['name'] }}</a> /
@endforeach
