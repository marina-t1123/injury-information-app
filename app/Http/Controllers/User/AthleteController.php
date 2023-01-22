<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AthleteRequest;
use App\Models\Athlete;
use App\Models\MedicalImage;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AthleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     * 選手設定画面の表示
     *
     * @return \Illuminate\View\View
     */
    public function showSettingPage($athlete_id)
    {
        $athlete = Athlete::getAthlete($athlete_id);

        return view('athlete.setting-page', compact('athlete'));
    }

    /**
     * 選手新規作成画面の表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('athlete.create');
    }

    /**
     * 選手新規作成
     *
     * @param  \App\Http\Requests\AthleteRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AthleteRequest $request)
    //引数では「メソッドインジェクション」という、フォームで入力された値がRequestインスタンスになって、そのクラスをインスタンス化して$requestに格納する。
    {
        //選手を新規作成する
        if(!empty($request))
        {
            DB::beginTransaction();
            try {
                 //バリデーション済みの入力値を取得して、新しく選手を作成。
                Athlete::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'team' => $request->team,
                    'event' => $request->event,
                    'event_detail' => $request->event_detail,
                    'career' => $request->career,
                ]);
                DB::commit();
            } catch (\Throwable $e) {
                // 全てのエラー・例外をキャッチしてログに残す
                Log::error($e);
                //フロントにエラーを通知するので、例外を投げる
                throw $e;
                DB::rollBack();
            }
        }

        //選手登録成功時に表示するフラッシュメッセージ
        Session::flash('message', '選手を登録しました。');

        //登録済みの全選手を取得する。
        $athletes = Athlete::select('id','name','team','event','event_detail')->paginate(6);

        // return view('user.mypage', compact('athletes'));にするとエラーが起きるので下記のようにリダイレクトさせる。
        return redirect()->route('user.mypage', ['athletes' => $athletes]);
    }

    /**
     * 選手編集画面の表示
     *
     * @return \Illuminate\View\View
     */
    public function edit($athlete_id)
    {
        $athlete = Athlete::getAthlete($athlete_id);

        return view('athlete.edit', compact('athlete'));
    }

    /**
     * 選手編集
     *
     * @param  \App\Http\Requests\AthleteRequest  $request
     * @param int $athlete_id
     * @return \Illuminate\View\View
     */
    public function update(AthleteRequest $request, $athlete_id)
    //引数では「メソッドインジェクション」という、フォームで入力された値がRequestインスタンスになって、そのクラスをインスタンス化して$requestに格納する。
    {
        //まず、編集する選手を取得する。
        $targetAthlete = Athlete::getAthlete($athlete_id);

        //選手情報を更新する
        if(!empty($request))
        {
            DB::beginTransaction();
            try {
                //編集する詳細データを設定
                $updateAthleteDate = [
                    'email' => $request->email,
                    'name' => $request->name,
                    'team' => $request->team,
                    'phone_number' => $request->phone_number,
                    'event_detail' => $request->event_detail,
                    'event' => $request->event,
                    'career' => $request->career
                ];
                //編集データを更新する
                $targetAthlete->update($updateAthleteDate);
                DB::commit();
            } catch (\Throwable $e) {
                // 全てのエラー・例外をキャッチしてログに残す
                Log::error($e);
                //フロントにエラーを通知するので、例外を投げる
                throw $e;
                DB::rollBack();
            }
        }

        //更新後の選手を取得する
        $athlete = Athlete::getAthlete($athlete_id);

        //選手登録成功時に表示するフラッシュメッセージ
        Session::flash('message', '選手情報を変更しました。');

        //選手設定画面にリダイレクト
        return view('athlete.setting-page', compact('athlete'));
    }

    /**
     * 選手削除
     *
     * @param int $athlete_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($athlete_id)
    //引数では「メソッドインジェクション」という、フォームで入力された値がRequestインスタンスになって、そのクラスをインスタンス化して$requestに格納する。
    {
        DB::beginTransaction();
        try {
            //まず、削除する選手を取得する。
            $athlete = Athlete::getAthlete($athlete_id);
            //選手に紐ずく既往歴を取得
            $medicalHistories = $athlete->medicalHistories;
            //選手に紐ずく既往歴を削除
            if(!is_null($medicalHistories)){
                foreach($medicalHistories as $medicalHistory){
                    $medicalHistory->delete();
                }
            }
            //問診票・カルテのStorageディレクトリ配下の画像を削除する
            $medicalQuestionnaires = $athlete->medicalQuestionnaires;
            foreach($medicalQuestionnaires as $medicalQuestionnaire){
                //問診票の画像をStorageディレクトリから削除
                $injuryImage = $medicalQuestionnaire->value('injury_image');
                ImageService::destroy($injuryImage, 'injury-image');
                //問診票に紐ずくカルテを取得する
                $medicalRecord = $medicalQuestionnaire->medicalRecord;
                //問診票に紐ずくカルテの画像を取得する
                $medicalImages = MedicalImage::where('medical_record_id', $medicalRecord->id)->get();
                //storage>app>public>medical-image配下に登録されているカルテ画像を削除する
                if(!is_null($medicalImages)){
                    foreach($medicalImages as $medicalImage){
                        ImageService::destroy($medicalImage->medical_image, 'medical-image');
                    }
                }
                //選手に紐ずく問診票を削除(問診票を削除するとカルテも自動的に削除される)
                $medicalQuestionnaire->delete();
            }

            //選手アカウントを削除
            $athlete->delete();

            DB::commit();
        } catch (\Throwable $e) {
            // 全てのエラー・例外をキャッチしてログに残す
            Log::error($e);
            //フロントにエラーを通知するので、例外を投げる
            throw $e;
            DB::rollBack();
        }

        //選手登録成功時に表示するフラッシュメッセージ
        Session::flash('message', '選手情報と選手に紐ずく既往歴・問診票・カルテを削除しました。');

        //トレーナーのマイページにリダイレクトさせる
        return redirect()->route('user.mypage');
    }

}
