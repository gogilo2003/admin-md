<?php

namespace Ogilo\AdminMd\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements Searchable
{

    protected $appends = ['events'];

    public function getSearchResult(): SearchResult
    {
        $url = route('home', $this->name);

        $details = view('search::web.inc.result',['title'=>$this->title,'content'=>$this->content]);

        return new \Spatie\Searchable\SearchResult($this, $details, $url);
    }

    public function link()
    {
        return $this->morphOne('Ogilo\AdminMd\Models\Link','linkable');
    }

    public function package_categories()
    {
        return $this->belongsToMany('Ogilo\TourPackage\Models\PackageCategory')->withTimestamps();
    }

    public function branches()
    {
        return $this->belongsToMany('Ogilo\Branches\Models\Branch')->withTimestamps();
    }

    public function article_categories()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\ArticleCategory')->withTimestamps();
    }

    public function articles()
    {
    	return $this->hasManyThrough('Ogilo\AdminMd\Models\Article','Ogilo\AdminMd\Models\ArticleCategory');
    }

    public function picture_categories()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\PictureCategory');
    }

    public function getPicturesAttribute()
    {
        $cats = $this->picture_categories->pluck('id')->toArray();
        $pictures = Picture::with('category')->where('published',1)->whereIn('picture_category_id',$cats)->get();
        return $pictures;
    }

    public function video_categories()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\VideoCategory');
    }

    public function file_categories()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\FileCategory');
    }

    public function project_categories()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\ProjectCategory');
    }

    public function element_categories()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\ElementCategory');
    }

    public function event_categories()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\EventCategory');
    }

    public function getEventsAttribute()
    {
        // return \Ogilo\AdminMd\Models\Event::has('event_categories.page')->with('category');

        $categories = $this->event_categories->pluck('id')->toArray();

        $pageEvents = \Ogilo\AdminMd\Models\Event::whereIn('event_category_id',$categories)->get();

        // dd($pageEvents);

        return $pageEvents;

    }

    public function profiles()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\Profile');
    }

    public function sermons()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\Sermon');
    }

    public function admins()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\Admin');
    }

    public function isSelected($page_id='')
    {
        return ($page_id == $this->id);
    }

    public function slides()
    {
        return $this->belongsToMany(\Ogilo\Slides\Models\Slide::class, 'slide_page', 'page_id', 'slide_id');
    }

}
