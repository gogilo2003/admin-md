<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use Ogilo\AdminMd\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Admin;
use Ogilo\AdminMd\Models\AdminRole;
use Ogilo\AdminMd\Services\AdminService;

use Illuminate\Support\Facades\Validator;
use File;

/**
 *
 */
class UserController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->middleware('auth:admin');
        $this->adminService = $adminService;
    }

    public function getUsers()
    {
        $users = $this->adminService->getAllAdmins();
        return view('admin::users.index', compact('users'));
    }

	public function getAdd()
	{
		return view('admin::users.add');
	}

    public function postAdd(Request $request)
    {
        // $users = $request->all();//implode(',', $request->input('users'));
        // dd($users);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:admins',
            'email' => 'required|email|unique:admins',
            'role' => 'required|integer',
        ], [
            'users.required' => 'You must select at least one user'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator)
                ->with('global-warning', 'Some fields failed validation, please check and try again');
        }

        $role = AdminRole::find($request->input('role'));

        $user = $this->adminService->createAdmin([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => str_random(6),
            'admin_role_id' => $role->id,
        ]);

        return redirect()
            ->route('admin-users')
            ->with('global-success', 'Admin added');
    }

	public function getEdit($id)
	{
		$user = Admin::findOrFail($id);
		return view('admin::users.edit', compact('user'));
	}

    public function postEdit(Request $request)
    {
        $id = $request->input('id');

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:admins,name,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
            'role' => 'required|integer',
        ], [
            'users.required' => 'You must select at least one user'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator)
                ->with('global-warning', 'Some fields failed validation, please check and try again');
        }

        $this->adminService->updateAdmin($id, [
            'name' => $request->input('name'),
            'admin_role_id' => $request->input('role'),
        ]);

        return redirect()
            ->route('admin-users')
            ->with('global-success', 'Admin Updated');
    }

	public function postDelete(Request $request)
	{
		// dd($request->all());

		$user = Admin::findOrFail($request->input('id'));
		$name = $user->name;
		$user->delete();

		/*return redirect()
				->route('admin-users')
				->with('global-success','Admin '.$name.' Deleted');*/
	}

	public function postActivate(Request $request)
	{
		// dd($request->all());

		$user = Admin::findOrFail($request->input('id'));
		$user->active = $user->active ? 0 : 1;
		$user->save();

		/*return redirect()
				->route('admin-users')
				->with('global-success','Admin '.$name.' Deleted');*/
	}

    public function postPassword(Request $request)
    {
        $user = Admin::findOrFail($request->input('id'));
        $password = $this->adminService->generatePassword();
        $this->adminService->updateAdminPassword($user->id, $password);
    }
}
