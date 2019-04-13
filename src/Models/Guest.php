<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public function event()
    {
        return $this->belongsTo('Ogilo\Admin\Models\Event');
    }
    
}
