<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAthleteRequest;
use App\Models\Athlete;

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
    public function showSettingPage($id)
    {

        return view('athlete.setting-page');
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
     * @param  \App\Http\Requests\StoreAthleteRequest  $request
     * @return \Illuminate\View\View
     */
    public function store(StoreAthleteRequest $request)
    //引数では「メソッドインジェクション」という、フォームで入力された値がStoreAthleteRequestクラスになって、そのクラスをインスタンス化して$requestに格納する。
    {
        //バリデーション済みのデータを取得する。
        $validated = $request->validated();

        //バリデーションがOKの場合、新しく選手を作成。
        Athlete::created([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        //登録済みの全選手を取得する。
        $athletes = Athlete::get();

        //トレーナーのマイページに遷移する。
        return view('user.mypage', compact(['athletes']));
    }
}
