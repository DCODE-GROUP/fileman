@foreach ($folder->files as $file)
    <a class="fm-folder" href="{{ $file->url }}">{{ $file->name }}</a><br>
@endforeach
