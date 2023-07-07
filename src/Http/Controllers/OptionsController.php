<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use Ogilo\AdminMd\Http\Controllers\Controller;
use Ogilo\AdminMd\Models\ArticleCategory;

use Illuminate\Support\Facades\Validator;

/**
 *
 */
class OptionsController extends Controller
{

	public function getOptions()
	{
		return view('admin::options.index');
	}

	public function getAdd()
	{
		return ('admin::options.add');
	}

	public function postAdd(Request $request)
	{
		return redirect()
			->with('global-success', 'Option added');
	}
}
