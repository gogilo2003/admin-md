<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Blog extends Model
{
	
	public function category()
	{
		return $this->belongsTo('Ogilo\Admin\Models\BlogCategory','Blog_category_id');
	}
	
	public function page()
	{
		return $this->belongsTo('Ogilo\Admin\Models\Page');
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