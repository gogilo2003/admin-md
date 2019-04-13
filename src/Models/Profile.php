<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Profile model
*/
class Profile extends Model
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

    public function deletePicture()
    {
        if (file_exists($path = public_path('images/profiles/'.$this->picture))) {
            if (!is_dir($path)) {
                unlink($path);
            }
        }
    }

    public function getPictureAttribute($value)
    {
        return $value ? $value : 'placeholder.png';
    }

}