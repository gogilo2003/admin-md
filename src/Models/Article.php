<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
use Ogilo\AdminMd\Support\Picture;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

/**
 * Hit model.
 */
class Article extends Model implements Searchable
{
    protected $filename = null;

    public function getSearchResult(): SearchResult
    {
        $url = route('article', $this->name);

        $details = view('search::web.inc.result', ['title' => $this->title, 'content' => $this->content, 'url' => $url]);

        return new \Spatie\Searchable\SearchResult($this, $details, $url);
    }

    public function category()
    {
        return $this->belongsTo('Ogilo\AdminMd\Models\ArticleCategory', 'article_category_id');
    }

    public function page()
    {
        return $this->belongsTo('Ogilo\AdminMd\Models\Page');
    }

    public function link()
    {
        return $this->morphOne('Ogilo\AdminMd\Models\Link', 'linkable');
    }

    public function admins()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\Admin');
    }

    public function comments()
    {
        return $this->hasMany('Ogilo\AdminMd\Models\Comment');
    }

    public function getPictureAttribute($value)
    {
        return new Picture(asset('images/articles'), $value);
    }

    public function getAuthorAttribute($value)
    {
        return json_decode($value);
    }
}
