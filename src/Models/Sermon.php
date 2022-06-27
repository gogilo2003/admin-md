<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* 
*/
class Sermon extends Model
{
	
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