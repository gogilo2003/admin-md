<?php 

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\ArticleCategory;

use Validator;

/**
* 
*/
class ArticleCategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getArticleCategories()
	{
		$article_categories = ArticleCategory::all();
		return view('admin::article_categories.index',compact('article_categories'));
	}

	public function getAdd()
	{
		return view('admin::article_categories.add');
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'name'=>'required|unique:article_categories,name',
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$article_category = new ArticleCategory;

		$article_category->name 		= $request->input('name');
		$article_category->description 	= $request->input('description');

		$article_category->save();
		
		return redirect()
				->route('admin-article_categories')
				->with('global-success','Article Category Created Successfully');
	}

	public function getEdit($id)
	{
		$article_category = ArticleCategory::find($id);
		return view('admin::article_categories.edit',compact('article_category'));
	}

	public function postEdit(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'id'=>'required|integer',
				'name' => 'required|unique:article_categories,name,'.$request->input('id'),
			]);

		if($validator->fails()){
			return redirect()
					->back()
					->withErrors($validator)
					->withInput()
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$article_category = ArticleCategory::find($request->input('id'));

		$article_category->name 		= $request->input('name');
		$article_category->description  = $request->input('description');

		$article_category->save();
		
		return redirect()
				->route('admin-article_categories')
				->with('global-success','Article category updated');
		
	}

	public function postPages(Request $request)
	{
		// dd($request->all());
		$cat = ArticleCategory::find($request->input('id'));
		$cat->pages()->detach($cat->pageIds());
		$cat->pages()->attach($request->input('pages'));
		
		return redirect()
				->back()
				->with('global-success','Pages related to '.$cat->name.' updated successfuly');
	}

}