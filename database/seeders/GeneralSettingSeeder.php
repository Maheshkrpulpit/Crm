<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    public function run()
    {
        $users = [
     
            [
                'setting_key'   => 'school_name',
                'setting_value' => 'Magix',
                'created_at'    => now(),
            ],
            [
                'setting_key'   => 'school_code',
                'setting_value' => 'Developed By PULPiT DMA',
                'created_at'    => now(),
            ],
            [
                'setting_key'   => 'school_phone_number',
                'setting_value' => '9661663666',
                'created_at'    => now(),
            ],
            [
                'setting_key'   => 'school_email',
                'setting_value' => 'admin@pulpitdma.com',
                'created_at'    => now(),
            ],
            [
                'setting_key'   => 'school_address',
                'setting_value' => 'Shivaay Complex, Phulwarisharif, Patna',
                'created_at'    => now(),
            ],
            [
                'setting_key'   => 'sch_date_format',
                'setting_value' => 'd-m-Y',
                'created_at'    => now(),
            ],
            [
                'setting_key'   => 'sch_timezone',
                'setting_value' => 'Asia/Kolkata',
                'created_at'    => now(),
            ],
            [
                'setting_key'   => 'sch_start_week',
                'setting_value' => 'Monday',
                'created_at'    => now(),
            ],
            [
                'setting_key'   => 'currency_format',
                'setting_value' => '#,###.##',
                'created_at'    => now(),
            ]
        ];
        GeneralSetting::insert($users);
    }
}
