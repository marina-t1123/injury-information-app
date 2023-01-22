<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctor_attribute')->insert([
            [
                'hospital_name' => '船橋整形外科',
                'phone_number' => '010-1111-1111',
                'particular_field' => '膝関節、足関節',
                'career' => '順天堂大学・大学院 整形外科(2015-2018)。船橋整形外科(2018~)。日本スポーツ協会公認スポーツドクター。',
                'doctor_id' => '1',
                'created_at' => '2022-12-01 00:00:00'
            ],
            [
                'hospital_name' => '船橋整形外科',
                'phone_number' => '080-1111-1111',
                'particular_field' => '肩関節',
                'career' => '順天堂大学・大学院 整形外科(2010-2019)。船橋整形外科(2018~)。日本スポーツ協会公認スポーツドクター。',
                'doctor_id' => '2',
                'created_at' => '2022-12-01 00:00:00'
            ],
            [
                'hospital_name' => '筑波大学附属病院',
                'phone_number' => '090-1111-1111',
                'particular_field' => '膝関節',
                'career' => '船橋整形外科(2018-2022)。筑波大学附属病院(2022~)。日本整形外科学会公認スポーツ医。',
                'doctor_id' => '3',
                'created_at' => '2022-12-01 00:00:00'
            ],
        ]);
    }
}
