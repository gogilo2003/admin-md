<?php 
namespace Ogilo\AdminMd\Support;
/**
 * 
 */
class Picture
{
	// public $url = '';

	function __construct($dir,$filename)
	{
		$this->dir = starts_with($dir, config('admin.path_prefix')) ? $dir : config('admin.path_prefix').$dir;
		$this->filename = $filename;
		$this->url = $this->dir.'/'.$filename;
		$this->thumbnail = $this->dir.'/160x160/'.$filename;
		$this->url_alt = $this->dir.'/480x240/'.$filename;
		return $this->url;
	}
}