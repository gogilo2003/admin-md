<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Ogilo\ApiResponseHelpers;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ApiResponseHelpers;
}
