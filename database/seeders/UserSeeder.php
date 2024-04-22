<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyData = [
            'name' => 'Diki',
            'email' => 'diki@konterdigital.com',
            'password' => Hash::make('password'),
            'username' => 'dikiafriadi',
            'fullname' => 'Diki Afriadi',
            'role' => 'admin',
        ];

        DB::table('users')->insert($dummyData);
    }
}
