<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\MedicalQuestionnaire;
use App\Models\MedicalImage;
use App\Http\Requests\MedicalRecordEditRequest;
use App\Models\MedicalRecord;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MedicalRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    //カルテ詳細ページを表示する
    public function show($medical_questionnaire_id)
    {
        //選手にカルテを取得する
        $medicalRecord = MedicalRecord::where('medical_questionnaire_id', $medical_questionnaire_id)
                            ->first();

        //カルテに紐ずく画像を取得する(複数ある場合はcollection型)
        $medicalImages = MedicalImage::where('medical_record_id', $medicalRecord->id)->get();

        //選手IDを取得する
        $athleteId = MedicalQuestionnaire::findOrFail($medical_questionnaire_id)
                    ->value('athlete_id');

        //選手情報を取得する
        $athlete = Athlete::findOrFail($athleteId);

        //カルテ詳細ページにリダイレクトする
        return view('medical-record.show', compact('medicalRecord', 'athlete', 'medicalImages'));
    }

    //カルテ編集画面を表示
    // public function edit()
    // {
    //     //表示するカルテ情報を取得する

    //     //カルテ編集画面にリダイレクトする

    // }

    //カルテ編集機能
    // public function update(MedicalRecordEditRequest $request, $medical_record_id)
    // {
    //     //編集するカルテを取得する
    //     $medicalRecord = MedicalRecord::findOrFail($medical_record_id);

    //     //バリデーション済みの画像を取得する
    //     $medicalImageFiles = $request->file('files');

    //     //フォームからバリデーション済みの複数の画像が送信された際
    //     if(!is_null($medicalImageFiles)){
    //         //それそれのファイル名を取得して、storage>app>public>medical-image配下に画像を登録する
    //         foreach($medicalImageFiles as $medicalImageFile){
    //             //Imageサービスのuploadメソッドで、ファイル名の取得とLaravelにファイル登録を行う
    //             $medicalImageFileName = ImageService::upload($medicalImageFile, 'medical-image');
    //             //DBにカルテに紐ずくメディカル画像としてファイル名などを登録する
    //             $medicalImage = MedicalImage::create([
    //                 'medical_record_id' => $request->id,
    //                 'medical_image' => $medicalImageFileName
    //             ]);
    //         }
    //     } else { //フォームから画像が送信されなかった場合
    //         //ファイル名をnullにして、画像モデルをDB登録する
    //         $medicalImageFileName = null;
    //         $medicalImage = MedicalImage::create([
    //             'medical_record_id' => $request->id,
    //             'medical_image' => $medicalImageFileName
    //         ]);
    //     }

    //     //カルテのバリデーション済みの入力値をそれぞれのカラムに指定する
    //     $medicalRecord->hospital_day = $request->hospital_day;
    //     $medicalRecord->attending_physician = $request->attending_physician;
    //     $medicalRecord->medical_examination = $request->medical_examination;
    //     $medicalRecord->tests = $request->tests;
    //     $medicalRecord->doctor_findings = $request->doctor_findings;
    //     $medicalRecord->swelling = $request->swelling;
    //     $medicalRecord->future_policies = $request->future_policies;

    //     //編集内容を保存する
    //     $medicalRecord->save();

    //     //編集成功のメッセージを表示する
    //     Session::flash('message', 'カルテの編集をしました。');

    //     //カルテの詳細画面へ遷移する
    //     // return redirect()->route();
    // }
}
