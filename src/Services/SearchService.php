<?php

namespace DcodeGroup\Fileman\Services;

class SearchService
{

    public function __construct(public FileService $fileService, public FolderService $folderService)
    {
    }
    public function search($keyword, $folderId){
        $currentFolderFiles = $this->fileService->searchFiles($keyword,$folderId, true);
        $otherFolderFiles = $this->fileService->searchFiles($keyword, $folderId);
        $folders = $this->folderService->searchFolders($keyword);
        return [
            'currentFolderFiles' => $currentFolderFiles,
            'otherFolderFiles' => $otherFolderFiles,
            'folders' => $folders
        ];
    }
}
