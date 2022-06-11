<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Dhanushka Admin',
            'email' => 'admin@test.com',
            'contact' => '0773518123',
            'status' => '2',
            'password' => Hash::make('Dhanushka@1234')
        ])->assignRole('admin');

        $user = User::create([
            'name' => 'Dhanushka Supervisor',
            'email' => 'supervisor@test.com',
            'contact' => '0773518123',
            'status' => '2',
            'password' => Hash::make('Dhanushka@1234')
        ])->assignRole('supervisor');

        $user = User::create([
            'name' => 'Dhanushka Employee',
            'email' => 'employee@test.com',
            'contact' => '0773518123',
            'status' => '2',
            'password' => Hash::make('Dhanushka@1234')
        ])->assignRole('employee');
    }
}
