<?php 

namespace Ogilo\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Ogilo\Admin\Models\Admin;
use Ogilo\Admin\Models\Page;
use Illuminate\Http\Request;

use Img;
use Validator;

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
		
		return view('admin::dashboard',compact('admins'));
	}

	public function postImageUpload(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'file'=>'required|image'
		]);

		if ($validator->fails()) {
			return response('Validation Error',400);
		}
		if ($request->hasFile('file')) {
			$file = $request->file('file');
			if($file->isValid()){
				$dir = public_path('images/upload/');
				if (!file_exists($dir)) {
					mkdir($dir,0755,TRUE);
				}
				$image = Img::make($file->getRealPath());
				$filename = time().'.'.$file->guessClientExtension();
				$image->save($dir.$filename);
				// $photo = $image->encode('data-url')->encoded;
				$photo = url('/public/images/upload/',$filename);
				$image->destroy();

				return response(json_encode(['location'=>$photo]))->header('Content-Type','application/json');
			}
		}
		return response(json_encode(['location'=>url('photo')]))->header('Content-Type','application/json');
	}

}