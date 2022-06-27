<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function articles()
    {
    	return $this->hasMany('Ogilo\AdminMd\Models\Article');
    }
    public function links()
    {
    	return $this->hasMany('Ogilo\AdminMd\Models\Link');
    }
	
	public function admins()
	{
		return $this->belongsToMany('Ogilo\AdminMd\Models\Admin');
	}

    public function isSelected($menu_id)
    {
        return ($menu_id == $this->id);
    }
}
