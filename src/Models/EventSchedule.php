<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Event model
*/
class EventSchedule extends Model
{

    // protected $casts = [
    // 	'start_at' => 'date:H:i:s',
    // 	'end_at' => 'date:H:i:s'
    // ];

	public function event()
	{
		return $this->belongsTo(Event::class);
	}

	public function event_speakers()
	{
		return $this->belongsToMany(EventSpeaker::class);
	}

	public function event_day()
	{
		return $this->belongsTo(EventDay::class);
	}

}
