<section class="p-6">
    <div class="flex flex-row justify-start gap-2 items-center">
        <text class="font-semibold text-base text-gray-900">
            {{__('fileman.headings.files')}}
        </text>
        <div class="text-xs font-medium border border-gray-300 rounded-md h-5 leading-5 px-1.5 bg-gray-50">
            {{count($folder->files)}} {{__('fileman.words.files')}}
        </div>
    </div>
    <div class="grid md:grid-cols-4 sm:grid-cols-2 gap-4 mt-3 !px-0">
        <fileman-upload-file
            upload-url="{{route('fileman.file.store',['parent'=>$folder->id])}}"
        >
        </fileman-upload-file>
        @foreach ($folder->files as $file)
            <div class="aspect-square">
                @include('fileman::components.file', [
                    'file' => $file,
                ])
            </div>
        @endforeach
    </div>
</section>
