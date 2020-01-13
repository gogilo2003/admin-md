<?php

namespace Ogilo\AdminMd\Models;

use Ogilo\AdminMd\Support\Picture;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Article extends Model
{
    protected $filename = null;
	public function category()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\ArticleCategory','article_category_id');
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

	public function comments()
	{
		return $this->hasMany('Ogilo\AdminMd\Models\Comment');
	}

	public function getPictureAttribute($value)
	{
		return new Picture(asset('images/articles'),$value);
	}

}
