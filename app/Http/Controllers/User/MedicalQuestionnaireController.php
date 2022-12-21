<?php

namespace App\Http\Controllers\User;

use App\Models\Athlete;
use App\Models\MedicalQuestionnaire;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalQuestionnaireRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Session;

class MedicalQuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }
    /**
     * 各選手の問診票メニュー画面の表示
     *
     * @param int $athlete_id
     * @param \Illuminate\Database\Eloquent\Collection $medicalQuestionnaires
     * @return \Illuminate\View\View
     */
    public function showMedicalQuestionnairePage($athlete_id)
    {
        //選手情報を取得する
        $athlete = Athlete::findOrFail($athlete_id);
        //選手に紐ずく問診票を取得する
        // $medicalQuestionnaires = $athlete->with('medicalQuestionnaires')->paginate(4);
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
        //バリデーション済みの怪我の画像を変数に格納する。
        $injuryImageFile = $request->injury_image;

        //app>public配下に怪我の画像を登録する処理
        //もし、フォームから画像がPOST送信されて、かつバリデーション通った画像がある場合
        if(!is_null($injuryImageFile)){
            // サービスに登録したimageServiceクラスのuploadメソッドを使って画像登録処理を実行
            // 第一引数に送信された画像ファイル、第二引数にstorage配下で画像を置くディレクトリのフォルダ名を指定
            $injuryImageFileName = ImageService::upload($injuryImageFile, 'injury-image');
        } else { //フォームから画像がPOST送信されなかった場合
            $injuryImageFileName = null;
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
            'injury_image' => $injuryImageFileName,
            'athlete_id' => $athlete_id,
        ]);

        // 問診票の新規作成メッセージを作成
        Session::flash('message', '問診票を登録しました。');

        // 問診票メニューページのアクションを実行する
        return redirect()->route('user.medical-questionnaire.show.menu', compact('athlete_id'));
    }

    /**
     * 問診票の詳細画面の表示
     *
     * @param int $medical_questionnaire_id
     * @return \Illuminate\View\View
     */
    public function show($medical_questionnaire_id)
    {
        //詳細を表示する問診票を紐付いている選手情報と一緒に取得する
        $medicalQuestionnaire = MedicalQuestionnaire::find($medical_questionnaire_id);

        //問診票詳細ページに遷移する
        return view('medical-questionnaire.show', compact('medicalQuestionnaire'));
    }

    //問診票の編集画面の表示
    /**
     * 問診票の編集画面の表示
     *
     * @param int $medical_questionnaire_id
     * @return \Illuminate\View\View
     */
    public function edit($medical_questionnaire_id)
    {
        //編集を行う問診票を選手情報と一緒に取得
        $medicalQuestionnaire = MedicalQuestionnaire::with('athlete')
                                    ->where('id' , $medical_questionnaire_id)
                                    ->first();

        //問診票編集ページへリダイレクト
        return view('medical-questionnaire.edit', compact('medicalQuestionnaire'));
    }

    //問診票の編集機能
    public function update(MedicalQuestionnaireRequest $request, $medical_questionnaire_id)
    {
        //編集する問診票を取得する
        $medicalQuestionnaire = MedicalQuestionnaire::with('athlete')
                                    ->where('id', $medical_questionnaire_id)
                                    ->first();

        //変更前の登録済みの画像ファイルを取得
        $registerInjuryImageFile = $medicalQuestionnaire->injury_image;
        //POST送信されたバリデーション済みの画像ファイルを取得
        $validateInjuryImageFile = $request->injury_image;

        //POST送信されたバリデーション済みの画像がある場合かつ、登録済みの画像があった場合
        if(!empty($validateInjuryImageFile && !empty($registerInjuryImageFile))){
            //storage>app>public>injury-image配下にある登録済みの画像を削除する
            ImageService::destroy($registerInjuryImageFile, '/injury-image/');
            //POST送信された画像ファイルをStorageに登録する
            $updateInjuryImageFileName = ImageService::upload($validateInjuryImageFile, 'injury-image');
            // $updateInjuryImageFileName = $imageService->upload($validateInjuryImageFile, 'injury-image');
        } elseif(!empty($validateInjuryImageFile && empty($registerInjuryImageFile))){ //POST送信されたバリデーション済みの画像のみがある場合
            //POST送信された画像ファイルをStorageに登録する
            $updateInjuryImageFileName = ImageService::upload($validateInjuryImageFile, 'injury-image');
        } else { //フォームから画像が送信されていないかつ、登録済みの画像もない場合
            //nullを格納する
            $updateInjuryImageFileName = null;
        }

        //編集フォームから送信された値を格納する
        $medicalQuestionnaire->injured_day = $request->injured_day;
        $medicalQuestionnaire->injured_area = $request->injured_area;
        $medicalQuestionnaire->injury_status = $request->injury_status;
        $medicalQuestionnaire->claim = $request->claim;
        $medicalQuestionnaire->pain = $request->pain;
        $medicalQuestionnaire->swelling = $request->swelling;
        $medicalQuestionnaire->first_aid = $request->first_aid;
        $medicalQuestionnaire->orthopedic_test = $request->orthopedic_test;
        $medicalQuestionnaire->muscle_strength_test = $request->muscle_strength_test;
        $medicalQuestionnaire->trainer_findings = $request->trainer_findings;
        $medicalQuestionnaire->future_plans = $request->future_plans;
        $medicalQuestionnaire->injury_image = $updateInjuryImageFileName;

        //編集内容を登録する
        $medicalQuestionnaire->save();

        //編集成功のメッセージを作成する
        Session::flash('message', '問診票の編集をしました。');

        //問診票メニューにリダイレクトする
        return redirect()->route('user.medical-questionnaire.show.menu', ['athlete_id' => $medicalQuestionnaire->athlete->id]);
    }

    //問診票の削除機能
    public function destroy($medical_questionnaire_id)
    {
        //削除する問診票を取得する
        $medicalQuestionnaire = MedicalQuestionnaire::with('athlete')->where('id', $medical_questionnaire_id)->first();

        //storage>app>public>injury-image配下に登録している画像があった場合、削除する
        if($medicalQuestionnaire->injury_image)
        {
            ImageService::destroy($medicalQuestionnaire->injury_image, 'injury-image');
        }

        //削除する問診票に紐ずく選手IDを取得
        $athlete_id = $medicalQuestionnaire->athlete->id;

        //問診票を削除する
        $medicalQuestionnaire->delete();

        //選手の問診票メニューページへリダイレクトする
        return redirect()->route('user.medical-questionnaire.show.menu', compact('athlete_id'));
    }
}
