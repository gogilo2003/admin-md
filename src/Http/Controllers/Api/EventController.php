<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Validator;
use Auth;
use Storage;

class EventController extends Controller
{
    function __construct(){
        $this->page = new \Ogilo\AdminMd\Models\Page;
    }


}
