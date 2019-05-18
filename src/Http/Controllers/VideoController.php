<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\Video;
use Ogilo\AdminMd\Models\VideoCategory;
use Ogilo\AdminMd\Models\Page;

use File;
use Validator;

/**
* 
*/
class VideoController extends Controller
{
	
	function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function getVideos()
    {
    	$videos = Video::all();
    	return view('admin::videos.index',compact('videos'));
    }

    public function getAdd()
    {
    	$video_categories = VideoCategory::all();
    	$pages = Page::all();
    	return view('admin::videos.add',compact('video_categories','pages'));
    }

    public function postAdd(Request $request)
    {
    	$cat = VideoCategory::find($request->input('video_category'));

    	// dd($request->all());

    	$validator = Validator::make($request->all(),[
    			'name'			=>'required|file|mimes:'.$cat->mimes.'|max:'.$cat->maxSizeKilobytes(),
    			'title'			=>'required',
    			'video_category' =>'required|integer'
    		]);

    	if ($validator->fails()) {
    		return redirect()
    				->back()
    				->withInput()
    				->withErrors($validator)
    				->with('global-warning','Some fileds failed validation. Please check and try again');
    	}

    	$vd = new Video;
    	$video = $request->file('name');

    	$dir = public_path('videos');

    	if (!File::exists($dir)) {
    		File::makeDirectory($dir,0755,TRUE);
    	}

    	$filename = time().'.'.$video->clientExtension();

        $video->move($dir, $filename);

    	$vd->name = $filename;
    	$vd->title = $request->input('title');
    	$vd->caption = $request->input('description');

    	$cat->videos()->save($vd);
    	
    	return redirect()
    			->back()
    			->with('global-success','Video added');
    }

    public function getEdit($id)
    {
    	$video_categories = VideoCategory::all();
    	$video = Video::find($id);
    	return view('admin::videos.edit',compact('video_categories','pages','video'));
    }

    public function postEdit(Request $request)
    {
    	$cat = VideoCategory::find($request->input('video_category'));

    	// dd($request->all());

    	$validator = Validator::make($request->all(),[
    			'name'			=>'file|mimes:'.$cat->mimes.'|max:'.$cat->maxSizeKilobytes(),
    			'title'			=>'required',
    			'video_category' =>'required|integer',
    		]);

    	if ($validator->fails()) {
    		return redirect()
    				->back()
    				->withInput()
    				->withErrors($validator)
    				->with('global-warning','Some fileds failed validation. Please check and try again');
    	}

    	$vd = Video::find($request->input('id'));
        
    	if ($request->hasFile('name')) {
            $video = $request->file('name');

            // dd($video);

            $dir = public_path('videos');

            if (!File::exists($dir)) {
                File::makeDirectory($dir,0755,TRUE);
            }

            $filename = time().'.'.$video->clientExtension();
            // $filename = $vd->name ? $vd->name : time().'.'.$video->clientExtension();

            $vd->deleteVideo();
            $video->move($dir, $filename);

            $vd->name = $filename;
        }
        
    	$vd->title = $request->input('title');
        $vd->caption = $request->input('description');
    	$vd->video_category_id = $cat->id;

        $vd->save();
    	
    	return redirect()
    			->back()
    			->with('global-success','Video Updated');
    }

    public function postDelete(Request $request)
    {
        $video = Video::find($request->input('id'));
        $video->deleteVideo();
        $video->delete();

        return response(['message'=>'Video has been deleted'])
                ->header('Content-Type','application/json');
    }

    public function postPublish(Request $request)
    {
        $video = Video::find($request->input('id'));
        $video->published = !$video->published;
        $video->save();

        return response(['message'=>$video->published ? 'Video has been published' : 'Video has been un-published'])
                ->header('Content-Type','application/json');
    }

}