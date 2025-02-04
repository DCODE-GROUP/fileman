<directory-list :directory="{{json_encode($directory)}}" :folder="{{$folder?->id ?? null}}">

</directory-list>

{{--<a href="{{ isset($directory['url']) ? $directory['url'] : '' }}">--}}
{{--    <i class="far fa-folder"></i>--}}
{{--    <span class="text-sm font-semibold text-gray-700">{{ isset($directory['name']) ? $directory['name'] : '' }} </span>--}}
{{--</a>--}}
{{--@if (isset($directory['children']) && count($directory['children']) > 0)--}}
{{--    <ul>--}}
{{--        @foreach ($directory['children'] as $child)--}}
{{--            <li>--}}
{{--                @include('fileman::components.directory', [--}}
{{--                    'directory' => $child,--}}
{{--                ])--}}
{{--            </li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--@endif--}}
