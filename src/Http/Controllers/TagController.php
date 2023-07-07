<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use Ogilo\AdminMd\Models\Article;
use Ogilo\AdminMd\Http\Controllers\Controller;
use Ogilo\AdminMd\Services\TagService;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index()
    {
        return view('admin::tags.index');
    }

    public function tag(Request $request, TagService $tagService)
    {
        $validator = Validator::make($request->all(), [
            'article' => 'required|integer|exists:articles,id',
            'tags.*' => 'required|exists:tags,id',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('global-warning', 'Validation Error');
        }

        if (isset($request->tags)) {
            $tagService->tags(Article::find($request->article), $request->tags);
        }

        return back()->with('global-success', 'Article taged');
    }
}
