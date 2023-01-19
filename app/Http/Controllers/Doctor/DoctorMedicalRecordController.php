<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalRecordEditRequest;
use App\Models\Athlete;
use App\Models\MedicalQuestionnaire;
use App\Models\MedicalRecord;
use App\Models\MedicalImage;
use App\Services\ImageService;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class DoctorMedicalRecordController extends Controller
{
    /**
     * カルテ詳細・編集ページ表示
     *
     * @param int $medical_questionnaire_id
     * @param \Illuminate\Database\Eloquent\Collection|null $medicalImages
     * @return \Illuminate\View\View
     */
    public function showMedicalRecordPage($medical_questionnaire_id)
    {
        //表示するカルテを取得する
        $medicalRecord = MedicalRecord::where('medical_questionnaire_id', $medical_questionnaire_id)->first();

        //カルテに紐ずく画像を取得する(複数ある場合はcollection型)
        $medicalImages = MedicalImage::where('medical_record_id', $medicalRecord->id)->get();

        //選手IDを取得する
        $athleteId = MedicalQuestionnaire::findOrFail($medical_questionnaire_id)
            ->value('athlete_id');

        //選手情報を取得する
        $athlete = Athlete::findOrFail($athleteId);

        //カルテ詳細・編集ページへリダイレクトする
        return view('medical-record.medical-record-menu', compact('medicalRecord', 'athlete', 'medicalImages'));
    }

    //編集画面表示
    public function edit($medical_record_id)
    {
        //選手の問診票に紐ずくカルテを取得する
        $medicalRecord = MedicalRecord::findOrFail($medical_record_id);

        //カルテに紐ずく画像を取得する(複数ある場合はcollection型)
        $medicalImages = MedicalImage::where('medical_record_id', $medicalRecord->id)->get();

        //選手IDを取得する
        $medicalQuestionnaire = MedicalQuestionnaire::with('athlete')
                    ->where('id', $medicalRecord->medical_questionnaire_id)
                    ->first();

        //カルテ編集画面にリダイレクトする
        return view('medical-record.edit', compact('medicalRecord', 'medicalImages', 'medicalQuestionnaire'));
    }

    //カルテ編集機能
    public function update(MedicalRecordEditRequest $request, $medical_record_id)
    {
        //編集するカルテを取得する
        $medicalRecord = MedicalRecord::findOrFail($medical_record_id);

        //既にカルテに画像が登録されている場合は、画像ファイル名を取得する
        $registerMedicalImageFiles = $medicalRecord->medicalImages()->get();
        // ddd($medicalRecord,$registerMedicalImageFiles);
        //バリデーション済みの画像(複数の場合は全て)を取得する
        $validateMedicalImageFiles = $request->file('files');

        //画像編集・画像登録処理
        //フォームからバリデーション済みの複数の画像が送信され、かつ登録済みの画像がある場合
        if(!is_null($validateMedicalImageFiles) && !is_null($registerMedicalImageFiles)){
            //元々登録済みのファイルを削除する
            foreach($registerMedicalImageFiles as $registerMedicalImageFile){
                //storage>app>public>medical-image配下にある登録済みの画像を削除
                ImageService::destroy($registerMedicalImageFile, '/medical-image/');
                //DBのMedicalImageテーブルに登録済みの画像ファイル名を削除する
                MedicalImage::where('medical_record_id', $medicalRecord->id)->delete();
            }
            //バリデーション済みのファイル名を取得して、storage>app>public>medical-image配下に画像を登録する
            foreach($validateMedicalImageFiles as $medicalImageFile){
                //Imageサービスのuploadメソッドで、ファイル名の取得とLaravelにファイル登録を行う
                $medicalImageFileName = ImageService::upload($medicalImageFile, 'medical-image');
                //DBにカルテに紐ずくメディカル画像としてファイル名などを登録する
                $medicalImage = MedicalImage::create([
                    'medical_record_id' => $medicalRecord->id,
                    'medical_image' => $medicalImageFileName
                ]);
            }
        } elseif(!is_null($validateMedicalImageFiles) && is_null($registerMedicalImageFiles)){ //バリデーション済みの画像のみある場合
            //バリデーション済みのファイル名を取得して、storage>app>public>medical-image配下に画像を登録する
            foreach($validateMedicalImageFiles as $medicalImageFile){
                //Imageサービスのuploadメソッドで、ファイル名の取得とLaravelにファイル登録を行う
                $medicalImageFileName = ImageService::upload($medicalImageFile, 'medical-image');
                //DBにカルテに紐ずくメディカル画像としてファイル名などを登録する
                MedicalImage::create([
                    'medical_record_id' => $medicalRecord->id,
                    'medical_image' => $medicalImageFileName
                ]);
            }
        } elseif (!is_null($validateMedicalImageFiles) && !is_null($registerMedicalImageFiles)) { //フォームから画像が送信されなかった場合
            //ファイル名をnullにして、画像モデルをDB登録する
            MedicalImage::create([
                'medical_record_id' => $medicalRecord->id,
                'medical_image' => null
            ]);
        }

        //カルテのバリデーション済みの入力値をそれぞれのカラムに指定する
        $medicalRecord->hospital_day = $request->hospital_day;
        $medicalRecord->attending_physician = $request->attending_physician;
        $medicalRecord->medical_examination = $request->medical_examination;
        $medicalRecord->tests = $request->tests;
        $medicalRecord->doctor_findings = $request->doctor_findings;
        $medicalRecord->swelling = $request->swelling;
        $medicalRecord->future_policies = $request->future_policies;

        //編集内容を保存する
        $medicalRecord->save();

        //カルテに紐ずく問診票を取得
        $medicalQuestionnaire = $medicalRecord->medicalQuestionnaire()->with('athlete')->first();
        // ddd($medicalQuestionnaire);
        //カルテの選手情報を取得
        $athlete = Athlete::findOrFail($medicalQuestionnaire->athlete_id);
        //MedicalImageの画像ファイル名を取得
        $medicalImages = $medicalRecord->medicalImages()->get();

        //編集成功のメッセージを表示する
        Session::flash('message', 'カルテの編集をしました。');

        //カルテ詳細・編集ページへ遷移する
        return view('medical-record.medical-record-menu', compact('medicalRecord', 'medicalImages', 'athlete'));
    }

}
