<?php

namespace DcodeGroup\Fileman\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Model
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

    public function onClick()
    {
        return $this->getUrl();
    }

    public function hasPreview()
    {
        return (in_array($this->type, ['png', 'jpg', 'jpeg']) && $this->source);
    }

    public function getPreview()
    {
        if ($this->hasPreview()) {
            return $this->getUrl();
        }
    }

    public function getUrl()
    {
        $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
        $expiry = "+10 minutes";
        $command = $client->getCommand('GetObject', [
            'Bucket' => \Config::get('filesystems.disks.s3.bucket'),
            'Key'    => $this->source,
        ]);

        return $client->createPresignedRequest($command, $expiry)->getUri();
    }
}
