<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 1. Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Define Permissions (e.g., CRUD for 'posts')
        Permission::create(['name' => 'view posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);
        
        // You would define all your core permissions here...
        
        // 3. Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // 4. Assign ALL permissions to the Admin Role
        $permissions = Permission::all();
        $adminRole->syncPermissions($permissions);

        // 5. Assign some permissions to the User Role
        $userRole->givePermissionTo('view posts');

        // 6. Create a Super Admin User
        $superAdmin = \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@app.com',
            'password' => 'admin', // Change this for production!
        ]);
        $superAdmin->assignRole('admin');
    }
}
