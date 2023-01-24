<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\MedicalHistory;

class DoctorMedicalHistoryController extends Controller
{
    /**
     * 既往歴メニューページの表示
     *
     * @param int $athlete_id
     * @return Illuminate\View\View
     */
    public function showMedicalHistoryPage($athlete_id)
    {
        //既往歴を表示する選手を取得
        $athlete = Athlete::findOrFail($athlete_id);
        //選手に紐ずく既往歴を取得する
        $medicalHistories = Athlete::getAthleteAndMedicalHistory($athlete_id)->paginate(4);

        //既往歴メニューページに遷移する
        return view('medical-history.medical-history-menu', compact('athlete', 'medicalHistories'));
    }

    //既往歴詳細ページ
    public function show($medical_history_id)
    {
        //詳細表示する既往歴を取得
        $medicalHistory = MedicalHistory::getMedicalHistoryAndAthleteData($medical_history_id);

        //既往歴詳細ページで表示する既往歴を詳細ページへ渡して、リダイレクトする
        return view('medical-history.show', compact('medicalHistory'));
    }

}
