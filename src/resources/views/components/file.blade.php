<a class="file"
   href="{{ $file->onClick() }}"
   data-select-mode="{{ isset($mode) ? $mode : '' }}"
   data-callback="{{ isset($callback) ? $callback : '' }}"
>
    @if ($file->hasPreview())
        <div class="thumbnail" style="background-image: url({{ $file->getPreview() }})"></div>
    @else
        <i class="thumbnail far fa-file fa-3x"></i>
    @endif
    <span>{{ $file->name }}</span>
</a>