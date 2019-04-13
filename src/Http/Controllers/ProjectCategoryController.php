<?php 

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\ProjectCategory;

use Validator;

/**
* 
*/
class ProjectCategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getProjectCategories()
	{
		$project_categories = ProjectCategory::all();
		return view('admin::project_categories.index',compact('project_categories'));
	}

	public function getAdd()
	{
		return view('admin::project_categories.add');
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'title'=>'required|unique:project_categories,title',
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$project_category = new ProjectCategory;

		$project_category->name 		= str_slug($request->input('title'));
		$project_category->title 		= $request->input('title');
		$project_category->description 	= $request->input('description');

		$project_category->save();
		
		return redirect()
				->route('admin-project_categories')
				->with('global-success','Project Category Created Successfully');
	}

	public function getEdit($id)
	{
		$project_category = ProjectCategory::find($id);
		return view('admin::project_categories.edit',compact('project_category'));
	}

	public function postEdit(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'id'=>'required|integer',
				'title' => 'required|unique:project_categories,title,'.$request->input('id'),
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$project_category = ProjectCategory::find($request->input('id'));

		$project_category->name 		= str_slug($request->input('title'));
		$project_category->title 		= $request->input('title');
		$project_category->description  = $request->input('description');

		$project_category->save();
		
		return redirect()
				->route('admin-project_categories')
				->with('global-success','Project category updated');
		
	}

	public function postPages(Request $request)
	{
		// dd($request->all());
		$cat = ProjectCategory::find($request->input('id'));
		$cat->pages()->detach($cat->pageIds());
		$cat->pages()->attach($request->input('pages'));
		
		return redirect()
				->back()
				->with('global-success','Pages related to '.$cat->name.' updated successfuly');
	}

	public function postDelete(Request $request)
	{
		// return response($request->all())->header('Content-Type','application/json');
		$cat = ProjectCategory::find($request->input('id'));
		$cat->delete();
		
		return redirect(['message'=>'Project category deleted successfuly'])
				->header('Content-Type','application/json');
	}

}