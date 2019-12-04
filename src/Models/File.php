<?php

namespace DcodeGroup\FileMan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'fm_files';

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function thumb()
    {
        return $this->hasOne(Thumb::class);
    }

    public function getPreview()
    {
        if (in_array($this->type, ['png', 'jpg', 'jpeg'])) {
            return $this->getUrl();
        }
    }

    public function getUrl()
    {
        return env('AWS_URL', '//d3k6t6l60lmqbi.cloudfront.net/').$this->source;
    }
}
