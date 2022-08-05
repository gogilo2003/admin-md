<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use Illuminate\Http\Request;
use Ogilo\ApiResponseHelpers;
use Ogilo\AdminMd\Models\Author;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Ogilo\AdminMd\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    use ApiResponseHelpers;

    /**
     * List authors
     *
     * Fetch a list of authors and return a JsonRespons collection of the authors
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(int $id = null)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'nullable|integer|exists:authors,id'
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        return AuthorResource::collection(Author::all());
    }

    /**
     * Store new author
     *
     * Stores details of a new author after validation is passed
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'avatar' => 'nullable|image',
            'phone' => 'nullable|unique:authors,phone',
            'email' => 'nullable|unique:authors,email|email',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $author = new Author();

        $author->name = $request->name;
        $author->avatar = $request->hasFile('avatar') ? $request->avatar->store() : null;
        $author->phone = $request->phone;
        $author->email = $request->email;
        $author->details = $request->details;

        $author->save();

        return $this->storeSuccess('Author stored', ['author' => AuthorResource::make($author)]);
    }

    /**
     * Update selected author
     *
     * Updates details of a selected author after validation is passed
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
            'id' => 'required|integer|exists:authors,id',
            'name' => 'required',
            'avatar' => 'nullable|image',
            'phone' => 'nullable|unique:authors,phone,' . $id,
            'email' => 'nullable|unique:authors,email|email,' . $id,
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $author = Author::find($id);

        $author->name = $request->name;
        $author->avatar = $request->hasFile('avatar') ? $request->avatar->store() : null;
        $author->phone = $request->phone;
        $author->email = $request->email;
        $author->details = $request->details;

        $author->save();

        return $this->updateSuccess('Author updated', ['author' => AuthorResource::make($author)]);
    }

    /**
     * Delete Author
     * Delete selected author after successful validation of provided $id
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $author = Author::find($id);
        $author->delete();

        return $this->deleteSuccess();
    }
}
