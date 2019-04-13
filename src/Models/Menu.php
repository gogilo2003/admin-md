<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function articles()
    {
    	return $this->hasMany('Ogilo\Admin\Models\Article');
    }
    public function links()
    {
    	return $this->hasMany('Ogilo\Admin\Models\Link');
    }
	
	public function admins()
	{
		return $this->belongsToMany('Ogilo\Admin\Models\Admin');
	}

    public function isSelected($menu_id)
    {
        return ($menu_id == $this->id);
    }
}
