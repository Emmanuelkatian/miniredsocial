<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'newpost']);
        Permission::create(['name' => 'post_edit']);
        Permission::create(['name' => 'deletepost']);
        Permission::create(['name' => 'newcomment']);
        Permission::create(['name' => 'comment_edit']);
        Permission::create(['name' => 'comment_delete']);



        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'usuario']);
        $role1->givePermissionTo('newpost');
        $role1->givePermissionTo('post_edit');
        $role1->givePermissionTo('deletepost');
        $role1->givePermissionTo('newcomment');
        $role1->givePermissionTo('comment_edit');
        $role1->givePermissionTo('comment_delete');

        $role2 = Role::create(['name' => 'Super-Admin']);
        $role2->givePermissionTo(Permission::all());

        // create demo users
        $user = \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole($role2);
    }
}
