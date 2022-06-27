<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Ogilo\AdminMd\Models\Comment;
use Ogilo\AdminMd\Models\CommentUser;

class CommentController extends Controller
{
    function __construct()
    {
        $this->page = new \Ogilo\AdminMd\Models\Page;
    }

    public function index($id, $published = null)
    {
        if ($published) {
            $comments = Comment::where('article_id', $id)
                ->where('published', 1)
                ->where('parent_comment_id', null)
                ->with(['user','replies.user','replies.replies.user','replies.replies.replies.user'])
                ->orderBy('created_at', 'DESC')
                ->get();
            return $comments ?? [];
        }
        $comments = Comment::where('article_id', $id)
            ->where('parent_comment_id', null)
            ->with(['user','replies.user','replies.replies.user','replies.replies.replies.user'])
            ->orderBy('created_at', 'DESC')
            ->get();
        return $comments ?? [];
    }

    public function approve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:comments'
        ]);

        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()->all()
            ];
            return response()->json($res);
        }

        $comment = Comment::find($request->id);
        $comment->published = $comment->published ? 0 : 1;
        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Comment ' . ($comment->published ? 'Approved' : 'Disapproved'),
            'comment' => $comment
        ]);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:comments'
        ]);

        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()->all()
            ];
            return response()->json($res);
        }

        $comment = Comment::find($request->id);
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted'
        ]);
    }

    public function reply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:comments',
            'article_id' => 'required|integer|exists:articles,id',
            'reply' => 'required',
            'email' => 'required|email',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()->all()
            ];
            return response()->json($res);
        }

        $user = CommentUser::where('email', $request->email)->first();

        if (!$user) {
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
        $comment->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Reply posted',
            'reply'=>$comment
        ]);
    }

    public function comment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:articles',
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ];
            return response()->json($res);
        }

        $user = CommentUser::where('email', $request->email)->first();

        if (!$user) {
            $user = new CommentUser();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->website = $request->website;
            $user->save();
        }

        $comment = new Comment;
        $comment->message = $request->comment;
        $comment->user_id = $user->id;
        $comment->article_id = $request->id;
        $comment->save();
        $comment->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Comment posted',
            'comment'=>$comment
        ]);
    }
}
