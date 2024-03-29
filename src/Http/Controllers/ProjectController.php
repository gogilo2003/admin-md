<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use Ogilo\AdminMd\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Project;
use Ogilo\AdminMd\Models\ProjectCategory;
use Ogilo\AdminMd\Models\Page;

use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

/**
 *
 */
class ProjectController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getProjects()
	{
		$projects = Project::all();
		return view('admin::projects.index', compact('projects'));
	}

	public function getAdd()
	{
		return view('admin::projects.add');
	}

	public function postAdd(Request $request)
	{
		// $projects = $request->all();//implode(',', $request->input('projects'));
		// dd($projects);
		$validator = Validator::make($request->all(), [
			'title'		=> 'required|unique:projects',
			'content'	=> 'required',
			'category'	=> 'integer',
			'picture'	=> 'image',
		]);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withInput()
				->withErrors($validator)
				->with('global-warning', 'Some fields failed validation, please check and try again');
		}

		$project = new Project;

		if ($request->hasFile('picture')) {
			$picture = $request->file('picture');

			$image = Image::make($picture->getRealPath());

			$dir = public_path('images/projects/');
			if (!file_exists($dir)) {
				mkdir($dir, 0755, true);
			}

			$filename = time() . '.jpg';
			$image->save($dir . $filename);
			$image->destroy();

			if (!file_exists($dir . '160x160/')) {
				mkdir($dir . '160x160/', 0755, true);
			}

			$square = Image::make($picture->getRealPath());
			$square->fit(160, 160);
			$square->save($dir . '160x160/' . $filename);
			$square->destroy();

			if (!file_exists($dir . '480x240/')) {
				mkdir($dir . '480x240/', 0755, true);
			}

			$rectangle 	= Image::make($picture->getRealPath());
			$rectangle->fit(480, 240);
			$rectangle->save($dir . '480x240/' . $filename);
			$rectangle->destroy();

			$project->picture = $filename;
		}


		$project->name 		= str_slug($request->input('title'));
		$project->title 	= $request->input('title');
		$project->picture 	= $request->input('picture');
		$project->content 	= $request->input('content');

		$category 	= ProjectCategory::find($request->input('category'));

		$category->projects()->save($project);

		return redirect()
			->route('admin-projects')
			->with('global-success', 'Project added');
	}

	public function getEdit($id)
	{
		$project = Project::findOrFail($id);
		return view('admin::projects.edit', compact('project'));
	}

	public function postEdit(Request $request)
	{
		// dd($request->all());

		$id = $request->input('id');

		$validator = Validator::make($request->all(), [
			'id'		=> 'required|integer',
			'title'		=> 'required|unique:projects,id,' . $id,
			'content'	=> 'required',
			'category'	=> 'integer',
			'picture'	=> 'image',
		]);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withInput()
				->withErrors($validator)
				->with('global-warning', 'Some fields failed validation, please check and try again');
		}

		$project = Project::find($id);

		if ($request->hasFile('picture')) {

			$picture = $request->file('picture');

			$image = Image::make($picture->getRealPath());

			$dir = public_path('images/projects/');
			if (!file_exists($dir)) {
				mkdir($dir, 0755, true);
			}

			$filename = $project->picture ? $project->picture : time() . '.jpg';
			$image->save($dir . $filename);
			$image->destroy();

			if (!file_exists($dir . '160x160/')) {
				mkdir($dir . '160x160/', 0755, true);
			}

			$square = Image::make($picture->getRealPath());
			$square->fit(160, 160);
			$square->save($dir . '160x160/' . $filename);
			$square->destroy();

			if (!file_exists($dir . '480x240/')) {
				mkdir($dir . '480x240/', 0755, true);
			}

			$rectangle 	= Image::make($picture->getRealPath());
			$rectangle->fit(480, 240);
			$rectangle->save($dir . '480x240/' . $filename);
			$rectangle->destroy();

			$project->picture = $filename;
		}


		$project->name 					= str_slug($request->input('title'));
		$project->title 				= $request->input('title');
		$project->content 				= $request->input('content');
		$project->project_category_id 	= $request->input('category');

		$project->save();

		return redirect()
			->route('admin-projects')
			->with('global-success', 'Project ' . $project->name . ' Updated');
	}

	public function postPublish(Request $request)
	{
		// dd($request->all());

		$project = Project::findOrFail($request->input('id'));
		$project->published = $project->published ? 0 : 1;
		$name = $project->title;
		$project->save();

		return response(["message" => "Project $name " . ($project->published ? "Published" : "Un published") . " successfully"])
			->header('Content-Type', 'application/json');

		// return redirect()
		// 		->route('admin-projects')
		// 		->with('global-success','Project '.$name.' Deleted');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());

		$project = Project::findOrFail($request->input('id'));
		$name = $project->name;
		$project->delete();

		return response(["message" => "Project $name Deleted"])
			->header('Content-Type', 'application/json');

		// return redirect()
		// 		->route('admin-projects')
		// 		->with('global-success','Project '.$name.' Deleted');
	}
}
