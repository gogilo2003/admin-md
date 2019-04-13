<?php

namespace Ogilo\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    public function admins()
    {
    	return $this->hasMany('Ogilo\Admin\Models\Admin');
    }

    public function hasRole($role_name)
    {
    	return str_contains($this->details, $role_name);
    }

    public function activeAdmins()
    {
    	return $this->hasMany('Ogilo\Admin\Models\Admin','admin_role_id','id')->where('active','=',1);
    }
}
