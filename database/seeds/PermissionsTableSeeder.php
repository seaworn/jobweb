<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resources = [
            'user',
            'personal-information',
            'contact-person',
            'academic-qualification',
            'professional-certification',
            'professional-membership',
            'skill',
            'work-experience',
            'referee',
            'permission',
            'role'
        ];
        $actions = [
            'access',
            'create',
            'view',
            'update',
            'delete'
        ];

        // App\Role::truncate();

        foreach ($actions as $action) {
            foreach ($resources as $resource) {
                Permission::updateOrCreate(['name'=> "{$action}-{$resource}", 'guard_name'=> 'api']);
            }
        }
    }
}
