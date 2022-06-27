<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Event model
*/
class Event extends Model
{

    protected $appends = ['pages','picture_url','thumbnail_url'];
    protected $dates = ['held_at','end_at'];
    // protected $touches = ['event_speakers'];

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

	// public function schedules()
	// {
	// 	return $this->hasManyThrough('Ogilo\AdminMd\Models\EventSchedule', 'Ogilo\AdminMd\Models\EventDay');
	// }

	public function getPictureUrlAttribute()
	{
		return asset('images/events/'.$this->picture);
	}

	public function getThumbnailUrlAttribute()
	{
		return asset('images/events/thumbnails/'.$this->picture);
	}

	public function event_speakers()
	{
		return $this->belongsToMany('Ogilo\AdminMd\Models\EventSpeaker');
	}

	public function event_days()
	{
		return $this->hasMany('Ogilo\AdminMd\Models\EventDay');
	}

}
