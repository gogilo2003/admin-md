<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Day model
*/
class EventSpeaker extends Model
{
    protected $touches = ['events','event_schedules'];

    public function events()
    {
    	return $this->belongsToMany(Event::class);
    }

    public function event_schedules()
    {
    	return $this->belongsToMany(EventSchedule::class);
    }

}
