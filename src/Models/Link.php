<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public function linkable()
    {
        return $this->morphTo();
    }

    public function menu()
    {
    	return $this->belongsTo('Ogilo\AdminMd\Models\Menu');
    }
    
    public function admins()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\Admin');
    }

    public function isSelected($link_id)
    {
        return ($link_id == $this->id);
    }
    
}
