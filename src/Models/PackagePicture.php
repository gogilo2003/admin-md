<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;
/**
* Package model
*/
class PackagePicture extends Model
{
	protected $fillable = ['primary'];

	public function package()
	{
		return $this->belongsTo('Ogilo\Admin\Models\Package');
	}
}