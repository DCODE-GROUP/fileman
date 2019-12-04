<a href="{{ isset($folder['url']) ? $folder['url'] : '' }}">{{ isset($folder['name']) ? $folder['name'] : '' }}</a>
<ul>
    @if (isset($folder['children']) && count($folder['children']) > 0)
        @foreach ($folder['children'] as $child)
            <li>
                @include('fileman::components.folder', [
                    'folder' => $child,
                ])
            </li>
        @endforeach
    @endif
</ul>