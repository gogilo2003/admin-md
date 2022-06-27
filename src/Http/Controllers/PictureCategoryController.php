<?php 

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\PictureCategory;

use Validator;

/**
* 
*/
class PictureCategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getPictureCategories()
	{
		$categories = PictureCategory::all();
		return view('admin::picture_categories.index',compact('categories'));
	}

	public function getAdd()
	{
		return view('admin::picture_categories.add');
	}

	public function postAdd(Request $request)
	{
		// $categories = $request->all();//implode(',', $request->input('categories'));
		// dd($categories);
		$validator = Validator::make($request->all(),[
				'title'				=>'required|unique:picture_categories',
			]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->withInput()
					->withErrors($validator)
					->with('global-warning','Some fields failed validation, please check and try again');
		}

		$category 				= new PictureCategory;

		$category->name 		= str_slug($request->input('title'));
		$category->title 		= $request->input('title');
		$category->description 	= $request->input('description');
		$category->mimes 		= $request->input('file_extensions');
		$category->max_size 	= $request->input('max_file_size');
		$category->min_height 	= $request->input('min_height');
		$category->min_width 	= $request->input('min_width');
		$category->max_height 	= $request->input('max_height');
		$category->max_width 	= $request->input('max_width');

		$category->save();

		return redirect()
				->route('admin-picture_categories')
				->with('global-success','PictureCategory added');
	}

	public function getEdit($id)
	{
		$category = PictureCategory::findOrFail($id);
		return view('admin::picture_categories.edit',compact('category'));
	}

	public function postEdit(Request $request)
	{
		$id = $request->input('id');

		$validator = Validator::make($request->all(),[
				'title'	=>'required|unique:picture_categories,title,'.$id,
			]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->withInput()
					->withErrors($validator)
					->with('global-warning','Some fields failed validation, please check and try again');
		}

		$category 				= PictureCategory::findOrFail($id);

		$category->name 		= str_slug($request->input('title'));
		$category->title 		= $request->input('title');
		$category->description 	= $request->input('description');
		$category->mimes 		= $request->input('file_extensions');
		$category->max_size 	= $request->input('max_file_size');
		$category->min_height 	= $request->input('min_height');
		$category->min_width 	= $request->input('min_width');
		$category->max_height 	= $request->input('max_height');
		$category->max_width 	= $request->input('max_width');

		$category->save();

		return redirect()
				->route('admin-picture_categories')
				->with('global-success','PictureCategory '.$category->title.' Updated');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());

		$category = PictureCategory::findOrFail($request->input('id'));
		$name = $category->name;
		$category->delete();

		/*return redirect()
				->route('admin-picture_categories')
				->with('global-success','PictureCategory '.$name.' Deleted');*/
	}

	public function postPages(Request $request)
	{
		// dd($request->all());
		$cat = PictureCategory::find($request->input('id'));
		$cat->pages()->detach($cat->pageIds());
		$cat->pages()->attach($request->input('pages'));
		
		return redirect()
				->back()
				->with('global-success','Pages related to article updated successfuly');
	}

}