<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicalImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medical_images')->insert([
            [
                'medical_record_id' => '1',
                'medical_image' => 'test_image4.png',
                'created_at' => new Carbon('2022-06-03'),
                'updated_at' => new Carbon('2022-06-03')
            ],
            [
                'medical_record_id' => '1',
                'medical_image' => 'test_image5.png',
                'created_at' => new Carbon('2022-06-03'),
                'updated_at' => new Carbon('2022-06-03')
            ],
            [
                'medical_record_id' => '2',
                'medical_image' => 'test_image6.png',
                'created_at' => new Carbon('2022-06-03'),
                'updated_at' => new Carbon('2022-06-03')
            ],
            [
                'medical_record_id' => '3',
                'medical_image' => 'test_image3.jpeg',
                'created_at' => new Carbon('2022-06-03'),
                'updated_at' => new Carbon('2022-06-03')
            ],
            [
                'medical_record_id' => '3',
                'medical_image' => 'test_image1.jpeg',
                'created_at' => new Carbon('2022-06-03'),
                'updated_at' => new Carbon('2022-06-03')
            ],
        ]);
    }
}
