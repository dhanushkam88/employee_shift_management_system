<?php
namespace App\Repositories\User;

use Carbon\Carbon;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserRepository implements UserRepositoryInterface
{
    public function viewAllUser()
    {
        return User::all();
    }

    public function  userRoles()
    {
        if (Auth::user()->hasRole('admin')) {
            return Role::all();
        } else {
            return Role::whereNotIn('id',[1])->get();
        }
    }

    public function createUser($data)
    {
        $user = User::create([
            'name'=> $data->fullName,
            'email' => $data->email,
            'contact' => $data->contactNumber,
            'status' => '2',
            'password' =>  Hash::make($data->password),
        ])->assignRole($data->userRole);
        return $user;
    }

    public function updateProfile($data)
    {
        $user = User::find($data->userId);
            $user->update([
                        'name'=> (!empty($data->fullName)
                        &&
                        $data->fullName != $user->name) ? $data->fullName : $user->name,
                        'email' => (!empty($data->email)
                        &&
                        $data->email != $user->email) ? $data->email : $user->email,
                        'contact' => (!empty($data->contactNumber)
                        &&
                        $data->contactNumber != $user->contact) ? $data->contactNumber : $user->contact,
                        'password' => (!empty($data->password)) ? Hash::make($data->password) : $user->password,
                    ]);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::where('id',$id)->delete();
        return $user;
    }
}
