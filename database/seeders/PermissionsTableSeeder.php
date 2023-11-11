<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $permissions = [            
            [
                'name'      => 'user.access',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'user.show',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'user.create',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'user.edit',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'user.delete',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'roles.access',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'roles.show',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'roles.create',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'roles.edit',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            /*[
                'name'      => 'roles.delete',
                'guard_name' => 'web',
                'created_at' => now()
            ],*/
            [
                'name'      => 'permissions.access',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'permissions.create',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'permissions.edit',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'master_management.menu',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'system_fields.access',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'system_fields.create',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'system_fields.edit',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'system_fields.show',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'system_fields.delete',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'brands.access',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'brands.create',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'brands.edit',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'brands.show',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'brands.delete',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'packages.access',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'packages.create',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'packages.edit',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'packages.show',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'packages.delete',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'departments.access',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'departments.create',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'departments.edit',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'departments.show',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'departments.delete',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'asign_brands.access',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'asign_brands.create',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'asign_brands.edit',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'asign_brands.show',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'      => 'asign_brands.delete',
                'guard_name' => 'web',
                'created_at' => now()
            ],

        ];
        Permission::insert($permissions);

        $modules=['module__core__users','module__university__examination','module__university__examination', 'module__university__unviersity_master','module__core__module','module__office__office', 'module__university__university_master', 'module__university__admissions','module__membership__membership'];

        foreach($modules as $module):
            \App\Models\ModuleSetting::updateOrCreate(['code'=>$module],['code'=>$module,'status'=>1,'updated_by'=>1]);
        endforeach;
    }
}