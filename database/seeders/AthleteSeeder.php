<?php

namespace Database\Seeders;

use App\Models\Athlete;
use App\Models\MedicalHistory;
use Illuminate\Database\Seeder;

class AthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Athlete::factory()
            ->count(20)
            ->create();
        // Athlete::factory(20)
        //     ->has(MedicalHistory::factory()->count(20))
        //     ->create();
    }
}
