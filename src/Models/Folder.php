<?php

namespace DcodeGroup\Fileman\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Node
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fm_folders';


    public function parent(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function files(): HasMany
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
        return Folder::query()->whereNull('parent_id')->first();
    }

}
