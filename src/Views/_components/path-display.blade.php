@foreach ($folder->pathArray as $path)
    <a href="{{ route('admin.folder.index') . '?path=' . $path['path'] }}">{{ $path['name'] }}</a> /
@endforeach
