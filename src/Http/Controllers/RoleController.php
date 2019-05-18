<?php 

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\AdminRole;

use Validator;

/**
* 
*/
class RoleController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getRoles()
	{
		$roles = AdminRole::all();
		return view('admin::roles.index',compact('roles'));
	}

	public function getAdd()
	{
		return view('admin::roles.add');
	}

	public function postAdd(Request $request)
	{
		// $roles = $request->all();//implode(',', $request->input('roles'));
		// dd($roles);
		$validator = Validator::make($request->all(),[
				'name'=>'required|unique:admin_roles',
				'roles'=>'required',
			],[
				'roles.required'=>'You must select at least one role'
			]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->withInput()
					->withErrors($validator)
					->with('global-warning','Some fields failed validation, please check and try again');
		}

		$role = new AdminRole;
		$role->name = $request->input('name');
		$roles = implode(',', $request->input('roles'));
		$role->details = $roles;
		$role->save();

		return redirect()
				->route('admin-roles')
				->with('global-success','Role added');
	}

	public function getEdit($id)
	{
		$role = AdminRole::findOrFail($id);
		return view('admin::roles.edit',compact('role'));
	}

	public function postEdit(Request $request)
	{
		$id = $request->input('id');

		$validator = Validator::make($request->all(),[
				'name'=>'required|unique:admin_roles,name,'.$id,
				'roles'=>'required',
			],[
				'roles.required'=>'You must select at least one role'
			]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->withInput()
					->withErrors($validator)
					->with('global-warning','Some fields failed validation, please check and try again');
		}

		$role = AdminRole::findOrFail($id);
		$role->name = $request->input('name');
		$roles = implode(',', $request->input('roles'));
		$role->details = $roles;
		$role->save();

		return redirect()
				->route('admin-roles')
				->with('global-success','Role '.$role->name.' Updated');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());

		$role = AdminRole::findOrFail($request->input('id'));
		$name = $role->name;
		$role->delete();

		/*return redirect()
				->route('admin-roles')
				->with('global-success','Role '.$name.' Deleted');*/
	}

}