<?php

namespace DcodeGroup\Fileman\Models;

use DcodeGroup\Fileman\Services\FileService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class File extends Node
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'folder_id',
        'source',
        'type',
        'size',
    ];

    protected $appends = [
        'is_image',
        'file_type',
        'file_type_color',
        'file_extension',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fm_files';

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function getUrl(): string
    {
        return FileService::getDisk()->url($this->source);
    }

    private static function getImageMimes(): Collection
    {
        return collect([
            'image/bmp',
            'image/x-windows-bmp',
            'image/gif',
            'image/x-icon',
            'image/jpeg',
            'image/pjpeg',
            'image/png',
            'image/svg',
        ]);
    }

    public function getIsImageAttribute(): bool
    {
        return $this->fileType === 'Images';
    }

    public function getFileTypeAttribute(): string
    {
        return collect(config('fileman.fileFormats'))->filter(function ($valueArray, $key) {
            // use mime type and config('fileman.fileFormats') to get the type of file
            return in_array($this->type, $valueArray);
        })->keys()->first();
    }

    public function getFileTypeColorAttribute(): array
    {
        return config('fileman.colors.'.$this->fileType);
    }

    public function getFileExtensionAttribute(): string
    {
        return strtoupper(explode('/', $this->type)[1]);
    }
}
