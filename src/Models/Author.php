<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Hit model.
 */
class Author extends Model
{
    protected $table = 'authors';

    /**
     * Get all of the articles for the Author.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id', 'id');
    }
}
