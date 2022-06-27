<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
* Hit model
*/
class CommentUser extends Model
{
	
	/**
	 * Get all of the comments for the CommentUser
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments(): HasMany
	{
		return $this->hasMany(Comment::class);
	}
}