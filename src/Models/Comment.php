<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Comment extends Model
{
	
	public function category()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\Article');
	}

}