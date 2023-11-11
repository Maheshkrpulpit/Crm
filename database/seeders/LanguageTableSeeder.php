<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = [
            [
                'name' => 'English',
                'code' => 'en',
                'created_by' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Hindi',
                'code' => 'hi',
                'created_by' => 1,
                'created_at' => now()
            ]
        ];
        Language::insert($language);
    }
}
