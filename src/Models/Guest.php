<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public function event()
    {
        return $this->belongsTo('Ogilo\AdminMd\Models\Event');
    }
    
}
