<?php
namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\PictureCategory;
use Ogilo\AdminMd\Models\Page;
use Ogilo\AdminMd\Models\Link;

use Validator;
use File;
use Ogilo\AdminMd\Models\Picture;

use Intervention\Image\ImageManagerStatic as Image;

/**
* 
*/
class PictureController extends Controller
{
	
	public function getPictures()
	{
		$pictures = Picture::with('category')->orderBy('id','DESC')->paginate(2);
		return view('admin::pictures.index',compact('pictures'));
	}

	public function getAdd()
	{
		$categories = PictureCategory::all();
		$pages = Page::all();
		$links = Link::all();
		return view('admin::pictures.add',compact('categories','pages','links'));
	}

	public function postAdd(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'name' 				=> 'required|image',
				'picture_category' 	=> 'required',
				'url' 				=> 'nullable|url'
			]);

		if($validator->fails()){
			return redirect()
						->back()
						->withInput()
						->withErrors($validator)
						->with('global-warning','Some fields failed validation. Please check and try again');
		}

		Image::configure(array('driver' => 'imagick'));

		$picture = new Picture;

		$filename 	= time().'.jpg';
		$dir 		= public_path('images/pictures');

		if(!File::exists($dir)){
			File::makeDirectory($dir,0755,TRUE);
		}

		$cat = PictureCategory::find($request->input('picture_category'));

		$image = Image::make($request->file('name')->getRealPath());
		$image->fit($cat->max_width,$cat->max_height);
		$image->save($dir.'/'.$filename);
		$image->destroy();

		if(!File::exists($dir.'/thumbnails')){
			File::makeDirectory($dir.'/thumbnails',0755,TRUE);
		}

		$thumbnail = Image::make($request->file('name')->getRealPath());
		$thumbnail->fit(128,128);
		$thumbnail->save($dir.'/thumbnails/'.$filename);
		$thumbnail->destroy();

		$picture->name 					= $filename;
		$picture->alt 					= $request->input('alt');
		$picture->caption 				= $request->input('caption');
		$picture->title 				= $request->input('title');
		$picture->url 				= $request->input('url');
		// $picture->picture_category_id 	= $request->input('picture_category');


		$cat->pictures()->save($picture);

		return redirect()
				->route('admin-pictures')
				->with('global-success','Picture added successfuly');
	}

	public function getEdit($id)
	{
		$categories = PictureCategory::all();
		$pages = Page::all();
		$links = Link::all();
		$picture = Picture::find($id);
		return view('admin::pictures.edit',compact('categories','pages','links','picture'));
	}

	public function postEdit(Request $request)
	{
		$validator = Validator::make($request->all(),[
				'name' 				=> 'image',
				'picture_category' 	=> 'required',
				'url'				=> 'nullable|url'
			]);

		if($validator->fails()){
			return redirect()
						->back()
						->withInput()
						->withErrors($validator)
						->with('global-warning','Some fields failed validation. Please check and try again');
		}
		$picture = Picture::find($request->input('id'));
		if($request->hasFile('name')){
			Image::configure(array('driver' => 'imagick'));

			$image 		= Image::make($request->file('name')->getRealPath());

			$filename 	= $picture->name ? $picture->name : time().'.jpg';
			$dir 		= public_path('images/pictures');

			if(!File::exists($dir)){
				File::makeDirectory($dir,0755,TRUE);
			}

			$cat = PictureCategory::find($request->picture_category);
			$image->fit($cat->max_width,$cat->max_height);
			$image->save($dir.'/'.$filename);
			$image->destroy();

			if(!File::exists($dir.'/thumbnails')){
				File::makeDirectory($dir.'/thumbnails',0755,TRUE);
			}

			$thumbnail = Image::make($request->file('name')->getRealPath());
			$thumbnail->fit(128,128);
			$thumbnail->save($dir.'/thumbnails/'.$filename);
			$thumbnail->destroy();

			$picture->name = $filename;
			// dd($request->file('name'));
		}

		$picture->alt 					= $request->input('alt');
		$picture->caption 				= $request->input('caption');
		$picture->title 				= $request->input('title');
		$picture->picture_category_id 	= $request->input('picture_category');
		$picture->url 					= $request->input('url');

		$picture->save();

		if($request->has('page')){
			$page = Page::find($request->input('page'));
			$page->pictures()->detach($picture);
			$page->pictures()->attach($picture);
		}

		return redirect()
				->route('admin-pictures')
				->with('global-success','Picture Updated');
	}

	public function postDelete(Request $request)
	{
		$picture = Picture::find($request->input('id'));
		$picture->delete();

		return response(["message"=>"Picture Deleted successfuly"])->header('Content-Type','application/json');
	}

	public function postPublish(Request $request)
	{
		$picture = Picture::find($request->input('id'));
		$picture->published = !$picture->published;
		$picture->save();

		return response(["message"=>$picture->published ? "Picture published successfuly" : "Picture un-published successfuly"])->header('Content-Type','application/json');
	}
	
}