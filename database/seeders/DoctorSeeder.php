<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
            [
                'name' => '高橋 和樹',
                'email' => 'doctor01@test.com',
                'password' => Hash::make('password1'),
                'created_at' => '2022/12/01 00:00:00'
            ],
            [
                'name' => '山中 隆弘',
                'email' => 'doctor02@test.com',
                'password' => Hash::make('password2'),
                'created_at' => '2022/12/01 00:00:00'
            ],
            [
                'name' => '田中 幸助',
                'email' => 'doctor03@test.com',
                'password' => Hash::make('password3'),
                'created_at' => '2022/12/01 00:00:00'
            ],
        ]);
    }
}
