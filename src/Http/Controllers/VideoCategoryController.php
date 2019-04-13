<?php

namespace Ogilo\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\Admin\Models\VideoCategory;

use File;
use Validator;
/**
* 
*/
class VideoCategoryController extends Controller
{
	
	function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getVideoCategories()
	{
		$video_categories = VideoCategory::all();
		return view('admin::video_categories.index',compact('video_categories'));
	}

	public function getAdd()
	{
		return view('admin::video_categories.add');
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'title' => 'required|unique:video_categories,title',
				'max_size'=>'integer',
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$video_category = new VideoCategory;

		$video_category->name 		= str_slug($request->input('title'));
		$video_category->title 		= $request->input('title');
		$video_category->max_size 	= $request->input('max_size');
		$video_category->mimes 		= $request->input('file_types');
		$video_category->description = $request->input('description');

		$video_category->save();
		return redirect()
				->route('admin-video_categories')
				->with('global-success','Video Category Added');
	}

	public function getEdit($id)
	{
		$video_category = VideoCategory::find($id);
		return view('admin::video_categories.edit',compact('video_category'));
	}

	public function postEdit(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'title' => 'required|unique:video_categories,title,'.$request->input('id'),
				'max_size'=>'integer',
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$video_category = VideoCategory::find($request->input('id'));

		$video_category->name 		= str_slug($request->input('title'));
		$video_category->title 		= $request->input('title');
		$video_category->max_size 	= $request->input('max_size');
		$video_category->mimes 		= $request->input('file_types');
		$video_category->description = $request->input('description');

		$video_category->save();
		return redirect()
				->route('admin-video_categories')
				->with('global-success','Video Category Updated');
	}

	public function postPages(Request $request)
	{
		// dd($request->all());
		$cat = VideoCategory::find($request->input('id'));
		$cat->pages()->detach($cat->pageIds());
		$cat->pages()->attach($request->input('pages'));
		
		return redirect()
				->back()
				->with('global-success','Pages related to '.$cat->title.' updated successfuly');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());
		$cat = VideoCategory::find($request->input('id'));
		$cat->delete();
		
		return response(['message'=>'Video Category deleted'])
				->back('Content-Type','application/json');
	}
	
}