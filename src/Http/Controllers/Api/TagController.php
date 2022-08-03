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

    /**
     * List of tags
     *
     * Returns a json array of tags
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(int $id = null)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'nullable|integer|exists:tags'
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        return $id ? TagResource::make(Tag::find($id)) : TagResource::collection(Tag::all());
    }

    /**
     * Store tag
     *
     * Stores tag to the database on successful validation
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Update tag
     *
     * Update a tag whose id has been provided upon successful validation
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request, int $id)
    {
        $request->merge(['id' => $id]);
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:tags',
            'name' => 'required|unique:tags,name,' . $id . ',id'
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $tag = Tag::find($id);

        $tag->name = $request->name;
        $tag->description = $request->description;

        $tag->save();

        return $this->updateSuccess('Tag updated', ['tag' => TagResource::make($tag)]);
    }

    /**
     * Delete tag
     *
     * Deletes a tag whose id is provided
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function delete(int $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tags'
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $tag = Tag::find($id);
        $tag->articles->detach();
        $tag->delete();

        return $this->deleteSuccess();
    }
}
