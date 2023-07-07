<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use Ogilo\AdminMd\Models\Admin;
use Ogilo\AdminMd\Models\AdminRole;
use Ogilo\AdminMd\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('admin::auth.login');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator)
                ->with('global-warning', 'Some fields failed validation. Please check and try again');
        }

        $admin = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'active' => 1
        ];

        if (Admin::all()->count() == 0) {
            $role = new AdminRole;
            $role->name = 'Admin';
            $role->details = admin_roles();
            $role->save();
            $new_admin = new Admin();
            $new_admin->name         = "System Admin";
            $new_admin->email         = $request->input('email');
            $new_admin->password     = bcrypt($request->input('password'));
            $new_admin->active      = 1;
            $role->admins()->save($new_admin);
        }

        if (Auth::guard('admin')->attempt($admin)) {

            $user = Auth::guard('admin')->user();

            $token = $user->createToken('token');

            $user->api_token = \Illuminate\Support\Str::random(32);
            $user->save();

            return response()->json([
                "success" => true,
                "message" => 'Authentication Successful',
                "token" => $token->plainTextToken
            ]);

            // return redirect()
            //     ->intended('admin')
            //     ->with('global-success', 'Authentication Successful')
            //     ->with('token', $token);
        }

        return redirect()
            ->back()
            ->with('global-danger', 'Authentication Failed!');
    }

    public function getLogout()
    {
        Auth::guard('admin')->user()->tokens()->delete();
        Auth::guard('admin')->logout();
        return redirect()->route('admin-login');
    }

    public function getProfile()
    {
        $user = Auth::guard('admin')->user();
        return view('admin::profile', compact('user'));
    }

    public function postProfile(Request $request)
    {
        $id = Auth::guard('admin')->id();
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:admins,name,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator)
                ->with('global-warning', 'Some Fields failed validation. Please check and try again');
        }

        $user = Admin::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect()
            ->back('global-success', 'Profile updated');
    }

    public function getPassword()
    {
        return view('admin::auth.password');
    }

    function postPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator)
                ->with('global-warning', 'Some fields failed validation. Please check and try again');
        }

        $user = Auth::guard('admin')->user();

        if (Hash::check($request->password, $user->password)) {
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()
                ->back()
                ->with('global-success', 'Password change successful');
        }

        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['password' => 'Wrong old password'])
            ->with('global-danger', 'Failed to authenticate request');
    }
}
