<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use File;
use Validator;
use Illuminate\Http\Request;
use Ogilo\AdminMd\Models\Page;

use Ogilo\AdminMd\Models\Event;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\EventSpeaker;

/**
*
*/
class EventSpeakerController extends Controller
{

    public function getEventSpeakers(Request $request)
    {
        $validator = Validator::make($request->all(),[
        	'id'=>'required|exists:events'
        ]);

        if ($validator->fails()) {
        	$res = [
        		'success'=>false,
        		'message'=>'<h5>Validation error</h5>'.make_html_list($validator->errors()->all())
        	];
        	return response()->json($res);
        }

        $event = Event::with('event_speakers')->find($request->id);

        $speakers = $event->event_speakers;

        return response([
                'success'=>true,
                'speakers'=>$speakers
            ])->header('Content-Type','application/json');
    }

    public function postAdd(Request $request)
    {
        // return response()->json($request->all());

        $validator = Validator::make($request->all(),[
            'id'=>'required|exists:events',
            'name'=>'required',
            'email'=>'nullable|email',
            'photo'=>'nullable|image',
        ]);

        if ($validator->fails()) {
        	$res = [
        		'success'=>false,
                'message'=>'Validation error',
                'errors'=>$validator->errors()->all()
        	];
        	return response()->json($res);
        }

        $speaker = new EventSpeaker();
        if($request->hasFile('photo')){
            $photo = $request->photo;
            $dir = public_path('images/events/speakers');
            if(!\file_exists($dir)){
                \mkdir($dir,0777,TRUE);
            }
            $filename = time().'.'.$photo->getClientOriginalExtension();
            $photo->move($dir,$filename);
            $speaker->photo = $filename;
        }

        $speaker->name = $request->name;
        $speaker->email = $request->email;
        $speaker->phone = clean_isdn($request->phone);
        $speaker->email = $request->email;
        $speaker->facebook = $request->facebook;
        $speaker->twitter = $request->twitter;
        $speaker->twitter = $request->twitter;
        $speaker->twitter = $request->twitter;
        $speaker->save();

        $speaker->events()->attach($request->id);

        return response()->json([
                'success'=>true,
                'message'=>'Event Speaker has been added',
                'speaker'=>$speaker
            ]);
    }

    public function postEdit(Request $request)
    {
        // return response()->json($request->all());

        $validator = Validator::make($request->all(),[
            'id'=>'required|exists:event_speakers',
            'event_id'=>'required|exists:events,id',
            'name'=>'required',
            'email'=>'nullable|email',
            'photo'=>'nullable|image',
        ]);

        if ($validator->fails()) {
        	$res = [
        		'success'=>false,
                'message'=>'Validation error',
                'errors'=>$validator->errors()->all()
        	];
        	return response()->json($res);
        }

        $speaker = EventSpeaker::find($request->id);
        if($request->hasFile('photo')){
            $photo = $request->photo;
            $dir = public_path('images/events/speakers');
            if(!\file_exists($dir)){
                \mkdir($dir,0777,TRUE);
            }
            $filename = time().'.'.$photo->getClientOriginalExtension();
            $photo->move($dir,$filename);
            $speaker->photo = $filename;
        }

        $speaker->name = $request->name;
        $speaker->email = $request->email;
        $speaker->phone = clean_isdn($request->phone);
        $speaker->email = $request->email;
        $speaker->facebook = $request->facebook;
        $speaker->twitter = $request->twitter;
        $speaker->twitter = $request->twitter;
        $speaker->twitter = $request->twitter;
        $speaker->save();

        return response()->json([
                'success'=>true,
                'message'=>'Event Speaker has been updated',
                'speaker'=>$speaker
            ]);
    }

    public function postDelete(Request $request)
    {
        $validator = Validator::make($request->all(),[
        	'id'=>'required|exists:event_speakers'
        ]);

        if ($validator->fails()) {
        	$res = [
        		'success'=>false,
        		'message'=>'<h5>Validation error</h5>'.make_html_list($validator->errors()->all())
        	];
        	return response()->json($res);
        }

        $speaker = EventSpeaker::find($request->id);
        $speaker->events()->detach();
        $speaker->event_schedules()->detach();
        $speaker->delete();

        return response([
                'success'=>true,
                'message'=>'Event Speaker has been deleted',
                'speaker'=>$speaker
            ])->header('Content-Type','application/json');
    }
}
