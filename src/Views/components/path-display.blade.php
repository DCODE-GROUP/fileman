@foreach ($folder->pathArray as $path)
    <a class="fm-path" href="{{ route('file-man.folder.index') . '?path=' . $path['path'] }}">{{ $path['name'] }}</a> /
@endforeach
