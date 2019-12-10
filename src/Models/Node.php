<?php

namespace DcodeGroup\Fileman\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    /*
     * Methods
     */

    public function rename(String $name)
    {
        $this->update([
            'name' => $name,
        ]);
    }
}