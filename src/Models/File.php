<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class File extends Model
{
	
	public function link()
	{
		return $this->morphOne('Ogilo\Admin\Models\Link','linkable');
	}

	public function category()
	{
		return $this->belongsTo('Ogilo\Admin\Models\FileCategory','file_category_id');
	}
	
	public function admins()
	{
		return $this->belongsToMany('Ogilo\Admin\Models\Admin');
	}

}