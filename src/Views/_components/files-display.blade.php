@foreach ($folder->files as $file)
    <a href="{{ $file->url }}">{{ $file->name }}</a><br>
@endforeach
