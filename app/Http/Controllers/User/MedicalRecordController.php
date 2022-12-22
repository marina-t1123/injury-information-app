<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\MedicalQuestionnaire;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    // // カルテ編集ページ表示
    // public function edit()
    // {

    // }

    // //カルテ編集機能
    // public function update(){

    // }

    //カルテ詳細ページを表示する
    public function show($athlete_id)
    {
        //問診票に紐付くカルテを取得する
        $medicalRecord = Athlete::with('medicalQuestionnaire.medicalRecord')
                            ->where('id', $athlete_id)
                            ->first();

        //カルテ詳細ページにリダイレクトする
        return view('medical-menu.medical-record.show', compact('medicalRecord'));
    }
}
