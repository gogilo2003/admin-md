<?php

namespace Ogilo\AdminMd\Services;

use Ogilo\AdminMd\Repositories\AdminRepository;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function paginateAdmins($perPage = 15)
    {
        return $this->adminRepository->paginate($perPage);
    }

    public function getAllAdmins()
    {
        return $this->adminRepository->all();
    }

    public function getAdmin($id)
    {
        return $this->adminRepository->find($id);
    }

    public function getAdminByEmail($email)
    {
        return $this->adminRepository->findByEmail($email);
    }

    public function createAdmin(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->adminRepository->create($data);
    }

    public function updateAdmin($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->adminRepository->update($id, $data);
    }

    public function deleteAdmin($id)
    {
        return $this->adminRepository->delete($id);
    }

    public function getActiveAdmins()
    {
        return $this->adminRepository->active();
    }

    public function getActiveAdminsByRole($role_id)
    {
        return $this->adminRepository->byRole($role_id);
    }

    public function searchAdmins($query, $perPage = 15)
    {
        return $this->adminRepository->search($query, $perPage);
    }

    public function updateAdminPassword($id, $password)
    {
        return $this->adminRepository->updatePassword($id, $password);
    }

    public function resetAdminPassword($id)
    {
        $password = $this->generatePassword();

        return [
            'password' => $this->adminRepository->updatePassword($id, $password),
            'generated_password' => $password,
        ];
    }

    public function generatePassword(array $options = [])
    {
        $options = array_merge([
            'length' => 8,
            'complexity' => 'medium',
            'characters' => [
                'letters' => 6,
                'numbers' => 2,
                'special' => 0,
            ],
        ], $options);

        $length = $options['length'];
        $characters = $options['characters'];

        $letters = isset($characters['letters']) ? $characters['letters'] : 6;
        $numbers = isset($characters['numbers']) ? $characters['numbers'] : 2;
        $special = isset($characters['special']) ? $characters['special'] : 0;

        $pool = '';

        if ($letters > 0) {
            $pool .= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }

        if ($numbers > 0) {
            $pool .= '0123456789';
        }

        if ($special > 0) {
            $pool .= '!@#$%^&*()_+-=[]{}|;:,.<>?';
        }

        if ($pool === '') {
            $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        }

        $password = '';
        $poolLength = strlen($pool);

        for ($i = 0; $i < $length; $i++) {
            $password .= $pool[random_int(0, $poolLength - 1)];
        }

        return $password;
    }

    public function authenticate($email, $password)
    {
        $admin = $this->adminRepository->findByEmail($email);

        if ($admin && Hash::check($password, $admin->password)) {
            return $admin;
        }

        return null;
    }
}
