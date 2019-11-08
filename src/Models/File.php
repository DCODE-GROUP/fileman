<?php

namespace DcodeGroup\FileMan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'fm_files';

    // Belongs to
    public function folder () {
        return $this->belongsTo(Folder::class);
    }

    // Has one
    public function thumb () {
        return $this->hasOne(Thumb::class);
    }

    //Attributes
    public function getUrlAttribute() {
        return env('AWS_URL') . $this->source;
    }
}
