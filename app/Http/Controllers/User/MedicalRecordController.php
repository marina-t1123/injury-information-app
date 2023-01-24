<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\MedicalImage;
use App\Models\MedicalRecord;


class MedicalRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    //カルテ詳細ページを表示する
    public function show($medical_questionnaire_id)
    {
        //選手の問診票に紐ずくカルテを取得する
        $medicalRecord = MedicalRecord::getMedicalRecordAndMedicalQuestionnaire($medical_questionnaire_id);

        //カルテに紐ずく画像を取得する(複数ある場合はcollection型)
        $medicalImages = MedicalImage::getMedicalImageAndMedicalRecord($medicalRecord->id);

        //選手情報を取得する
        $athlete = Athlete::getAthlete($medicalRecord->medicalQuestionnaire->athlete_id);

        //カルテ詳細ページにリダイレクトする
        return view('medical-record.show', compact('medicalRecord', 'athlete', 'medicalImages'));
    }

}
