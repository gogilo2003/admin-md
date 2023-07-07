<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use Ogilo\AdminMd\Http\Controllers\Api\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Auth;
use Storage;

class EventController extends Controller
{
    function __construct()
    {
        $this->page = new \Ogilo\AdminMd\Models\Page;
    }
}
