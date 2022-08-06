<?php

namespace Ogilo\AdminMd\Models;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use Throwable;

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
            // return Storage::path($value);
            try {
                return Image::make(Storage::path($value))
                    ->resize(48, 48)
                    ->encode('data-url')->encoded;
            } catch (Throwable $th) {
            }
        }

        $avatar = new InitialAvatar();

        $image = $avatar->name($this->name)->generate();

        return $image->encode('data-url')->encoded;
    }
}
