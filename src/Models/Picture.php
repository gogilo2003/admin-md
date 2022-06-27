<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Picture extends Model
{
	protected $appends = ['url','url_hd','url_thumbnail'];

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

	public function getUrlAttribute()
	{
		return asset('images/pictures/'.$this->name);
	}

	public function getUrlHdAttribute()
	{
		return asset('images/pictures/original/'.$this->name);
	}

	public function getUrlThumbnailAttribute()
	{
		return asset('images/pictures/thumbnails/'.$this->name);
	}

}
