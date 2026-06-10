<?php

namespace Ogilo\AdminMd\Interfaces\Repositories;

interface AdminRepositoryInterface
{
    public function paginate($perPage = 15);

    public function all();

    public function find($id);

    public function findByEmail($email);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function active();

    public function activeAdmins();

    public function byRole($role_id);

    public function search($query, $perPage = 15);

    public function updatePassword($id, $password);
}
