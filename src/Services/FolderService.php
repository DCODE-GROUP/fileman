<?php

namespace DcodeGroup\Fileman\Services;

use DcodeGroup\Fileman\Models\Folder;
use Illuminate\Database\Eloquent\Collection;

class FolderService
{
    public static function getDirectoryStructure()
    {
        $folders = Folder::with('children')->get();
        return self::buildTree($folders)[0]; // The [0] is a bit of a hack but it's currently nessisary.
    }

    private static function buildTree(Collection $folders, $parent_id = null)
    {
        $tree = [];
        foreach ($folders as $index => $folder) {
            if ($folder->parent_id === $parent_id) {
                $folders->pull($index);
                $tree[] = [
                    'name' => $folder->name,
                    'url' => route('fileman.folder.index', $folder->id),
                    'children' => self::buildTree($folders, $folder->id),
                ];
            }
        }
        return $tree;
    }
}
