<a class="file h-full bg-gray-50 hover:bg-gray-100 rounded-md"
   data-file="{{ json_encode($file) }}"
   data-url="{{ $file->getUrl() }}"
   href="{{ route('fileman.file.show', [$file->folder, $file->id]) }}"
>
    @if ($file->hasPreview())
        <div class="thumbnail !h-4/5" style="background-image: url({{ $file->getPreview() }})"></div>
    @else
        <div class="thumbnail !h-4/5" style="background-image: url({{ $file->getUrl() }})"></div>
    @endif
    <span class="text-sm font-normal mt-2">{{ $file->name }}</span>
</a>
