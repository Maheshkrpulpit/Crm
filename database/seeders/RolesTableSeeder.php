<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name'       => 'Super Admin',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'       => 'Admin',
                'guard_name' => 'web',
                'created_at' => now()
            ],
            [
                'name'       => 'User',
                'guard_name' => 'web',
                'created_at' => now()
            ],
        ];
        Role::insert($roles);
    }
}
