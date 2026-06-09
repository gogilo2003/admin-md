<?php

namespace Ogilo\AdminMd\Repositories\Eloquent;

use Ogilo\AdminMd\Models\Admin;
use Ogilo\AdminMd\Repositories\AdminRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements AdminRepository
{
    protected $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $admin = $this->find($id);

        if ($admin) {
            $admin->update($data);
        }

        return $admin;
    }

    public function delete($id)
    {
        $admin = $this->find($id);

        if ($admin) {
            return $admin->delete();
        }

        return false;
    }

    public function active()
    {
        return $this->model->where('active', true)->get();
    }

    public function activeAdmins()
    {
        return $this->model->where('active', 1)->get();
    }

    public function byRole($role_id)
    {
        return $this->model->where('admin_role_id', $role_id)->get();
    }

    public function search($query, $perPage = 15)
    {
        return $this->model
            ->where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->paginate($perPage);
    }

    public function updatePassword($id, $password)
    {
        $admin = $this->find($id);

        if ($admin) {
            $admin->password = Hash::make($password);
            $admin->save();

            return $admin;
        }

        return null;
    }
}
