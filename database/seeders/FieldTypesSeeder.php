<?php

namespace Database\Seeders;

use App\Models\Setting\FieldType;
use Illuminate\Database\Seeder;

class FieldTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $field_types = [
            [
                'name' => 'text',
                'created_at' => now(),
            ],
            [
                'name' => 'number',
                'created_at' => now(),
            ],
            [
                'name' => 'checkbox',
                'created_at' => now(),
            ],
            [
                'name' => 'radio',
                'created_at' => now(),
            ],
            [
                'name' => 'textarea',
                'created_at' => now(),
            ],
            [
                'name' => 'select',
                'created_at' => now(),
            ],
            [
                'name' => 'file',
                'created_at' => now(),
            ],
            [
                'name' => 'multiple',
                'created_at' => now(),
            ],
            [
                'name' => 'email',
                'created_at' => now(),
            ],
            [
                'name' => 'date',
                'created_at' => now(),
            ],
        ];
        FieldType::insert($field_types);
    }
}
