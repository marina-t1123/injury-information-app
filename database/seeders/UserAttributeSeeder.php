<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_attribute')->insert([
            [
                'team' => 'フリーランス',
                'phone_number' => '050-1223-4535',
                'career' => '帝京大学 柔道部サポート(2009~2013)。東海大相模高校 柔道部サポート(2013~2020)。',
                'user_id' => '1',
                'created_at' => '2022-12-01 00:00:00',
                'updated_at' => '2022-12-01 00:00:00',
            ],
            [
                'team' => '株式会社スポーツネクスト',
                'phone_number' => '050-1223-4535',
                'career' => '帝京大学 柔道部サポート(2009~2013)。東海大相模高校 柔道部サポート(2013~2020)。',
                'user_id' => '2',
                'created_at' => '2022-12-01 00:00:00',
                'updated_at' => '2022-12-01 00:00:00',
            ],
            [
                'team' => '株式会社エスト',
                'phone_number' => '03-4987-4525',
                'career' => '帝京大学 柔道部サポート(2009~2013)。東海大相模高校 柔道部サポート(2013~2020)。',
                'user_id' => '3',
                'created_at' => '2022-12-01 00:00:00',
                'updated_at' => '2022-12-01 00:00:00',
            ],
        ]);
    }
}
