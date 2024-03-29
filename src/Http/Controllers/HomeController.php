<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Ogilo\AdminMd\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Admin;
use Ogilo\AdminMd\Models\Page;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
class HomeController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except('login');
	}

	public function getDashboard()
	{
		$admins = Admin::all();

		return view('admin::dashboard', compact('admins'));
	}

	public function postImageUpload(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'file' => 'required|image'
		]);

		if ($validator->fails()) {
			return response('Validation Error', 400);
		}
		if ($request->hasFile('file')) {
			$file = $request->file('file');
			if ($file->isValid()) {
				$dir = public_path(config('admin.path_prefix') . 'images/upload/');
				if (!file_exists($dir)) {
					mkdir($dir, 0755, TRUE);
				}
				$image = Image::make($file->getRealPath());
				$filename = time() . '.' . $file->guessClientExtension();
				$image->save($dir . $filename);
				// $photo = $image->encode('data-url')->encoded;
				$photo = url(config('admin.path_prefix') . 'images/upload/', $filename);
				$image->destroy();

				return response(json_encode(['location' => $photo]))->header('Content-Type', 'application/json');
			}
		}
		return response(json_encode(['location' => url('photo')]))->header('Content-Type', 'application/json');
	}
}
