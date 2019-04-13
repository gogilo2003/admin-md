<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class BlogCategory extends Model
{
	
	public function blogs()
	{
		return $this->hasMany('Ogilo\Admin\Models\Blog');
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