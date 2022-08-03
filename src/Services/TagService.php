<?php

namespace Ogilo\AdminMd\Services;

use Ogilo\AdminMd\Models\Tag;
use Ogilo\AdminMd\Models\Article;
use Illuminate\Support\Facades\DB;

class TagService
{
    public function tag(Article $article, Tag $tag)
    {
        if (DB::table('article_tag')->where('article_id', $article->id)->where('tag_id', $tag->id)->get()->count()) {
            $article->tags()->attach($tag);
        }
    }

    public function articles(Tag $tag, array $articles)
    {
        $tag->articles()->sync($articles);
    }

    public function tags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);
    }
}
