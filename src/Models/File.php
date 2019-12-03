<?php

namespace DcodeGroup\Fileman\Models;

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

    public function getUrlAttribute()
    {
        return env('AWS_URL').$this->source;
    }
}
