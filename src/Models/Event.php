<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Event model
*/
class Event extends Model
{

	protected $appends = ['pages'];
	
	public function link()
	{
		return $this->morphOne('Ogilo\Admin\Models\Link','linkable');
	}
	
	public function page()
	{
		return $this->belongsTo('Ogilo\Admin\Models\Page');
	}
	
	public function admins()
	{
		return $this->belongsToMany('Ogilo\Admin\Models\Admin');
	}

	public function category()
	{
		return $this->belongsTo('Ogilo\Admin\Models\EventCategory','event_category_id');
	}

	public function getPagesAttribute()
	{
		return $this->category->pages;
	}

	public function guests()
	{
		return $this->hasMany('Ogilo\Admin\Models\Guest');
	}

}