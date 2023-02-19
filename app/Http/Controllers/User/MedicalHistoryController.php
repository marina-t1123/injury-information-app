<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalHistoryRequest;
use App\Models\Athlete;
use App\Models\MedicalHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MedicalHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     * 既往歴メニューページの表示
     *
     * @param int $athlete_id
     * @return \Illuminate\View\View
     */
    public function showMedicalHistoryPage($athlete_id)
    {
        //既往歴を表示する選手を取得
        $athlete = Athlete::getAthlete($athlete_id);
        //選手情報に紐ずく既往歴を取得する
        $medicalHistories = Athlete::getAthleteAndMedicalHistory($athlete_id)->paginate(2);

        //既往歴メニューページに遷移する
        return view('medical-history.medical-history-menu', compact('athlete', 'medicalHistories'));
    }

    /**
     * 既往歴新規作成画面の表示
     *
     * @param int $athlete_id
     * @return \Illuminate\View\View
     */
    public function create($athlete_id){
        //既往歴を作成する選手を取得する。
        $athlete = Athlete::getAthlete($athlete_id);
        //新規作成画面へリダイレクトする
        return view('medical-history.create', compact('athlete'));
    }

    /**
     * 既往歴新規作成機能
     *
     * @param \App\Http\Requests\MedicalHistoryRequest $request
     * @param int $athlete_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MedicalHistoryRequest $request, $athlete_id)
    {
        //登録する選手を取得する
        $athlete = Athlete::getAthlete($athlete_id);

        //既往歴を作成する。
        MedicalHistory::create([
            'injured_day' => $request->injured_day,
            'injured_area' => $request->injured_area,
            'injury_status' => $request->injury_status,
            'first_aid' => $request->first_aid,
            'hospital_visit' => $request->hospital_visit,
            'diagnosis' => $request->diagnosis,
            'current_situation' => $request->current_situation,
            'athlete_id' => $athlete_id,
        ]);

        //既往歴登録時のメッセージを表示するフラッシュメッセージ
        Session::flash('message', '既往歴を登録しました。');

        //既往歴メニューページに遷移する
        return redirect()->route('user.medical-history.show.menu', ['athlete_id' => $athlete->id]);
    }

    /**
     * 既往歴詳細ページ
     *
     * @param int $medical_history_id
     * @return @var \Illuminate\View\View
     */
    public function show($medical_history_id)
    {
        //パラメータ(既往歴ID)をもつ既往歴の情報とその既往歴に紐付く選手情報を取得する。
        $medicalHistory = MedicalHistory::getMedicalHistoryAndAthleteData($medical_history_id);

        //既往歴詳細ページで表示する既往歴を既往歴詳細ページに渡して、リダイレクトする
        return view('medical-history.show', compact('medicalHistory'));
    }

    /**
     * 既往歴編集画面の表示
     *
     * @param int $medical_history_id
     * @return \Illuminate\View\View
     */
    public function edit($medical_history_id)
    {
        //編集する既往歴ページを取得
        $medicalHistory = MedicalHistory::getMedicalHistoryAndAthleteData($medical_history_id);

        //編集ページへリダイレクト
        return view('medical-history.edit', compact('medicalHistory'));
    }

    /**
     * 既往歴編集機能
     *
     * @param \App\Http\Requests\MedicalHistoryRequest $request
     * @param int $medical_history_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MedicalHistoryRequest $request, $medical_history_id)
    {
        //編集する既往歴を取得する
        $targetMedicalHistory = MedicalHistory::getMedicalHistoryAndAthleteData($medical_history_id);

        //既往歴を更新する
        if(!empty($request))
        {
            DB::beginTransaction();
            try {
                //編集する詳細データを設定
                $medicalHistoryData = [
                    'injured_day' => $request->injured_day,
                    'injured_area' => $request->injured_area,
                    'injury_status' => $request->injury_status,
                    'first_aid' => $request->first_aid,
                    'hospital_visit' => $request->hospital_visit,
                    'diagnosis' => $request->diagnosis,
                    'current_situation' => $request->current_situation,
                ];
                //詳細データを更新する
                $targetMedicalHistory->update($medicalHistoryData);
                DB::commit();
            } catch (\Throwable $e) {
                // 全てのエラー・例外をキャッチしてログに残す
                Log::error($e);
                //フロントにエラーを通知するので、例外を投げる
                throw $e;
                DB::rollBack();
            }
        }

        //更新成功した際にメッセージを設定
        Session::flash('message', '既往歴情報を編集しました。');

        //既往歴メニューページにリダイレクト
        return redirect()->route('user.medical-history.show.menu', ['athlete_id' => $targetMedicalHistory->athlete->id] );
    }

    /**
     * 既往歴削除機能
     *
     * @param int $medical_history_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($medical_history_id)
    {
        //選手IDを取得
        $athlete_id = MedicalHistory::getMedicalHistory($medical_history_id)->athlete_id;

        //既往歴を削除する
        DB::beginTransaction();
        try {
            //削除する既往歴を取得
            $medicalHistory = MedicalHistory::getMedicalHistory($medical_history_id);
            //既往歴を削除する
            $medicalHistory->delete();
            DB::commit();
        } catch (\Throwable $e) {
            // 全てのエラー・例外をキャッチしてログに残す
            Log::error($e);
            //フロントにエラーを通知するので、例外を投げる
            throw $e;
            DB::rollBack();
        }

        //既往歴削除成功時に表示するフラッシュメッセージ
        Session::flash('message', '既往歴を削除しました。');

        //既往歴メニューにリダイレクトする
        return redirect()->route('user.medical-history.show.menu', compact('athlete_id'));
    }
}
