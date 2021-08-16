<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class CommentUser extends Model
{
	
	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}