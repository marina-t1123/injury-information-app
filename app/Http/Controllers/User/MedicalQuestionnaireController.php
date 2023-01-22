<?php

namespace App\Http\Controllers\User;

use App\Models\Athlete;
use App\Models\MedicalQuestionnaire;
use App\Models\MedicalRecord;
use App\Models\MedicalImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalQuestionnaireRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MedicalQuestionnaireController extends Controller
{
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
        $athlete = Athlete::getAthlete($athlete_id);
        //選手に紐ずく問診票を取得する
        // $medicalQuestionnaires = $athlete->with('medicalQuestionnaires')->paginate(4);
        $medicalQuestionnaires = Athlete::getAthleteAndMedicalQuestionnaires($athlete_id)->paginate(2);
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
        $athlete = Athlete::getAthlete($athlete_id);
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

        //問診票とカルテを新規作成する
        DB::beginTransaction();
        try {
            $createMedicalQuestionnaire = MedicalQuestionnaire::create([
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
                'hospital_day' => $request->hospital_day,
                'attending_physician' => $request->attending_physician,
                'athlete_id' => $athlete_id,
            ]);

            //問診票に紐付いたカルテも新規作成する
            MedicalRecord::create([
                'hospital_day' => $request->hospital_day,
                'attending_physician' => $request->attending_physician,
                'medical_questionnaire_id' => $createMedicalQuestionnaire->id
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            // 全てのエラー・例外をキャッチしてログに残す
            Log::error($e);
            //フロントにエラーを通知するので、例外を投げる
            throw $e;
            DB::rollBack();
        }

        // 問診票の新規作成メッセージを作成
        Session::flash('message', '問診票とカルテを登録しました。');

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

    /**
     * 問診票の編集画面の表示
     *
     * @param int $medical_questionnaire_id
     * @return \Illuminate\View\View
     */
    public function edit($medical_questionnaire_id)
    {
        //編集を行う問診票を選手情報と一緒に取得
        $medicalQuestionnaire = MedicalQuestionnaire::getMedicalQuestionnaireAndAthlete($medical_questionnaire_id);

        //問診票編集ページへリダイレクト
        return view('medical-questionnaire.edit', compact('medicalQuestionnaire'));
    }

    //問診票の編集機能
    public function update(MedicalQuestionnaireRequest $request, $medical_questionnaire_id)
    {
        //編集する問診票と選手情報を取得する
        $medicalQuestionnaire = MedicalQuestionnaire::getMedicalQuestionnaireAndAthlete($medical_questionnaire_id);

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
        } elseif(empty($validateInjuryImageFile && empty($registerInjuryImageFile))) { //フォームから画像が送信されていないかつ、登録済みの画像もない場合
            //nullを格納する
            $updateInjuryImageFileName = null;
        }

        //問診票を更新する
        if(!empty($request))
        {
            DB::beginTransaction();
            try {
                //編集する詳細データを設定
                $updateMedicalQuestionnaireData = [
                    //編集フォームから送信された値を格納する
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
                    'injury_image' => $updateInjuryImageFileName,
                    'hospital_day' => $request->hospital_day,
                    'attending_physician' => $request->attending_physician
                ];
                //詳細データを更新する
                $medicalQuestionnaire->update($updateMedicalQuestionnaireData);
                DB::commit();
            } catch (\Throwable $e) {
                // 全てのエラー・例外をキャッチしてログに残す
                Log::error($e);
                //フロントにエラーを通知するので、例外を投げる
                throw $e;
                DB::rollBack();
            }
        }

        //編集成功のメッセージを作成する
        Session::flash('message', '問診票の編集をしました。');

        //問診票メニューにリダイレクトする
        return redirect()->route('user.medical-questionnaire.show.menu', ['athlete_id' => $medicalQuestionnaire->athlete->id]);
    }

    //問診票(カルテ)の削除機能
    public function destroy($medical_questionnaire_id)
    {
        //削除する問診票を取得する
        $medicalQuestionnaire = MedicalQuestionnaire::getMedicalQuestionnaireAndAthlete($medical_questionnaire_id);

        //storage>app>public>injury-image配下に登録している問診票の画像があった場合、削除する
        if(!is_null($medicalQuestionnaire->injury_image))
        {
            ImageService::destroy($medicalQuestionnaire->injury_image, 'injury-image');
        }

        //問診票に紐ずくカルテを取得する
        $medicalRecord = $medicalQuestionnaire->medicalRecord;
        //問診票に紐ずくカルテの画像を取得する
        $medicalImages = MedicalImage::getMedicalImageAndMedicalRecord($medicalRecord->id);

        //storage>app>public>medical-image配下に登録されているカルテ画像があった場合、削除する
        if(!is_null($medicalImages)){
            foreach($medicalImages as $medicalImage){
                ImageService::destroy($medicalImage->medical_image, 'medical-image');
            }
        }

        //削除する問診票に紐ずく選手IDを取得
        $athlete_id = $medicalQuestionnaire->athlete->id;

        //問診票を削除する
        $medicalQuestionnaire->delete();

        //問診票メニュー画面で問診票と紐ずくカルテを削除しましたとううメッセージを表示する
        Session::flash('message', '問診票と紐づくカルテを削除しました。');

        //選手の問診票メニューページへリダイレクトする
        return redirect()->route('user.medical-questionnaire.show.menu', compact('athlete_id'));
    }
}
