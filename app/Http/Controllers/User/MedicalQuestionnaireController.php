<?php

namespace App\Http\Controllers\User;

use App\Models\Athlete;
use App\Models\MedicalQuestionnaire;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalQuestionnaireRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MedicalQuestionnaireController extends Controller
{
    /**
     * 各選手の問診票メニュー画面の表示
     *
     * @param int $athlete_id
     * @return \Illuminate\View\View
     */
    public function showMedicalQuestionnairePage($athlete_id)
    {
        //選手情報を取得する
        $athlete = Athlete::findOrFail($athlete_id);
        //選手に紐ずく問診票を取得する
        $medicalQuestionnaires = Athlete::findOrFail($athlete_id)
            ->medicalQuestionnaires()
            ->paginate(4);

        //問診票メニューページにリダイレクトする
        return view('medical-questionnaire.medical-questionnaire-menu', compact('athlete', 'medicalQuestionnaires'));
    }

    /**
     * 問診票の新規作成画面の表示
     *
     * @param int $athlete_id
     * @return \Illuminate\View\View
     */
    public function create($athlete_id)
    {
        //選手情報を取得
        $athlete = Athlete::findOrFail($athlete_id);

        //問診票の新規作成画面にリダイレクトする
        return view('medical-questionnaire.create', compact('athlete'));
    }

    /**
     * 問診票の新規作成機能
     *
     * @param MedicalQuestionnaireRequest $request
     * @param int $athlete_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MedicalQuestionnaireRequest $request, $athlete_id)
    {
        //問診票を作成する選手情報を取得する
        // $athlete = Athlete::findOrFail($athlete_id);

        //バリデーション済みの怪我の画像を変数に格納する。
        $injuryImageFile1 = $request->injury_image1;
        $injuryImageFile2 = $request->injury_image2;
        $injuryImageFile3 = $request->injury_image3;
        // $injuryImageFile1 = $request->file('injury_image1');
        // $injuryImageFile2 = $request->file('injury_image2');
        // $injuryImageFile3 = $request->file('injury_image3');

        //app>public配下に画像を登録する処理
        //1枚目
        //もし、フォームから画像がPOST送信されて、かつバリデーション通った画像がある場合
        if(!is_null($injuryImageFile1)){
            // storage > app > public > injury-imageディレクトリ配下に自動的にファイル名を付けて保存する
            $injuryImagePath1 = Storage::putFile('public/injury-image', $injuryImageFile1);
            // パスからファイル名を取得する
            $injuryImageFile1 = basename($injuryImageFile1);
        } else {
            $injuryImagePath1 = null;
        }

        //2枚目
        if(!is_null($injuryImageFile2)){
            $injuryImagePath2 = Storage::putFile('public/injury-image', $injuryImageFile2);
        } else {
            $injuryImagePath2 = null;
        }

        //3枚目
        if(!is_null($injuryImageFile3)){
            $injuryImagePath3 = Storage::putFile('public/injury-image', $injuryImageFile3);
        } else {
            $injuryImagePath3 = null;
        }

        //バリデーション済みの入力値をそれぞれのカラムに指定する
        MedicalQuestionnaire::create([
            'injured_day' => $request->injured_day,
            'injured_area' => $request->injured_area,
            'injury_status' => $request->injury_status,
            'claim' => $request->claim,
            'pain' => $request->pain,
            'swelling' => $request->swelling,
            'first_aid' => $request->first_aid,
            'orthopedic_test' => $request->orthopedic_test,
            'muscle_strength_test' => $request->muscle_strength_test,
            'trainer_findings' => $request->trainer_findings,
            'future_plans' => $request->future_plans,
            'injury_image1' => $injuryImagePath1,
            'injury_image2' => $injuryImagePath2,
            'injury_image3' => $injuryImagePath3,
            'athlete_id' => $athlete_id,
        ]);

        // 問診票メニューページに遷移する
        return redirect()->route('user.medical-questionnaire.show.menu', compact('athlete_id'));
    }

    //問診票の詳細画面の表示

    public function show($medical_questionnaire_id)
    {
        //詳細を表示する問診票を紐付いている選手情報と一緒に取得する
        $medicalQuestionnaire = MedicalQuestionnaire::findOrFail($medical_questionnaire_id)
                                    ->with('athlete')
                                    ->first();
        //問診票詳細ページに遷移する
        return view('medical-questionnaire.show', compact('medicalQuestionnaire'));
    }


    //問診票の編集画面の表示


    //問診票の編集機能


    //問診票の削除機能



}
