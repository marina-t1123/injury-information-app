<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\MedicalQuestionnaire;

class DoctorMedicalQuestionnaireController extends Controller
{
    /**
     * 問診票詳細・カルテメニューページの表示
     *
     * @param int $athlete_id
     * @param \Illuminate\Database\Eloquent\Collection||null $medicalQuestionnaires
     * @return \Illuminate\View\View
     */
    public function showMedicalQuestionnairePage($athlete_id)
    {
        //問診票詳細・カルテメニューページを表示する選手を取得する
        $athlete = Athlete::getAthlete($athlete_id);
        //選手に紐ずく問診票を取得する
        $medicalQuestionnaires = Athlete::getAthleteAndMedicalQuestionnaires($athlete_id)->paginate(2);

        //問診票詳細・カルテメニューページにリダイレクトする
        return view('medical-questionnaire.medical-questionnaire-menu', compact('athlete', 'medicalQuestionnaires'));
    }


    /**
     * 問診票詳細ページの表示
     *
     * @param int $medical_questionnaire_id
     * @var App\Models\MedicalQuestionnaire $medicalQuestionnaire
     * @return void
     */
    public function show($medical_questionnaire_id)
    {
        //詳細表示する問診票を取得する
        $medicalQuestionnaire = MedicalQuestionnaire::find($medical_questionnaire_id);

        //問診票詳細ページにリダイレクトする
        return view('medical-questionnaire.show', compact('medicalQuestionnaire'));
    }
}
