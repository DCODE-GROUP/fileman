@component('fileman::layouts.components.html')
    @slot('body')
        <div class="page">
            <div class="side">
                @include('fileman::components.path', [
                    'path' => $path,
                ])
                <div class="directory">
                    @include('fileman::components.directory', [
                        'directory' => $directory,
                    ])
                </div>
            </div>
            <div class="main">
                @yield('main')
            </div>
        </div>
    @endslot
@endcomponent