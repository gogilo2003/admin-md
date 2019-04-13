<?php

namespace Ogilo\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Ogilo\Admin\Models\File as Fl;
use Ogilo\Admin\Models\FileCategory;
use Ogilo\Admin\Models\Page;

use File;
use Validator;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function getFiles()
    {
    	$files = Fl::all();
    	return view('admin::files.index',compact('files'));
    }

    public function getAdd()
    {
    	$file_categories = FileCategory::all();
    	$pages = Page::all();
    	return view('admin::files.add',compact('file_categories','pages'));
    }

    public function postAdd(Request $request)
    {
    	$cat = FileCategory::find($request->input('file_category'));

    	// dd($cat->mimes);

    	$validator = Validator::make($request->all(),[
    			'name'			=>'required|file|mimes:'.$cat->mimes.'|max:'.$cat->maxSizeKilobytes(),
    			'title'			=>'required',
    			'file_category' =>'required|integer',
    		]);

    	if ($validator->fails()) {
    		return redirect()
    				->back()
    				->withInput()
    				->withErrors($validator)
    				->with('global-warning','Some fileds failed validation. Please check and try again');
    	}

    	$fl = new Fl;
    	$file = $request->file('name');

    	$dir = public_path('files');

    	if (!File::exists($dir)) {
    		File::makeDirectory($dir,0755,TRUE);
    	}

    	$filename = time().'.'.$file->clientExtension();

        $file->move($dir, $filename);

    	$fl->name = $filename;
    	$fl->title = $request->input('title');
    	$fl->description = $request->input('description');

    	$cat->files()->save($fl);
    	
    	return redirect()
    			->route('admin-files')
    			->with('global-success','File added');
    }

    public function getEdit($id)
    {
    	$file_categories = FileCategory::all();
    	$file = Fl::find($id);
    	return view('admin::files.edit',compact('file_categories','pages','file'));
    }

    public function postEdit(Request $request)
    {
    	$cat = FileCategory::find($request->input('file_category'));

    	// dd($cat->mimes);

    	$validator = Validator::make($request->all(),[
    			'name'			=>'file|mimes:'.$cat->mimes.'|max:'.$cat->maxSizeKilobytes(),
    			'title'			=>'required',
    			'file_category' =>'required|integer',
    		]);

    	if ($validator->fails()) {
    		return redirect()
    				->back()
    				->withInput()
    				->withErrors($validator)
    				->with('global-warning','Some fileds failed validation. Please check and try again');
    	}

    	$fl = Fl::find($request->input('id'));
        
    	if ($request->hasFile('name')) {
            $file = $request->file('name');

            $dir = public_path('files');

            if (!File::exists($dir)) {
                File::makeDirectory($dir,0755,TRUE);
            }

            $filename = time().'.'.$file->clientExtension();

            $old_filename = public_path('files/'.$fl->name);
            chmod($old_filename,0777);
            unlink($old_filename);

            $file->move($dir, $filename);

            $fl->name = $filename;
        }
        
    	$fl->title = $request->input('title');
    	$fl->description = $request->input('description');

    	$cat->files()->save($fl);

    	return redirect()
    			->route('admin-files')
    			->with('global-success','File added');
    }

    public function postDelete(Request $request)
    {
        $fl = Fl::find($request->input('id'));
        unlink(public_path('files/'.$fl->name));
        $fl->delete();

        return response(['message'=>'File has been deleted'])
                ->header('Content-Type','application/json');
    }

    public function postPublish(Request $request)
    {
        $fl = Fl::find($request->input('id'));
        $fl->published = !$fl->published;
        $fl->save();

        return response(['message'=>$fl->published ? 'File has been published' : 'File has been un-published' ])
                ->header('Content-Type','application/json');
    }


}
