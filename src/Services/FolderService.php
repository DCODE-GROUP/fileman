<?php

namespace DcodeGroup\Fileman\Services;

use DcodeGroup\Fileman\Models\Folder;
use Illuminate\Database\Eloquent\Collection;

class FolderService
{
    public static function getDirectoryStructure(Folder $folder = null)
    {
        $folders = Folder::query()->with('children')
            ->withCount('files')
            ->get();
        return self::buildTree($folders,null, $folder)[0]; // The [0] is a bit of a hack but it's currently nessisary.
    }

    private static function buildTree(Collection $folders, $parent_id = null, $currentFolder = null)
    {
        $tree = [];
        foreach ($folders as $index => $folder) {
            if ($folder->parent_id === $parent_id) {
                $folders->pull($index);
                $tree[] = [
                    'name' => $folder->name,
                    'url' => route('fileman.folder.index', $folder->id),
                    'count' => $folder->files_count,
                    'open' =>  self::shouldOpenTheFolder($folder, $currentFolder),
                    'children' => self::buildTree($folders, $folder->id, $currentFolder),
                    'childrenCount' => count($folder->children),
                    'id' => $folder->id,
                ];
            }
        }
        return $tree;
    }

    static function shouldOpenTheFolder($folder, $currentFolder) : bool
    {
        if(empty($folder)){
            return false;
        }

        if($folder->id === $currentFolder->id){
            return true;
        }

        if($folder->parent_id === null){
            return true;
        }

        foreach ($folder->children as $child) {
            if(self::shouldOpenTheFolder($child, $currentFolder)){
                return true;
            }
        }
        return false;
    }

}
