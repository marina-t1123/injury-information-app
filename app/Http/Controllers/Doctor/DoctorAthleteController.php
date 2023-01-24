<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Athlete;

class DoctorAthleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctors');
    }

    //選手詳細画面の表示
    public function show($athlete_id)
    {
        $athlete = Athlete::getAthlete($athlete_id);

        return view('athlete.show', compact('athlete'));
    }
}
