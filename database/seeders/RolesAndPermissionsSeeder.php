<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        Permission::create([
            'name' => 'create'
        ]);

        Permission::create([
            'name' => 'edit'
        ]);

        Permission::create([
            'name' => 'delete'
        ]);

        Permission::create([
            'name' => 'view'
        ]);

        Permission::create([
            'name' => 'create admin'
        ]);

        Permission::create([
            'name' => 'edit admin'
        ]);

        Permission::create([
            'name' => 'delete admin'
        ]);

        // Create roles and assign created permissions

        $role = Role::create([
            'name' => 'admin'
        ]);
        $role->givePermissionTo(Permission::all());

        $role = Role::create([
            'name' => 'supervisor'
        ]);
        $role->givePermissionTo(['view','create', 'edit', 'delete']);

        $role = Role::create([
            'name' => 'employee'
        ]);
        $role->givePermissionTo(['view']);
    }
}
