<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class ArticleCategory extends Model
{
	
	public function articles()
	{
		return $this->hasMany('Ogilo\Admin\Models\Article');
	}

	public function pages()
    {
        return $this->belongsToMany('Ogilo\Admin\Models\Page');
    }

    public function pageIds()
    {
    	$ids = array();
    	foreach ($this->pages as $key => $value) {
    		$ids[] = $value->id;
    	}
    	return $ids;
    }

}