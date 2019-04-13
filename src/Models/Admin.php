<?php

namespace Ogilo\Admin\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('Ogilo\Admin\Models\AdminRole','admin_role_id','id');
    }

    public function articles()
    {
        return $this->hasMany('Ogilo\Admin\Models\Article');
    }

    public function pages()
    {
        return $this->hasMany('Ogilo\Admin\Models\Page');
    }

    public function menus()
    {
        return $this->hasMany('Ogilo\Admin\Models\Menu');
    }

    public function pictures()
    {
        return $this->hasMany('Ogilo\Admin\Models\Picture');
    }

    public function files()
    {
        return $this->hasMany('Ogilo\Admin\Models\File');
    }

    public function videos()
    {
        return $this->hasMany('Ogilo\Admin\Models\Video');
    }

    public function belongsToRole($role_id)
    {
        return ($this->admin_role_id == $role_id);
    }

}
