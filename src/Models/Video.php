<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Video extends Model
{
	
	public function category()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\VideoCategory','video_category_id','id');
	}

    public function link()
    {
    	return $this->morphOne('Ogilo\AdminMd\Models\Link','linkable');
    }
	
	public function admins()
	{
		return $this->belongsToMany('Ogilo\AdminMd\Models\Admin');
	}

	public function deleteVideo()
	{
		try {
			$file = public_path('videos/'.$this->name);

			if(file_exists($file)) {
		        chmod($file,0777); //Change the file permissions if allowed
		        unlink($file); //remove the file
		        // dd($file);
		    }else{
		    	return false;
		    	// throw new \Exception("File does not exists ".$file, 1);
		    }
		} catch (Exception $e) {
			// dd($e);
			return false;
		}
		
	    return true;
	}

}