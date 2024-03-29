<?php

namespace Ogilo\AdminMd\Http\Controllers;

use File;
use Illuminate\Support\Facades\Validator;
use Artisan;

use Illuminate\Http\Request;
use Ogilo\AdminMd\Models\Link;

use Ogilo\AdminMd\Models\Menu;
use Ogilo\AdminMd\Models\Page;
use Ogilo\AdminMd\Http\Controllers\Controller;

/**
 *
 */
class LinkController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getLinks()
	{
		$links = Link::orderBy('order', 'ASC')->get();
		return view('admin::links.index', compact('links'));
	}

	public function getAdd()
	{
		return view('admin::links.add');
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|unique:links|alphanum',
			'caption' => 'required'
		], [
			'name.alphanum' => 'Only letters and numbers are allowed'
		]);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withInput()
				->withErrors($validator)
				->with('global-warning', 'Some fields failed validation, please check and try again');
		}

		$link = new Link;
		$link->name 	= $request->input('name');
		$link->caption 	= $request->input('caption');
		$link->icon 	= $request->input('icon');
		$link->url 		= $request->input('url');

		$menu = $request->has('menu') ? Menu::find($request->input('menu')) : Menu::first();

		$menu->links()->save($link);

		if ($request->has('page')) {
			$page_name = $request->url ?? $request->name;
			$page = new Page();
			$page->name 	= $page_name;
			$page->title 	= $request->input('caption');
			$page->content 	= '<p>' . $request->input('caption') . '...</p>';
			$page->save();
			$page->link()->save($link);

			Artisan::call('admin:make-page', [
				"name" => $page_name
			]);
		}

		return redirect()
			->route('admin-links')
			->with('global-success', 'Link added');
	}

	public function getEdit($id)
	{
		$link = Link::findOrFail($id);
		return view('admin::links.edit', compact('link'));
	}

	public function postEdit(Request $request)
	{
		$id = $request->input('id');

		$validator = Validator::make($request->all(), [
			'name' => 'required|alphanum|unique:pages,name,' . $id,
			'caption' => 'required'
		], [
			'name.alphanum' => 'Only letters and numbers are allowed'
		]);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withInput()
				->withErrors($validator)
				->with('global-warning', 'Some fields failed validation, please check and try again');
		}

		$link = Link::findOrFail($id);
		$link->name 	= $request->input('name');
		$link->caption 	= $request->input('caption');
		$link->icon 	= $request->input('icon');
		$link->url 		= $request->input('url');
		$link->menu_id 	= $request->input('menu');
		$link->save();

		return redirect()
			->route('admin-links')
			->with('global-success', 'Link ' . $link->name . ' Updated');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());

		$link = Link::findOrFail($request->input('id'));
		$name = $link->name;
		$link->delete();

		/*return redirect()
				->route('admin-links')
				->with('global-success','Link '.$name.' Deleted');*/
	}

	public function postOrder(Request $request)
	{

		foreach ($request->rows as $key => $row) {
			$link = Link::find($row['id']);
			$link->order = $row['order'];
			$link->save();
		}

		return response(['success' => true, 'msg' => 'Links order updated'])->header('Content-Type', 'application/json');
	}
}
