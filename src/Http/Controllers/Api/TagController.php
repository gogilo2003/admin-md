<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use Illuminate\Http\Request;
use Ogilo\AdminMd\Models\Tag;
use Ogilo\ApiResponseHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Ogilo\AdminMd\Http\Resources\TagResource;

class TagController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        return TagResource::collection(Tag::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tags,name'
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $tag = new Tag();

        $tag->name = $request->name;
        $tag->description = $request->description;

        $tag->save();

        return $this->storeSuccess('Tag stored', ['tag' => TagResource::make($tag)]);
    }
}
