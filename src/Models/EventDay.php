<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Day model
*/
class EventDay extends Model
{

    public function event()
    {
    	return $this->belongsTo(Event::class);
    }

    public function event_schedules()
    {
    	return $this->hasMany(EventSchedule::class);
    }

}
