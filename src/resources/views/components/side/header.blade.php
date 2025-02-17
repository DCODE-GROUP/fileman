@use(DcodeGroup\Fileman\Services\FileService)
<div class="text-lg font-semibold text-gray-900 my-5 mx-6 flex
flex-row justify-start gap-2 items-center">
    {{__('fileman.headings.title')}}
    <div class="text-xs font-medium border border-gray-300 rounded-md h-5 leading-5 px-1.5">
        {{FileService::countAllFiles()}} {{__('fileman.words.files')}}
    </div>
</div>
