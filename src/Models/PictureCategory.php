<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class PictureCategory extends Model
{
	
	public function pictures()
	{
		return $this->hasMany('Ogilo\AdminMd\Models\Picture');
	}

    public function pages()
    {
    	return $this->belongsToMany('Ogilo\AdminMd\Models\Page');
    }

    public function pageIds()
    {
    	$ids = array();
    	foreach ($this->pages as $key => $value) {
    		$ids[] = $value->id;
    	}
    	return $ids;
    }

	public function getMaxSizeAttribute($value)
	{
		return $value/1024;
	}

	public function setMaxSizeAttribute($value)
	{
		$this->attributes['max_size'] = $value * 1024;
	}

	public function maxSizeKilobytes()
	{
		return $this->attributes['max_size'];
	}

}