<?php

namespace Database\Seeders;

use App\Models\Master\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name'       => 'Sales',
                'code'       => 'sal',
                'status'     => 1,
                'created_at' => now()
            ],
            [
                'name'       => 'Quality',
                'code'       => 'qual',
                'status'     => 1,
                'created_at' => now()
            ],
            [
                'name'       => 'Processing',
                'code'       => 'prc',
                'status'     => 1,
                'created_at' => now()
            ],
            [
                'name'       => 'Finance',
                'code'       => 'fin',
                'status'     => 1,
                'created_at' => now()
            ],
            [
                'name'       => 'Retention',
                'code'       => 'ret',
                'status'     => 1,
                'created_at' => now()
            ]
        ];
        Department::insert($roles);
    }
}
