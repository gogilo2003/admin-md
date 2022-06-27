<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Page;
use Ogilo\AdminMd\Models\Link;

use Validator;
use File;
use Img;
use Artisan;

/**
*
*/
class PageController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getPages()
	{
		$pages = Page::all();
		return view('admin::pages.index',compact('pages'));
	}

	public function getAdd()
	{
		return view('admin::pages.add');
	}

	public function postAdd(Request $request)
	{
		// $pages = $request->all();//implode(',', $request->input('pages'));
		// dd($pages);
		$validator = Validator::make($request->all(),[
				'name'=>'required|unique:pages|alphanum',
				'title'=>'required'
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

		$page = new Page;
		$page->name 	= $request->input('name');
		$page->title 	= $request->input('title');
		$page->content 	= $request->input('content');

		$link = $request->has('link') ? Link::find($request->input('link')) : Link::first();

		if ($request->hasFile('title_image')) {
			$title_image = $request->file('title_image');
			if ($title_image->isValid()) {

				$dir = public_path( 'images/pages/');
				$filename = time().'.jpg';

				if (!file_exists($dir)) {
					mkdir($dir, 0755, TRUE);
				}
				$image = Img::make($title_image->getRealPath());

		        $img = json_decode($request->input('image_cropdetails'));
		        $image->crop((int) $img->width, (int) $img->height, (int) $img->x, (int) $img->y);

				$image->save($dir.$filename);
				$image->destroy();

				$page->title_image = $filename;
			}
		}

		$page->save();

        // generate template
        if($request->has('template')){

            Artisan::call('admin:make-page',[
                "name"=>$page->name
            ]);

        }

		$page->link()->save($link);

		return redirect()
				->route('admin-pages')
				->with('global-success','Page added');
	}

	public function getEdit($id)
	{
		$page = Page::findOrFail($id);
		return view('admin::pages.edit',compact('page'));
	}

	public function postEdit(Request $request)
	{
		$id = $request->input('id');
		// print '<pre>';
		// var_dump($request->all());
		// print '</pre>';
		// die;

		$validator = Validator::make($request->all(),[
				'name'=>'required|alphanum|unique:pages,name,'.$id,
				'title'=>'required',
				'title_image'=>'image'
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

		$page = Page::findOrFail($id);
		$page->name 	= $request->input('name');
		$page->title 	= $request->input('title');
		$page->content 	= $request->input('content');

		if ($request->hasFile('title_image')) {
			$title_image = $request->file('title_image');
			if ($title_image->isValid()) {

				$dir = public_path( 'images/pages/');
				$filename = time().'.jpg';

				if ($page->title_image && file_exists($dir.$page->title_image)) {
					unlink($dir.$page->title_image);
				}

				if (!file_exists($dir)) {
					mkdir($dir, 0755, TRUE);
				}

				$image = Img::make($title_image->getRealPath());

				$img = json_decode($request->input('image_cropdetails'));
		        $image->crop((int) $img->width, (int) $img->height, (int) $img->x, (int) $img->y);

				$image->save($dir.$filename);
				$image->destroy();

				$page->title_image = $filename;
			}
		}

		$page->save();

		return redirect()
				->route('admin-pages')
				->with('global-success','Page '.$page->name.' Updated');
	}

	public function postDelete(Request $request)
	{
		// dd($request->all());

		$page = Page::findOrFail($request->input('id'));

		$dir = public_path( 'images/pages/');
		if ($page->title_image && file_exists($dir.$page->title_image)) {
			unlink($dir.$page->title_image);
		}

		$name = $page->name;
		$page->delete();

		/*return redirect()
				->route('admin-pages')
				->with('global-success','Page '.$name.' Deleted');*/
	}

}
