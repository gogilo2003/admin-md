<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Event model
*/
class Event extends Model
{

    protected $appends = ['pages'];
    protected $dates = ['held_at'];

	public function link()
	{
		return $this->morphOne('Ogilo\AdminMd\Models\Link','linkable');
	}

	public function page()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\Page');
	}

	public function admins()
	{
		return $this->belongsToMany('Ogilo\AdminMd\Models\Admin');
	}

	public function category()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\EventCategory','event_category_id');
	}

	public function getPagesAttribute()
	{
		return $this->category->pages;
	}

	public function guests()
	{
		return $this->hasMany('Ogilo\AdminMd\Models\Guest');
	}

}
