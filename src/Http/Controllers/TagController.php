<?php

namespace Ogilo\AdminMd\Http\Controllers;

use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        return view('admin::tags.index');
    }
}
