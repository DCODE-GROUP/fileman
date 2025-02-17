<div class="px-6 pt-5">
    <fileman-search search-url="{{route(config('fileman.api_route_name').'.file.search',['parent' => $folder->id])}}"></fileman-search>
</div>
<div class="pb-5 pt-6 px-6 border-b border-gray-200">
    @include('fileman::components.side.path', [
        'path' => $path,
    ])
</div>
