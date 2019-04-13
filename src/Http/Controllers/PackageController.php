<?php
namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Package;
use Ogilo\AdminMd\Models\PackagePicture;
use Img;

use Validator;

/**
* PackageController
*/
class PackageController extends Controller
{
	
	public function getPackages()
	{
		$packages = Package::orderBy('id','DESC')->get();
		return view('admin::packages.index',compact('packages'));
	}

	public function getAdd()
	{
		return view('admin::packages.add');
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'title'=>'required|unique:packages,title',
			'from'=>'date',
			'to'=>'date',
			'price'=>'numeric',
		]);

		if($validator->fails()){
			return redirect()
					->back()
					->withInput()
					->withErrors($validator)
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$package = new Package;

		$package->title = $request->title;
		$package->price = $request->price;
		$package->start_at = $request->from;
		$package->end_at = $request->to;
		$package->summary = $request->summary;
		$package->details = $request->details;

		$package->save();

		return redirect()
				->route('admin-packages')
				->with('global-success','Package Added');
	}

	public function getPictures($id)
	{
		$package = Package::with(['pictures'=>function($query){
			$query->orderBy('id','DESC');
		}])->where('id',$id)->first();
		return view('admin::packages.pictures',compact('package'));
	}

	public function postPictures(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'title'=>'required',
			'picture'=>'required|image',
		]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->withInput()
					->withErrors($validator)
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		

		if ($request->hasFile('picture')) {
			$image = Img::make($request->file('picture')->getRealPath());
			$dir = public_path('images/packages/');

			if (!file_exists($dir)) {
				mkdir($dir, 0777, TRUE);
			}

			$filename = time().'.jpg';
			$image->save($dir.$filename);
			$image->destroy();

			$dir = public_path('images/packages/630x450/');
			if (!file_exists($dir)) {
				mkdir($dir, 0777, TRUE);
			}
			$image = Img::make($request->file('picture')->getRealPath());
			$image->fit(630,450);
			$image->save($dir.$filename);
			$image->destroy();

			$dir = public_path('images/packages/384x256/');
			if (!file_exists($dir)) {
				mkdir($dir, 0777, TRUE);
			}
			$image = Img::make($request->file('picture')->getRealPath());
			$image->fit(384,256);
			$image->save($dir.$filename);
			$image->destroy();

			$dir = public_path('images/packages/100x100/');
			if (!file_exists($dir)) {
				mkdir($dir, 0777, TRUE);
			}
			$image = Img::make($request->file('picture')->getRealPath());
			$image->fit(100,100);
			$image->save($dir.$filename);
			$image->destroy();

			$picture = new PackagePicture;
			$package = Package::find($request->package_id);
			if($request->has('primary_picture')){
				$package->pictures()->update(['primary'=>false]);
				$picture->primary = true;
			}else{
				$pictures = $package->pictures()->where('primary','=',1)->get();
				if (!$picture->count()) {
					$picture->primary = true;
				}
			}

			$picture->title = $request->title;
			$picture->picture = $filename;
			
			$package->pictures()->save($picture);

			return redirect()
					->back()
					->with('global-success','Picture added');
		}

		return redirect()
				->back()
				->withInput()
				->with('global-danger','There was a problem adding your picture');


	}

	public function getEdit($id)
	{
		$package = Package::find($id);
		return view('admin::packages.edit',compact('package'));
	}

	public function postEdit(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'title'=>'required|unique:packages,title,'.$request->id.',id',
			'from'=>'date',
			'to'=>'date',
			'price'=>'numeric',
			'id'=>'required|exists:packages'
		]);

		if($validator->fails()){
			return redirect()
					->back()
					->withInput()
					->withErrors($validator)
					->with('global-warning','Some fields failed validation. Please check and try again');
		}

		$package = Package::find($request->id);

		$package->title = $request->title;
		$package->price = $request->price;
		$package->start_at = $request->from;
		$package->end_at = $request->to;
		$package->summary = $request->summary;
		$package->details = $request->details;

		$package->save();

		return redirect()
				->route('admin-packages')
				->with('global-success','Package Updated');
	}

	public function postPublish(Request $request)
	{
		$package = Package::find($request->input('id'));
		$package->published = !$package->published;
		$package->save();

		return response(["message"=>$package->published ? "Package published successfuly" : "Package un-published successfuly"])->header('Content-Type','application/json');
	}
	
	public function postPages(Request $request)
	{
		// dd($request->all());
		$package = Package::find($request->input('id'));
		$package->pages()->detach($package->pageIds());
		$package->pages()->attach($request->input('pages'));
		
		return redirect()
				->back()
				->with('global-success','Pages related to '.$package->name.' updated successfuly');
	}

}