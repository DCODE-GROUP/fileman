<?php

namespace DcodeGroup\Fileman\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    public function rename(string $name): void
    {
        $this->update([
            'name' => $name,
        ]);
    }
}
