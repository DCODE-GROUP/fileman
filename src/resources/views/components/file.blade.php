<a class="file"
   data-file="{{ json_encode($file) }}"
   data-url="{{ $file->getUrl() }}"
   href="{{ route('fileman.file.show', [$file->folder, $file->id]) }}"
>
    @if ($file->hasPreview())
        <div class="thumbnail" style="background-image: url({{ $file->getPreview() }})"></div>
    @else
        <div class="thumbnail" style="background-image: url({{ $file->getUrl() }})"></div>
    @endif
    <span class="filename">{{ $file->name }}</span>
</a>
