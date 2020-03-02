<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $basic = Role::updateOrCreate(['name'=> 'basic', 'guard_name'=> 'web']);
        $resources = [
            'personal-information',
            'academic-qualification',
            'professional-certification',
            'professional-membership',
            'skill',
            'work-experience',
            'referee'];
        $actions = ['view', 'create', 'update', 'delete'];
        $perm = [];
        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                $perm[] = "{$action}-{$resource}";
            }
        }
        $basicPermissions = Permission::whereIn('name', $perm)->get();
        $basic->syncPermissions($basicPermissions);
        $admin = Role::updateOrCreate(['name'=> 'admin', 'guard_name'=> 'web']);
        $adminPermissions = Permission::whereIn('name', [
            'access-user',
            'create-user',
            'delete-user',
            'update-user',
            'access-role',
            'create-role',
            'view-role',
            'update-role',
            'delete-role',
            'access-permission',
            'create-permission',
            'view-permission',
            'update-permission',
            'delete-permission'
        ]);
        $admin->syncPermissions($adminPermissions);
    }
}
