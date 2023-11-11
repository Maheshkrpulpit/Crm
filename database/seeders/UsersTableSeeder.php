<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Super Admin',
                'email'          => 'superadmin@pulpitdma.com',
                'username'       => 'superadmin',
                'password'       => Hash::make('12345678'),
                'avatar'         => 'avatar-1.jpg',
                'phone'          => 9661663666,
                'status'         => 1,
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at'     => now(),
            ],
            [
                'id'             => 2,
                'name'           => 'Admin',
                'email'          => 'admin@pulpitdma.com',
                'username'       => 'admin',
                'password'       => Hash::make('12345678'),
                'avatar'         => 'avatar-1.jpg',
                'phone'          => 7488708501,
                'status'         => 1,
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at'     => now(),
            ],
            [
                'id'             => 3,
                'name'           => 'Mahesh',
                'email'          => 'mahesh@pulpitdma.com',
                'username'       => 'mahesh',
                'password'       => Hash::make('12345678'),
                'avatar'         => 'avatar-1.jpg',
                'phone'          => 9860059715,
                'status'         => 1,
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at'     => now(),
            ],
            [
                'id'             => 4,
                'name'           => 'Mohan',
                'email'          => 'mohan@pulpitdma.com',
                'username'       => 'mohan',
                'password'       => Hash::make('12345678'),
                'avatar'         => 'avatar-1.jpg',
                'phone'          => 9006810031,
                'status'         => 1,
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at'     => now(),
            ],
            
        ];
        User::insert($users);
    }
}