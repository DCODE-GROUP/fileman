<?php

namespace DcodeGroup\Fileman\Services;

use DcodeGroup\Fileman\Http\Resources\Search\FileCollection;
use DcodeGroup\Fileman\Http\Resources\Search\FolderCollection;

class SearchService
{
    public function __construct(public FileService $fileService, public FolderService $folderService) {}

    public function search($keyword, $folderId)
    {
        $currentFolderFiles = $this->fileService->searchFiles($keyword, $folderId, true);
        $otherFolderFiles = $this->fileService->searchFiles($keyword, $folderId);
        $folders = $this->folderService->searchFolders($keyword, $folderId);

        return array_merge(
            (new FileCollection($currentFolderFiles))->toArray(request()),
            (new FileCollection($otherFolderFiles))->toArray(request()),
            (new FolderCollection($folders))->toArray(request())
        );
    }
}
