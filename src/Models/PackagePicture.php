<?php

namespace Ogilo\AdminMd\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Package model
*/
class PackagePicture extends Model
{
	protected $fillable = ['primary'];

	public function package()
	{
		return $this->belongsTo('Ogilo\AdminMd\Models\Package');
	}
}