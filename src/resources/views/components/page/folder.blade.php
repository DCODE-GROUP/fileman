<section class="p-6">
    <div class="flex flex-row justify-start gap-2 items-center">
        <text class="font-semibold text-base text-gray-900">
            {{__('fileman.headings.folders')}}
        </text>
        <div class="text-xs font-medium border border-gray-300 rounded-md h-5 leading-5 px-1.5 bg-gray-50">
            {{count($folders)}} {{__('fileman.words.folders')}}
        </div>
        <fileman-add-folder class="ml-auto"
                                  create-folder-url="{{route('api.fileman.folder.store',['parent'=>$folder->id])}}"
                                  :folder="{{$folder}}">
        </fileman-add-folder>
    </div>
    <div class="grid grid-cols-4 gap-4 mt-3 !px-0 ">
        @if(count($folders) > 0)
            @foreach ($folders as $folder)
                <div class="flex flex-row gap-2 py-4 px-3 bg-gray-50 rounded-xl hover:bg-gray-100 group">
                    <a href="{{route('fileman.folder.index', data_get($folder,'id'))  }}" class="flex flex-1 gap-2 items-center">
                        <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 stroke-gray-500">
                            <path
                                d="M13 7L11.8845 4.76892C11.5634 4.1268 11.4029 3.80573 11.1634 3.57116C10.9516 3.36373 10.6963 3.20597 10.4161 3.10931C10.0992 3 9.74021 3 9.02229 3H5.2C4.0799 3 3.51984 3 3.09202 3.21799C2.71569 3.40973 2.40973 3.71569 2.21799 4.09202C2 4.51984 2 5.0799 2 6.2V7M2 7H17.2C18.8802 7 19.7202 7 20.362 7.32698C20.9265 7.6146 21.3854 8.07354 21.673 8.63803C22 9.27976 22 10.1198 22 11.8V16.2C22 17.8802 22 18.7202 21.673 19.362C21.3854 19.9265 20.9265 20.3854 20.362 20.673C19.7202 21 18.8802 21 17.2 21H6.8C5.11984 21 4.27976 21 3.63803 20.673C3.07354 20.3854 2.6146 19.9265 2.32698 19.362C2 18.7202 2 17.8802 2 16.2V7Z"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="flex-1">{{data_get($folder,'name')}}</div>

                    </a>
                    <fileman-menu :object="{{json_encode($folder)}} "
                                  class="invisible group-hover:visible"></fileman-menu>
                </div>

            @endforeach
        @else
            <div class="text-gray-500 text-left col-span-full">
                {{__('fileman.words.no_folder')}}
            </div>
        @endif
    </div>
</section>

