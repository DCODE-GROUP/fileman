<?php

namespace DcodeGroup\Fileman\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Node
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'parent_id',
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

    public function getPath()
    {
        $folder = $this;
        $array = [];
        while ($folder) {
            $array[] = [
                'name' => $folder->name,
                'url' => route(config('fileman.route_name').'.folder.index', $folder->id),
            ];
            $folder = $folder->parent;
        }

        return array_reverse($array);
    }

    public function getFolderPath(): string
    {
        $path = $this->getPath();
        array_shift($path);

        return collect($path)->map(function ($item) {
            return $item['name'];
        })->implode('/');

    }

    public static function getRoot()
    {
        return Folder::query()->whereNull('parent_id')->first();
    }

    public function isRoot(): bool
    {
        // @phpstan-ignore-next-line
        return is_null($this->parent_id);
    }
}
