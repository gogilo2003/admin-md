<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Package model
*/
class Package extends Model
{
	
	public function pages()
	{
		return $this->belongsToMany('Ogilo\Admin\Models\Page');
	}

	public function pictures()
	{
		return $this->hasMany('Ogilo\Admin\Models\PackagePicture','package_id');
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