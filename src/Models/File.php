<?php

namespace DcodeGroup\Fileman\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Node
{
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $table = 'fm_files';

    /*
     * Relationships
     */

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    /*
     * Methods
     */

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
        if (\Config::get('filesystems.disks.s3.url')) {
            return \Config::get('filesystems.disks.s3.url').$this->source;
        }
        return Storage::disk('s3')->url($this->source);
    }

    public function getSignedUrl()
    {
        $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
        $expiry = "+10 minutes";
        $command = $client->getCommand('GetObject', [
            'Bucket' => \Config::get('filesystems.disks.s3.bucket'),
            'Key' => $this->source,
        ]);
        return $client->createPresignedRequest($command, $expiry)->getUri();
    }

    private static function getImageMimes()
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
