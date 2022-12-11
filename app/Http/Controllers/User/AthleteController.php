<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AthleteRequest;
use Illuminate\Http\Request;
use App\Models\Athlete;
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
        $athlete = Athlete::findOrFail($athlete_id);

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
        $athlete = Athlete::findOrFail($athlete_id);

        return view('athlete.edit', compact('athlete'));
    }

    /**
     * 選手編集
     *
     * @param  \App\Http\Requests\AthleteRequest  $request
     * @return \Illuminate\View\View
     */
    public function update(AthleteRequest $request, $athlete_id)
    //引数では「メソッドインジェクション」という、フォームで入力された値がRequestインスタンスになって、そのクラスをインスタンス化して$requestに格納する。
    {
        //まず、編集する選手を取得する。
        $athlete = Athlete::findOrFail($athlete_id);

        //バリデーション済みのフォーム入力値を取得して、各項目に格納する。
        $athlete->email = $request->email;
        $athlete->name = $request->name;
        $athlete->team = $request->team;
        $athlete->phone_number = $request->phone_number;
        $athlete->event_detail = $request->event_detail;
        $athlete->event = $request->event;
        $athlete->career = $request->career;

        //フォームの入力値を保存する。
        $athlete->save();

        //選手登録成功時に表示するフラッシュメッセージ
        Session::flash('message', '選手情報を変更しました。');

        //選手設定画面にリダイレクト
        return view('athlete.setting-page', compact('athlete'));
    }

    /**
     * 選手削除
     *
     * @param  \App\Http\Requests\AthleteRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($athlete_id)
    //引数では「メソッドインジェクション」という、フォームで入力された値がRequestインスタンスになって、そのクラスをインスタンス化して$requestに格納する。
    {
        //まず、削除する選手を取得する。
        $athlete = Athlete::findOrFail($athlete_id);

        //選手に紐ずく既往歴・問診票・カルテを削除。最後に選手アカウントを削除する。

        //選手アカウントを削除
        $athlete->delete();

        //選手登録成功時に表示するフラッシュメッセージ
        Session::flash('message', '選手情報と選手に紐ずく既往歴・問診票・カルテを削除しました。');

        //トレーナーのマイページにリダイレクトさせる
        return redirect()->route('user.mypage');
    }

}
