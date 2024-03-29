<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
* Hit model
*/
class Comment extends Model
{
	
	public function replies() {
		return $this->hasMany(Comment::class, 'parent_comment_id');
	}

	public function article()
	{
		return $this->belongsTo(Article::class);
	}

	/**
	 * Get the user that owns the Comment
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(CommentUser::class,'user_id');
	}
}