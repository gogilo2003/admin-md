<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $appends = ['events'];

    public function link()
    {
        return $this->morphOne('Ogilo\Admin\Models\Link','linkable');
    }

    public function packages()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\Package');
    }

    public function branches()
    {
        return $this->belongsToMany('Ogilo\Branches\Models\Branch')->withTimestamps();
    }
    
    public function article_categories()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\ArticleCategory');
    }

    public function articles()
    {
    	return $this->hasManyThrough('Ogilo\Admin\Models\Article','Ogilo\Admin\Models\ArticleCategory');
    }
    
    public function picture_categories()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\PictureCategory');
    }
    
    public function video_categories()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\VideoCategory');
    }
    
    public function file_categories()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\FileCategory');
    }
    
    public function project_categories()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\ProjectCategory');
    }
    
    public function element_categories()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\ElementCategory');
    }
    
    public function event_categories()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\EventCategory');
    }

    public function getEventsAttribute()
    {
        // return \Ogilo\Admin\Models\Event::has('event_categories.page')->with('category');
        
        $categories = $this->event_categories->pluck('id')->toArray();

        $pageEvents = \Ogilo\Admin\Models\Event::whereIn('event_category_id',$categories)->get();

        // dd($pageEvents);
        
        return $pageEvents;

    }
    
    public function profiles()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\Profile');
    }
    
    public function sermons()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\Sermon');
    }
    
    public function admins()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\Admin');
    }

    public function isSelected($page_id='')
    {
        return ($page_id == $this->id);
    }
    
}
