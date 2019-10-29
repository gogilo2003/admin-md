<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Package model
*/
class Package extends Model
{
	
	public function categories()
	{
		return $this->belongsToMany('Ogilo\AdminMd\Models\PackageCategory');
	}

	public function pictures()
	{
		return $this->hasMany('Ogilo\AdminMd\Models\PackagePicture','package_id');
	}

	public function categoryIds()
    {
    	$ids = array();
    	foreach ($this->categories as $key => $value) {
    		$ids[] = $value->id;
    	}
    	return $ids;
    }

}