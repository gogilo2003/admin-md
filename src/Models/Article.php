<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Article extends Model
{
	
	public function category()
	{
		return $this->belongsTo('Ogilo\Admin\Models\ArticleCategory','article_category_id');
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

	public function comments()
	{
		return $this->hasMany('Ogilo\Admin\Models\Comment');
	}

}