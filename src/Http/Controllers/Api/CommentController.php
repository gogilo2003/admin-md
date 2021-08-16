<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Ogilo\AdminMd\Models\Comment;
use Ogilo\AdminMd\Models\CommentUser;

class CommentController extends Controller
{
    function __construct(){
        $this->page = new \Ogilo\AdminMd\Models\Page;
    }

    public function approve(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id'=>'required|integer|exists:comments'
        ]);

        if ($validator->fails()) {
            $res = [
                'success'=>false,
                'message'=>'Validation error',
                'errors'=>$validator->errors()->all()
            ];
            return response()->json($res);
        }

        $comment = Comment::find($request->id);
        $comment->published = $comment->published ? 0 : 1;
        $comment->save();

        return response()->json([
            'success'=>true,
            'message'=>'Comment '.($comment->published ? 'Approved': 'Disapproved'),
            'comment'=>$comment
        ]);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id'=>'required|integer|exists:comments'
        ]);

        if ($validator->fails()) {
            $res = [
                'success'=>false,
                'message'=>'Validation error',
                'errors'=>$validator->errors()->all()
            ];
            return response()->json($res);
        }

        $comment = Comment::find($request->id);
        $comment->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Comment deleted'
        ]);
    }

    public function reply(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id'=>'required|integer|exists:comments',
            'reply'=>'required',
            'email'=>'required|email',
            'name'=>'required'
        ]);

        if ($validator->fails()) {
            $res = [
                'success'=>false,
                'message'=>'Validation error',
                'errors'=>$validator->errors()->all()
            ];
            return response()->json($res);
        }

        $user = CommentUser::where('email',$request->email)->first();

        if(!$user){
            $user = new CommentUser();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->website = $request->website;
            $user->save();
        }

        $comment = new Comment;
        $comment->message = $request->reply;
        $comment->parent_comment_id = $request->id;
        $comment->user_id = $user->id;
        $comment->article_id = $request->article_id;
        $comment->save();

        return response()->json([
            'success'=>true,
            'message'=>'Reply posted'
        ]);
    }

    public function comment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'comment'=>'required'
        ]);

        if ($validator->fails()) {
            $res = [
                'success'=>false,
                'message'=>'Validation error',
                'errors'=>$validator->errors()->all()
            ];
            return response()->json($res);
        }

        $user = CommentUser::where('email',$request->email)->first();

        if(!$user){
            $user = new CommentUser();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->website = $request->website;
            $user->save();
        }

        $comment = new Comment;
        $comment->message = $request->comment;
        $comment->user_id = $user->id;
        $comment->save();

        return response()->json([
            'success'=>true,
            'message'=>'Comment posted'
        ]);
    }
}
