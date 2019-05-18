<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Picture extends Model
{
	
	public function link()
	{
		return $this->morphOne('Ogilo\AdminMd\Models\Link','linkable');
	}
	
	public function category()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\PictureCategory','picture_category_id','id');
	}
	
	public function admins()
	{
		return $this->belongsToMany('Ogilo\AdminMd\Models\Admin');
	}

}