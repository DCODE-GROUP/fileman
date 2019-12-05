<a href="{{ isset($folder['url']) ? $folder['url'] : '' }}">
    <i class="far fa-folder"></i>
    <span>{{ isset($folder['name']) ? $folder['name'] : '' }}</span>
</a>
@if (isset($folder['children']) && count($folder['children']) > 0)
    <ul>
        @foreach ($folder['children'] as $child)
            <li>
                @include('fileman::components.folder', [
                    'folder' => $child,
                ])
            </li>
        @endforeach
    </ul>
@endif
