<?php

namespace DcodeGroup\Fileman\Models;

use DcodeGroup\Fileman\Services\FileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class File extends Node
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
    protected $table = 'fm_files';

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function hasPreview()
    {
        return self::getImageMimes()->contains($this->type) && $this->source;
    }

    public function getPreview()
    {
        if ($this->hasPreview()) {
            return $this->getSignedUrl();
        }
        return null;
    }

    public function getUrl()
    {
        if (config('filesystems.disks.s3.url')) {
            return config('filesystems.disks.s3.url').'/'.$this->source;
        }
        return FileService::getDisk()->url($this->source);
    }

    public function getSignedUrl()
    {
        //$client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
        //$expiry = "+10 minutes";
        //$command = $client->getCommand('GetObject', [
        //    'Bucket' => config('filesystems.disks.s3.bucket'),
        //    'Key' => $this->source,
        //]);
        //return $client->createPresignedRequest($command, $expiry)->getUri();
        // has temporaryUrl

        try {
            $url = FileService::getDisk()->temporaryUrl($this->source, now()->addMinutes(10));
        } catch (\Exception $e) {
            $url = FileService::getDisk()->url($this->source);
        }

        return $url;
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
}
