<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Element extends Model
{
	
	public function category()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\ElementCategory','element_category_id');
	}
	
	public function link()
	{
		return $this->morphOne('Ogilo\AdminMd\Models\Link','linkable');
	}
	
	public function admins()
	{
		return $this->belongsToMany('Ogilo\AdminMd\Models\Admin');
	}

}