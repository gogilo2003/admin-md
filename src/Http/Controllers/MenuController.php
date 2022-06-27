<?php 

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Menu;

use Validator;
use File;

/**
* 
*/
class MenuController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getMenus()
	{
		$menus = Menu::all();
		return view('admin::menus.index',compact('menus'));
	}

	public function getAdd()
	{
		return view('admin::menus.add');
	}

	public function postAdd(Request $request)
	{
		// $menus = $request->all();//implode(',', $request->input('menus'));
		// dd($menus);
		$validator = Validator::make($request->all(),[
				'name'=>'required|unique:pages|alphanum',
				'caption'=>'required'
			],[
				'name.alphanum'=>'Only letters and numbers are allowed'
			]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->withInput()
					->withErrors($validator)
					->with('global-warning','Some fields failed validation, please check and try again');
		}

		$menu = new Menu;
		$menu->name 	= $request->input('name');
		$menu->caption 	= $request->input('caption');
		$menu->icon 	= $request->input('icon');
		
		$menu->save();

		return redirect()
				->route('admin-menus')
				->with('global-success','Menu added');
	}

	public function getEdit($id)
	{
		$menu = Menu::findOrFail($id);
		return view('admin::menus.edit',compact('menu'));
	}

	public function postEdit(Request $request)
	{
		$id = $request->input('id');

		$validator = Validator::make($request->all(),[
				'name'=>'required|alphanum|unique:pages,name,'.$id,
				'caption'=>'required'
			],[
				'name.alphanum'=>'Only letters and numbers are allowed'
			]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->withInput()
					->withErrors($validator)
					->with('global-warning','Some fields failed validation, please check and try again');
		}

		$menu = Menu::findOrFail($id);
		$menu->name 	= $request->input('name');
		$menu->caption 	= $request->input('caption');
		$menu->icon 	= $request->input('icon');
		$menu->save();

		return redirect()
				->route('admin-menus')
				->with('global-success','Menu '.$menu->name.' Updated');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());

		$menu = Menu::findOrFail($request->input('id'));
		$name = $menu->name;
		$menu->delete();

		/*return redirect()
				->route('admin-menus')
				->with('global-success','Menu '.$name.' Deleted');*/
	}

}