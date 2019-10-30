<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\PackageCategory;

use Validator;

/**
* PackageCategoryController
*/
class PackageCategoryController extends Controller
{
	
	function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getPackageCategories(Request $request)
	{
		$package_categories = PackageCategory::all();
		return view('admin::package_categories.index',compact('package_categories'));
	}

	public function getAdd()
	{
		return view('admin::package_categories.add');
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'title'=>'required|unique:package_categories,name',
			]);

		if ($validator->fails()) {
			return redirect()->back()
							->withInput()
							->withErrors($validator)
							->with('global-warning','Some fields failed validation');
		}

		$category = new PackageCategory;

		$category->title = str_slug($request->input('title'));
		$category->name = $request->input('title');
		$category->description = $request->input('description');

		$category->save();

		return redirect()
						->route('admin-package_categories')
						->with('global-success','Package Category created');
	}

	public function postEdit(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'id'=>'required|integer|exists:package_categories',
				'title'=>'required|unique:package_categories,name,'.$request->input('id'),
			]);

		if ($validator->fails()) {
			return redirect()->back()
							->withInput()
							->withErrors($validator)
							->with('global-warning','Some fields failed validation');
		}

		$category = PackageCategory::find($request->input('id'));

		$category->title = $request->input('title');
		$category->name = str_slug($request->input('title'));
		$category->description = $request->input('description');

		$category->save();

		return redirect()
						->route('admin-package_categories')
						->with('global-success','Package Category updated');
	}

	public function getEdit(Request $request, $id)
	{
		$package_category = PackageCategory::findOrFail($id);
		return view('admin::package_categories.edit',compact('package_category'));
	}

	public function postPages(Request $request)
	{
		// dd($request->all());
		$cat = PackageCategory::find($request->input('id'));
		$cat->pages() ? $cat->pages()->detach($cat->pageIds()) : '';
		$cat->pages()->attach($request->input('pages'));
		
		return redirect()
				->back()
				->with('global-success','Pages related to '.$cat->title.' updated successfuly');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());
		$cat = PackageCategory::find($request->input('id'));
		$cat->delete();
		
		return response(['message'=>'File Category deleted'])
				->back('Content-Type','application/json');
	}
}
