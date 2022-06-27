<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Hit model
*/
class File extends Model
{

	public function link()
	{
		return $this->morphOne('Ogilo\AdminMd\Models\Link','linkable');
	}

	public function category()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\FileCategory','file_category_id');
	}

	public function admins()
	{
		return $this->belongsToMany('Ogilo\AdminMd\Models\Admin');
    }

    public function getSizeAttribute()
    {
        return get_filesize(public_path('files/'.$this->name));
    }

}
