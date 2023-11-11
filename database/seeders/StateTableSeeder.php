<?php

namespace Database\Seeders;

use App\Models\Setting\State;
use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['name' => 'Alabama', 'state_code' => 'AL', 'created_at' => now()],
            ['name' => 'Alaska', 'state_code' => 'AK', 'created_at' => now()],
            ['name' => 'Arizona', 'state_code' => 'AZ', 'created_at' => now()],
            ['name' => 'Arkansas', 'state_code' => 'AR', 'created_at' => now()],
            ['name' => 'California', 'state_code' => 'CA', 'created_at' => now()],
            ['name' => 'Colorado', 'state_code' => 'CO', 'created_at' => now()],
            ['name' => 'Connecticut', 'state_code' => 'CT', 'created_at' => now()],
            ['name' => 'Delaware', 'state_code' => 'DE', 'created_at' => now()],
            ['name' => 'Florida', 'state_code' => 'FL', 'created_at' => now()],
            ['name' => 'Georgia', 'state_code' => 'GA', 'created_at' => now()],
            ['name' => 'Hawaii', 'state_code' => 'HI', 'created_at' => now()],
            ['name' => 'Idaho', 'state_code' => 'ID', 'created_at' => now()],
            ['name' => 'Illinois', 'state_code' => 'IL', 'created_at' => now()],
            ['name' => 'Indiana', 'state_code' => 'IN', 'created_at' => now()],
            ['name' => 'Iowa', 'state_code' => 'IA', 'created_at' => now()],
            ['name' => 'Kansas', 'state_code' => 'KS', 'created_at' => now()],
            ['name' => 'Kentucky', 'state_code' => 'KY', 'created_at' => now()],
            ['name' => 'Louisiana', 'state_code' => 'LA', 'created_at' => now()],
            ['name' => 'Maine', 'state_code' => 'ME', 'created_at' => now()],
            ['name' => 'Maryland', 'state_code' => 'MD', 'created_at' => now()],
            ['name' => 'Massachusetts', 'state_code' => 'MA', 'created_at' => now()],
            ['name' => 'Michigan', 'state_code' => 'MI', 'created_at' => now()],
            ['name' => 'Minnesota', 'state_code' => 'MN', 'created_at' => now()],
            ['name' => 'Mississippi', 'state_code' => 'MS', 'created_at' => now()],
            ['name' => 'Missouri', 'state_code' => 'MO', 'created_at' => now()],
            ['name' => 'Montana', 'state_code' => 'MT', 'created_at' => now()],
            ['name' => 'Nebraska', 'state_code' => 'NE', 'created_at' => now()],
            ['name' => 'Nevada', 'state_code' => 'NV', 'created_at' => now()],
            ['name' => 'New Hampshire', 'state_code' => 'NH', 'created_at' => now()],
            ['name' => 'New Jersey', 'state_code' => 'NJ', 'created_at' => now()],
            ['name' => 'New Mexico', 'state_code' => 'NM', 'created_at' => now()],
            ['name' => 'New York', 'state_code' => 'NY', 'created_at' => now()],
            ['name' => 'North Carolina', 'state_code' => 'NC', 'created_at' => now()],
            ['name' => 'North Dakota', 'state_code' => 'ND', 'created_at' => now()],
            ['name' => 'Ohio', 'state_code' => 'OH', 'created_at' => now()],
            ['name' => 'Oklahoma', 'state_code' => 'OK', 'created_at' => now()],
            ['name' => 'Oregon', 'state_code' => 'OR', 'created_at' => now()],
            ['name' => 'Pennsylvania', 'state_code' => 'PA', 'created_at' => now()],
            ['name' => 'Rhode Island', 'state_code' => 'RI', 'created_at' => now()],
            ['name' => 'South Carolina', 'state_code' => 'SC', 'created_at' => now()],
            ['name' => 'South Dakota', 'state_code' => 'SD', 'created_at' => now()],
            ['name' => 'Tennessee', 'state_code' => 'TN', 'created_at' => now()],
            ['name' => 'Texas', 'state_code' => 'TX', 'created_at' => now()],
            ['name' => 'Utah', 'state_code' => 'UT', 'created_at' => now()],
            ['name' => 'Vermont', 'state_code' => 'VT', 'created_at' => now()],
            ['name' => 'Virginia', 'state_code' => 'VA', 'created_at' => now()],
            ['name' => 'Washington', 'state_code' => 'WA', 'created_at' => now()],
            ['name' => 'West Virginia', 'state_code' => 'WV', 'created_at' => now()],
            ['name' => 'Wisconsin', 'state_code' => 'WI', 'created_at' => now()],
            ['name' => 'Wyoming', 'state_code' => 'WY', 'created_at' => now()],
        ];

        // Inserting the states into the database
        State::insert($states);
    }
}
