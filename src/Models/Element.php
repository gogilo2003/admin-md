<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Element extends Model
{
	
	public function category()
	{
		return $this->belongsTo('Ogilo\Admin\Models\ElementCategory','element_category_id');
	}
	
	public function link()
	{
		return $this->morphOne('Ogilo\Admin\Models\Link','linkable');
	}
	
	public function admins()
	{
		return $this->belongsToMany('Ogilo\Admin\Models\Admin');
	}

}