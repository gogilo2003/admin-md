<?php

namespace Ogilo\AdminMd\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Validator;
use Auth;
use Storage;

class ProductController extends Controller
{
    function __construct(){
        $this->page = new \Ogilo\AdminMd\Models\Page;
    }


}
