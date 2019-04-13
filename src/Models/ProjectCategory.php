<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class ProjectCategory extends Model
{
	
	public function projects()
	{
		return $this->hasMany('Ogilo\Admin\Models\Project');
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