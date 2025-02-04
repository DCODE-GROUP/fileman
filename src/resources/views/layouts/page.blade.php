@component('fileman::layouts.components.html')
    @slot('body')
        <div class="page bg-white">
            <div class="w-60 border border-gray-200">
                @include('fileman::components.side.header')
                <div class="directory">
                    @include('fileman::components.side.directory', [
                        'directory' => $directory,
                        'folder' => $folder,
                    ])
                </div>
            </div>
            <div class="main !w-[calc(100%-15rem)] ">
                @yield('main')
            </div>
        </div>
    @endslot
@endcomponent
