<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'trainer1',
                'email' => 'trainer01@test.com',
                'password' => Hash::make('password1'),
                'created_at' => '2022/12/01 00:00:00'
            ],
            [
                'name' => 'trainer2',
                'email' => 'trainer02@test.com',
                'password' => Hash::make('password2'),
                'created_at' => '2022/12/01 00:00:00'
            ],
            [
                'name' => 'trainer3',
                'email' => 'trainer03@test.com',
                'password' => Hash::make('password3'),
                'created_at' => '2022/12/01 00:00:00'
            ],
        ]);
    }
}
