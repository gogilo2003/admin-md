<?php

namespace Ogilo\AdminMd\Models;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;

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

    public function getAvatarAttribute($value)
    {
        if ($value) {
            return Image::make(Storage::get($value))->encode('data-url')->encoded;
        }

        $avatar = new InitialAvatar();

        $image = $avatar->name($this->name)->generate();

        return $image->encode('data-url')->encoded;
    }
}
