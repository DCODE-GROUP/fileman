<a class="file"
   data-file="{{ json_encode($file) }}"
   href="{{ route('fileman.file.show', [$file->folder, $file->id]) }}"
>
    @if ($file->hasPreview())
        <div class="thumbnail" style="background-image: url({{ $file->getPreview() }})"></div>
    @else
        <i class="thumbnail far fa-file fa-3x"></i>
    @endif
    <span class="filename">{{ $file->name }}</span>
</a>