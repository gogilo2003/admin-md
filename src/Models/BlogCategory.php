<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class BlogCategory extends Model
{
	
	public function blogs()
	{
		return $this->hasMany('Ogilo\AdminMd\Models\Blog');
	}

	public function pages()
    {
        return $this->belongsToMany('Ogilo\AdminMd\Models\Page');
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