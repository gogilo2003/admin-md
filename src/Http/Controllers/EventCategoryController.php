<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\EventCategory;

use Validator;

/**
* EventCategoryController
*/
class EventCategoryController extends Controller
{
	
	function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getEventCategories(Request $request)
	{
		$event_categories = EventCategory::all();
		return view('admin::event_categories.index',compact('event_categories'));
	}

	public function getAdd()
	{
		return view('admin::event_categories.add');
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'title'=>'required|unique:event_categories,name',
			]);

		if ($validator->fails()) {
			return redirect()->back()
							->withInput()
							->withErrors($validator)
							->with('global-warning','Some fields failed validation');
		}

		$category = new EventCategory;

		$category->name = $request->input('title');
		$category->description = $request->input('description');

		$category->save();

		return redirect()
						->route('admin-event_categories')
						->with('global-success','Event Category created');
	}

	public function postEdit(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'id'=>'required|integer|exists:event_categories',
				'title'=>'required|unique:event_categories,name,'.$request->input('id'),
			]);

		if ($validator->fails()) {
			return redirect()->back()
							->withInput()
							->withErrors($validator)
							->with('global-warning','Some fields failed validation');
		}

		$category = EventCategory::find($request->input('id'));

		$category->name = $request->input('title');
		$category->description = $request->input('description');

		$category->save();

		return redirect()
						->route('admin-event_categories')
						->with('global-success','Event Category updated');
	}

	public function getEdit(Request $request, $id)
	{
		$event_category = EventCategory::findOrFail($id);
		return view('admin::event_categories.edit',compact('event_category'));
	}

	public function postPages(Request $request)
	{
		// dd($request->all());
		$cat = EventCategory::find($request->input('id'));
		$cat->pages() ? $cat->pages()->detach($cat->pageIds()) : '';
		$cat->pages()->attach($request->input('pages'));
		
		return redirect()
				->back()
				->with('global-success','Pages related to '.$cat->title.' updated successfuly');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());
		$cat = EventCategory::find($request->input('id'));
		$cat->delete();
		
		return response(['message'=>'File Category deleted'])
				->back('Content-Type','application/json');
	}
}