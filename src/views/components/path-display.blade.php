@foreach ($folder->pathArray as $path)
    <a class="fm-path" href="{{ route('fileman.folder.index') . '?path=' . $path['path'] }}">{{ $path['name'] }}</a> /
@endforeach
