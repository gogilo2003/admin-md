<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Ogilo\AdminMd\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Auth;
use Storage;

class ProductController extends Controller
{
    function __construct()
    {
        $this->page = new \Ogilo\AdminMd\Models\Page;
    }
}
