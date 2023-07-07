<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use Ogilo\AdminMd\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\FileCategory;

use Illuminate\Support\Facades\Validator;

/**
 *
 */
class FileCategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getFileCategories()
	{
		$file_categories = FileCategory::all();
		return view('admin::file_categories.index', compact('file_categories'));
	}

	public function getAdd()
	{
		return view('admin::file_categories.add');
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required|unique:file_categories,title',
			'max_size' => 'integer',
		]);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withErrors($validator)
				->withInput()
				->with('global-warning', 'Some fields failed validation. Please check and try again');
		}

		$file_category = new FileCategory;

		$file_category->name 		= str_slug($request->input('title'));
		$file_category->title 		= $request->input('title');
		$file_category->max_size 	= $request->input('max_size');
		$file_category->mimes 		= $request->input('file_types');
		$file_category->description = $request->input('description');

		$file_category->save();

		return redirect()
			->route('admin-file_categories')
			->with('global-success', 'File Category Created Successfully');
	}

	public function getEdit($id)
	{
		$file_category = FileCategory::find($id);
		return view('admin::file_categories.edit', compact('file_category'));
	}

	public function postEdit(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required|unique:file_categories,title,' . $request->input('id'),
			'max_size' => 'integer',
		]);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withErrors($validator)
				->withInput()
				->with('global-warning', 'Some fields failed validation. Please check and try again');
		}

		$file_category = FileCategory::find($request->input('id'));

		$file_category->name 		= str_slug($request->input('title'));
		$file_category->title 		= $request->input('title');
		$file_category->max_size 	= $request->input('max_size');
		$file_category->mimes 		= $request->input('file_types');
		$file_category->description = $request->input('description');

		$file_category->save();

		return redirect()
			->route('admin-file_categories')
			->with('global-success', 'File category updated');
	}

	public function postPages(Request $request)
	{
		// dd($request->all());
		$cat = FileCategory::find($request->input('id'));
		$cat->pages() ? $cat->pages()->detach($cat->pageIds()) : '';
		$cat->pages()->attach($request->input('pages'));

		return redirect()
			->back()
			->with('global-success', 'Pages related to ' . $cat->title . ' updated successfully');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());
		$cat = FileCategory::find($request->input('id'));
		$cat->delete();

		return response(['message' => 'File Category deleted'])
			->back('Content-Type', 'application/json');
	}
}
