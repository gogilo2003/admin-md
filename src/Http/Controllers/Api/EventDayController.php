<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use File;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Ogilo\AdminMd\Models\Page;
use Ogilo\AdminMd\Models\Event;
use Ogilo\AdminMd\Models\EventDay;
use Illuminate\Support\Facades\Validator;
use Ogilo\AdminMd\Http\Controllers\Api\Controller;

/**
 *
 */
class EventDayController extends Controller
{

    public function getEventDays(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id'
        ]);

        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => '<h5>Validation error</h5>' . make_html_list($validator->errors()->all())
            ];
            return response()->json($res);
        }

        $event = Event::with(['event_days' => function ($query) {
            return $query->orderBy('day', 'ASC');
        }, 'event_days.event_schedules.event_speakers'])->find($request->event_id);

        $days = $event->event_days;

        return response([
            'success' => true,
            'days' => $days
        ])->header('Content-Type', 'application/json');
    }
}
