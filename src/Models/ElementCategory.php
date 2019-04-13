<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class ElementCategory extends Model
{
	
	public function elements()
	{
		return $this->hasMany('Ogilo\Admin\Models\Element');
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