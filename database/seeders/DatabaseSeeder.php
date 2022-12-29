<?php

namespace Database\Seeders;

use App\Models\MedicalQuestionnaire;
use App\Models\MedicalRecord;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            DoctorSeeder::class,
            AthleteSeeder::class,
            MedicalHistorySeeder::class,
            MedicalQuestionnaireSeeder::class,
            MedicalRecordSeeder::class,
            MedicalImageSeeder::class
        ]);
    }
}
