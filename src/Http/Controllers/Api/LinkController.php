<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Ogilo\AdminMd\Models\Link;
use Ogilo\AdminMd\Http\Controllers\Api\Controller;
use Ogilo\AdminMd\Http\Resources\LinkResource;

class LinkController extends Controller
{
    use \Ogilo\ApiResponseHelpers;

    public function inMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:links,id'
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $link = Link::find($request->id);
        $link->in_menu = !$link->in_menu;
        $link->save();

        return $this->updateSuccess("Link " . ($link->in_menu ? "Enabled" : "Disabled"), ['link' => new LinkResource($link)]);
    }
}
