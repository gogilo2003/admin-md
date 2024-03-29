<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Intervention\Image\Facades\Image;
use File;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Ogilo\AdminMd\Models\Page;

use Ogilo\AdminMd\Models\Event;
use Ogilo\AdminMd\Models\EventDay;
use Ogilo\AdminMd\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\EventCategory;
use Ogilo\AdminMd\Models\EventSchedule;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getEvents()
    {

        $events = Event::with('category')->get();
        // dd($events->first()->category);
        return view('admin::events.index', compact('events'));
    }

    public function getAdd()
    {
        $event_categories = EventCategory::all();
        $pages = Page::all();
        return view('admin::events.add', compact('event_categories', 'pages'));
    }

    public function postAdd(Request $request)
    {
        // dd($request->all());
        $cat = EventCategory::find($request->input('event_category'));

        $validator = Validator::make($request->all(), [
            'title'             => 'required|unique:events',
            'event_date'     => 'required|date',
            'picture'        => 'required|image',
            'event_category' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator)
                ->with('global-warning', 'Some eventds failed validation. Please check and try again');
        }

        $event = new Event;

        $event->name = str_slug($request->input('title'));
        $event->title = $request->input('title');
        $event->leader = $request->input('leader');
        $event->held_at = $request->input('event_date');
        $event->end_at = $request->input('end_date');
        $event->location = $request->input('location');
        $event->content = $request->input('content');

        if ($request->hasFile('picture')) {
            $image = Image::make($request->file('picture')->getRealPath());

            $dir = public_path('images/events/');

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, TRUE);
            }
            if (!File::exists($dir . 'thumbnails/')) {
                File::makeDirectory($dir . 'thumbnails/', 0755, TRUE);
            }

            $filename = time() . '.jpg';
            $image->save($dir . $filename);

            $image->fit(160, 160);
            $image->save($dir . 'thumbnails/' . $filename);

            $image->destroy();

            $event->picture = $filename;
        }

        $cat->events()->save($event);

        foreach (get_event_days($event->held_at, $event->end_at) as $key => $dt) {
            $day = new EventDay();
            $day->day = $dt;
            $day->title = "Day " . ($key + 1);
            $day->event_id = $event->id;
            $day->save();
        }

        return redirect()
            ->route('admin-events')
            ->with('global-success', 'Event added');
    }

    public function deleteSchedule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:event_schedules'
        ]);

        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => '<h4>Validation error</h4>' . make_html_list($validator->errors()->all())
            ];
            return response()->json($res);
        }

        $schedule = EventSchedule::find($request->id);

        $schedule->delete();

        $res = [
            'success' => true,
            'message' => 'Event schedule deleted'
        ];

        return response()->json($res);
    }

    public function getEdit($id)
    {
        $event_categories = EventCategory::all();
        $event = Event::find($id);
        $pages = Page::all();
        return view('admin::events.edit', compact('event_categories', 'pages', 'event'));
    }

    public function postEdit(Request $request)
    {
        $cat = EventCategory::find($request->input('event_category'));

        // dd($cat->mimes);

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:events',
            'title'            => 'required|unique:events,title,' . $request->input('id'),
            'event_category' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator)
                ->with('global-warning', 'Some eventds failed validation. Please check and try again');
        }

        $event = Event::find($request->input('id'));

        if ($request->hasFile('picture')) {

            $dir = public_path('images/events/');

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, TRUE);
            }
            if (!File::exists($dir . 'thumbnails/')) {
                File::makeDirectory($dir . 'thumbnails/', 0755, TRUE);
            }

            $filename = time() . '.jpg';

            $old_picture = $dir . $event->picture;

            if (file_exists($old_picture)) {
                chmod($old_picture, 0777);
                unlink($old_picture);
            }
            $old_picture = $dir . 'thumbnails/' . $event->picture;

            if (file_exists($old_picture)) {
                chmod($old_picture, 0777);
                unlink($old_picture);
            }

            $image = Image::make($request->file('picture')->getRealPath());
            $image->save($dir . $filename);

            $image->fit(160, 160);
            $image->save($dir . 'thumbnails/' . $filename);

            $image->destroy();

            $event->picture = $filename;
        }

        $event->name = str_slug($request->input('title'));
        $event->title = $request->input('title');
        $event->leader = $request->input('leader');
        $event->held_at = $request->input('event_date');
        $event->end_at = $request->input('end_date');
        $event->location = $request->input('location');
        $event->content = $request->input('content');

        $cat->events()->save($event);

        $event->event_days()->whereNotBetween('day', [$event->held_at, $event->end_at])->delete();

        foreach (get_event_days($event->held_at, $event->end_at) as $key => $dt) {
            $day = EventDay::whereDate('day', $dt)->where('event_id', $event->id)->first();

            if (!$day) {
                $day = new EventDay();
            }
            $day->day = $dt;
            $day->title = "Day " . ($key + 1);
            $day->event_id = $event->id;
            $day->save();
        }

        return redirect()
            ->route('admin-events')
            ->with('global-success', 'Event updated');
    }

    public function postDelete(Request $request)
    {
        $event = Event::find($request->input('id'));

        $dir = public_path('images/events/');

        $old_picture = $dir . $event->picture;

        if (file_exists($old_picture)) {
            try {
                chmod($old_picture, 0777);
            } catch (Exception $e) {
            }
            try {
                unlink($old_picture);
            } catch (Exception $e) {
            }
        }
        $old_picture = $dir . 'thumbnails/' . $event->picture;

        if (file_exists($old_picture)) {
            try {
                chmod($old_picture, 0777);
            } catch (Exception $e) {
            }
            try {
                unlink($old_picture);
            } catch (Exception $e) {
            }
        }

        $event->delete();

        return response(['message' => 'Event has been deleted'])
            ->header('Content-Type', 'application/json');
    }

    public function postPublish(Request $request)
    {
        $event = Event::find($request->input('id'));
        $event->published = !$event->published;
        $event->save();

        return response(['message' => $event->published ? 'Event has been published' : 'Event has been un-published'])
            ->header('Content-Type', 'application/json');
    }

    public function postFeature(Request $request)
    {
        $event = Event::find($request->input('id'));
        $event->featured = $event->featured ? 0 : 1;
        $event->save();

        return response(['message' => $event->featured ? 'Event has been featured' : 'Event has been un-featured'])
            ->header('Content-Type', 'application/json');
    }
}
