<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function viewAllUser();
    public function userRoles();
    public function createUser($data);
    public function updateProfile($data);
    public function deleteUser($id);
}
