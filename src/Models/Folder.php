<?php

namespace DcodeGroup\Fileman\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Node
{
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $table = 'fm_folders';

    /*
     * Relationships
     */

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    /*
     * Methods
     */

    public function getPath()
    {
        $folder = $this;
        $array = [];
        while ($folder) {
            $array[] = [
                'name' => $folder->name,
                'url' => route('fileman.folder.index', $folder->id),
            ];
            $folder = $folder->parent;
        }
        return array_reverse($array);
    }

    /*
     * Static Methods
     */

    public static function getRoot()
    {
        return Folder::whereNull('parent_id')->first();
    }

}
