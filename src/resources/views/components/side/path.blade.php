<div class="flex items-center gap-1.5">
    @foreach ($path as $pathLine)
        @if(!$loop->last)
            <div>
                <a href="{{ $pathLine['url'] }}"
                   class="text-sm font-medium text-gray-600 py-1 px-2 hover:bg-gray-50 rounded-md">
                    {{ $pathLine['name'] }}
                </a>
            </div>
            <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4 stroke-gray-300">
                <path d="M9 18L15 12L9 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @else
            <div class="text-gray-700  bg-gray-50 rounded-md text-sm font-semibold  px-2">{{ $pathLine['name'] }}</div>
        @endif
    @endforeach
</div>
<div class="mt-5">
    <div class="text-gray-900 text-3xl py-1 px-2 font-semibold">{{$folder->name}} </div>
</div>

