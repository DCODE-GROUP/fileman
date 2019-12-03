<?php

namespace DcodeGroup\Fileman\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'fm_folders';

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

    public function getPathAttribute()
    {
        $path = '';
        $folder = $this;
        $array = [];
        while ($folder) {
            $array[] = $folder->name;
            $folder = $folder->parent;
        }

        return implode('/', array_reverse($array));
    }

    public function getPathArrayAttribute()
    {
        $path = '';
        $folder = $this;
        $array = [];
        while ($folder) {
            $array[] = [
                'name' => $folder->name,
                'path' => $folder->path,
            ];
            $folder = $folder->parent;
        }

        return array_reverse($array);
    }

    public function getChild($name)
    {
        return $this->children()->where('name', 'LIKE', '%'.$name.'%')->first();
    }
}
