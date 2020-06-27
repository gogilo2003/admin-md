<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

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

    public function postPublish(Request $request)
    {
        $validator = Validator::make($request->all(),[
        	'id'=>'required|exists:videos'
        ]);

        if ($validator->fails()) {
        	$res = [
        		'success'=>false,
        		'message'=>'<h5>Validation error</h5>'.make_html_list($validator->errors()->all())
        	];
        	return response()->json($res);
        }

        $video = Video::find($request->id);
        $video->published = $video->published ? 0 : 1 ;
        $video->save();

        return response([
                'success'=>true,
                'message'=>$video->published ? 'Video has been published' : 'Video has been un-published',
                'video'=>$video
            ])->header('Content-Type','application/json');
    }

    public function postFeature(Request $request)
    {
        $validator = Validator::make($request->all(),[
        	'id'=>'required|exists:videos'
        ]);

        if ($validator->fails()) {
        	$res = [
        		'success'=>false,
        		'message'=>'<h5>Validation error</h5>'.make_html_list($validator->errors()->all())
        	];
        	return response()->json($res);
        }

        $video = Video::find($request->id);
        $video->featured = $video->featured ? 0 : 1 ;
        $video->save();

        return response([
                'success'=>true,
                'message'=>$video->featured ? 'Video has been featured' : 'Video has been un-featured',
                'video'=>$video
            ])->header('Content-Type','application/json');
    }
}
