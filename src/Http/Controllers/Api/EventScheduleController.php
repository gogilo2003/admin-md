<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use File;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Ogilo\AdminMd\Models\Page;
use Ogilo\AdminMd\Models\EventDay;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\EventSchedule;

/**
*
*/
class EventScheduleController extends Controller
{

    public function getEventSchedules(Request $request)
    {
        $validator = Validator::make($request->all(),[
        	'day_id'=>'required|exists:event_days,id'
        ]);

        if ($validator->fails()) {
        	$res = [
        		'success'=>false,
        		'message'=>'<h5>Validation error</h5>'.make_html_list($validator->errors()->all())
        	];
        	return response()->json($res);
        }

        $day = EventDay::with('event_schedules')->find($request->day_id);

        $schedules = $day->event_schedules;

        return response()->json([
                'success'=>true,
                'schedules'=>$schedules
            ]);
    }

    public function postAdd(Request $request)
    {
        // return response()->json($request->all());

        $validator = Validator::make($request->all(),[
            'day_id'=>'required|exists:event_days,id',
            'title'=>'required',
            'start_at'=>'required',
            'end_at'=>'required',
            'content'=>'required',
        ]);

        if ($validator->fails()) {
        	$res = [
        		'success'=>false,
                'message'=>'Validation error',
                'errors'=>$validator->errors()->all()
        	];
        	return response()->json($res);
        }

        // $schedule = new EventSchedule();

        // $schedule->title = $request->title;
        // $schedule->start_at = $request->start_at;
        // $schedule->end_at = $request->end_at;
        // $schedule->content = $request->content;
        // $schedule->event_day_id = $request->day_id;
        // $schedule->save();

        // $day = EventDay::find($request->day_id);

        // $day->event_schedules()->save($schedule);

        $id = DB::table('event_schedules')->insertGetId(
            [
                'title' => $request->title,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
                'content' => $request->content,
                'event_day_id' => $request->day_id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
        );

        $schedule = EventSchedule::find($id);

        $speakers = collect($request->speakers)->map(function($id){
            return (int)$id;
        });

        if(count($request->speakers)){
            $schedule->event_speakers()->sync($speakers->toArray());
        }

        return response()->json([
                'success'=>true,
                'message'=>'Event Schedule has been added',
                'schedule'=>$schedule
            ]);
    }

    public function postEdit(Request $request)
    {
        // return response()->json($request->all());

        $validator = Validator::make($request->all(),[
            'id'=>'required|exists:event_schedules',
            'day_id'=>'required|exists:event_days,id',
            'title'=>'required',
            'start_at'=>'required',
            'end_at'=>'required',
            'content'=>'required',
        ]);

        if ($validator->fails()) {
        	$res = [
        		'success'=>false,
                'message'=>'Validation error',
                'errors'=>$validator->errors()->all()
        	];
        	return response()->json($res);
        }

        $schedule = EventSchedule::find($request->id);
        $schedule->title = $request->title;
        $schedule->start_at = $request->start_at;
        $schedule->end_at = $request->end_at;
        $schedule->content = $request->content;
        $schedule->day_id = $request->day_id;
        $schedule->content = $request->content;

        $schedule->save();

        return response()->json([
                'success'=>true,
                'message'=>'Event schedule has been updated',
                'schedule'=>$schedule
            ]);
    }

    public function postDelete(Request $request)
    {
        $validator = Validator::make($request->all(),[
        	'id'=>'required|exists:event_schedules'
        ]);

        if ($validator->fails()) {
        	$res = [
        		'success'=>false,
        		'message'=>'<h5>Validation error</h5>'.make_html_list($validator->errors()->all())
        	];
        	return response()->json($res);
        }

        $schedule = EventSchedule::find($request->id);
        $schedule->event_speakers()->detach();
        $schedule->delete();

        return response([
                'success'=>true,
                'message'=>'Event Speaker has been deleted',
                'schedule'=>$schedule
            ])->header('Content-Type','application/json');
    }
}
