<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Project extends Model
{
	
	public function category()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\ProjectCategory','project_category_id');
	}
	
	public function page()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\Page');
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