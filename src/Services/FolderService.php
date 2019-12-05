<?php

namespace DcodeGroup\Fileman\Services;

use Illuminate\Database\Eloquent\Collection;

class FolderService
{
    public static function getDirectoryStructure(Collection $folders, $parent_id = null)
    {
        $tree = [];
        foreach ($folders as $index => $folder) {
            if ($folder->parent_id === $parent_id) {
                $folders->pull($index);
                $tree[] = [
                    'name' => $folder->name,
                    'url' => route('fileman.folder.index', $folder->id),
                    'children' => self::getDirectoryStructure($folders, $folder->id),
                ];
            }
        }
        return $tree;
    }
}
