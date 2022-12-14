<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalHistoryRequest;
use App\Models\Athlete;
use App\Models\MedicalHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MedicalHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     * 既往歴新規作成ページの表示
     *
     *
     */
    public function index()
    {
        //登録済みの既往歴を選手情報と一緒に取得
        $medicalHistories = MedicalHistory::with('athlete')->get();

        return view('medical-history.index', compact('medicalHistories'));
    }

    /**
     * 既往歴メニューページの表示
     *
     *
     */
    public function showMedicalHistoryPage($athlete_id)
    {
        //既往歴を表示する選手を取得
        $athlete = Athlete::findOrFail($athlete_id);
        //選手情報に紐ずく既往歴を取得する
        $medicalHistories = Athlete::findOrFail($athlete_id)
            ->MedicalHistories()
            ->paginate(4);

        // //既往歴検索フォームでの検索処理
        // //検索フォームで入力された値を取得
        // $search = $request->search;

        // //入力値をもとに、検索条件に合う既往歴を取得する
        // //MedicalHistoryモデルで設定されているローカルスコープ(既往歴の部分一致検索)を使用する。(プレフィックスのscopeはつけない)
        // $query = MedicalHistory::searchMedicalHistory($search);

        // //$queryにwhere句のクエリビルダーが入っているので、そこにselect句で表示する既往歴情報とページネーションを渡す。
        // $medicalHistories = $query->select('id', 'injured_day', 'injured_area')->paginate(4);

        //既往歴メニューページに遷移する
        return view('medical-history.medical-history-menu', compact('athlete', 'medicalHistories'));
    }

    /**
     * 既往歴ページでの検索機能
     *
     *
     */
    // public function searchMedicalHistory(Request $request)
    // {
    //     // 既往歴を表示する選手を取得
    //     $athlete = Athlete::findOrFail($request->athlete_id);
    //     // //選手情報に紐ずく既往歴を取得する
    //     // $medicalHistories = Athlete::findOrFail($request->athlete_id)
    //     //     ->MedicalHistories()
    //     //     ->paginate(4);

    //     //既往歴検索フォームでの検索処理
    //     //検索フォームで入力された値を取得
    //     $search = $request->search;

    //     //入力値をもとに、検索条件に合う既往歴を取得する
    //     //MedicalHistoryモデルで設定されているローカルスコープ(既往歴の部分一致検索)を使用する。(プレフィックスのscopeはつけない)
    //     $query = MedicalHistory::searchMedicalHistory($search);

    //     //$queryにwhere句のクエリビルダーが入っているので、そこにselect句で表示する既往歴情報とページネーションを渡す。
    //     $medicalHistories = $query->select('id', 'injured_day', 'injured_area')->paginate(4);

    //     //既往歴メニューページに遷移する
    //     return view('medical-history.medical-history-menu', compact('athlete', 'medicalHistories'));
    // }

    /**
     * 既往歴新規作成画面の表示
     *
     * @return \Illuminate\View\View
     */
    public function create($athlete_id){
        //既往歴を作成する選手を取得する。
        $athlete = Athlete::findOrFail($athlete_id);
        //新規作成画面へリダイレクトする
        return view('medical-history.create', compact('athlete'));
    }

    /**
     * 既往歴新規作成機能
     *
     * @param \App\Http\Requests\MedicalHistoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MedicalHistoryRequest $request, $athlete_id)
    {
        //登録する選手を取得する
        $athlete = Athlete::findOrFail($athlete_id);

        //既往歴を作成する。
        MedicalHistory::create([
            'injured_day' => $request->injured_day,
            'injured_area' => $request->injured_area,
            'injury_status' => $request->injury_status,
            'first_aid' => $request->first_aid,
            'hospital_visit' => $request->hospital_visit,
            'diagnosis' => $request->diagnosis,
            'current_situation' => $request->current_situation,
            'athlete_id' => $request->athlete_id,
        ]);

        //既往歴登録時のメッセージを表示するフラッシュメッセージ
        Session::flash('message', '既往歴を登録しました。');

        //既往歴メニューページに遷移する
        return redirect()->route('user.medical-history.show.menu', ['athlete_id' => $athlete->id]);
    }

    /**
     * 既往歴詳細ページ
     *
     *
     */
    public function show($medical_history_id)
    {
        //パラメータ(既往歴ID)をもつ既往歴の情報とその既往歴に紐付く選手情報を取得する。
        $medicalHistory = MedicalHistory::find($medical_history_id)->with('athlete')->first();

        //既往歴詳細ページで表示する既往歴を既往歴詳細ページに渡して、リダイレクトする
        return view('medical-history.show', compact('medicalHistory'));
    }

    /**
     * 既往歴編集画面の表示
     *
     * @return \Illuminate\View\View
     */
    public function edit($medical_history_id)
    {
        //編集する既往歴ページを取得
        $medicalHistory = MedicalHistory::find($medical_history_id)->with('athlete')->first();;

        //編集ページへリダイレクト
        return view('medical-history.edit', compact('medicalHistory'));
    }

    /**
     * 既往歴編集機能
     *
     * @param \App\Http\Requests\MedicalHistoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MedicalHistoryRequest $request, $medical_history_id)
    {
        //編集する既往歴を取得する
        $medicalHistory = MedicalHistory::findOrFail($medical_history_id)
            ->with('athlete')
            ->first();

        //バリデーション済みのフォーム入力値を取得して、各項目の編集内容を設定する。
        $medicalHistory->injured_day = $request->injured_day;
        $medicalHistory->injured_area = $request->injured_area;
        $medicalHistory->injury_status = $request->injury_status;
        $medicalHistory->first_aid = $request->first_aid;
        $medicalHistory->hospital_visit = $request->hospital_visit;
        $medicalHistory->diagnosis = $request->diagnosis;
        $medicalHistory->current_situation = $request->current_situation;

        //更新内容を登録する
        $medicalHistory->save();

        //更新成功した際にメッセージを設定
        Session::flash('message', '既往歴情報を編集しました。');

        //既往歴メニューページにリダイレクト
        return redirect()->route('user.medical-history.show.menu', ['athlete_id' => $medicalHistory->athlete->id] );
    }

    /**
     * 既往歴削除機能
     *
     *
     */
    public function destroy($medical_history_id)
    {
        //削除する既往歴を取得
        $medicalHistory = MedicalHistory::findOrFail($medical_history_id);

        //選手IDを取得
        $athlete_id = MedicalHistory::findOrFail($medical_history_id)
            ->value('athlete_id');

        //既往歴を削除する
        $medicalHistory->delete();

        //既往歴削除成功時に表示するフラッシュメッセージ
        Session::flash('message', '既往歴を削除しました。');

        //既往歴メニューにリダイレクトする
        return redirect()->route('user.medical-history.show.menu', compact('athlete_id'));
    }
}
