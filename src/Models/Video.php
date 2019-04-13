<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class Video extends Model
{
	
	public function category()
	{
		return $this->belongsTo('Ogilo\Admin\Models\VideoCategory','video_category_id','id');
	}

    public function link()
    {
    	return $this->morphOne('Ogilo\Admin\Models\Link','linkable');
    }
	
	public function admins()
	{
		return $this->belongsToMany('Ogilo\Admin\Models\Admin');
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