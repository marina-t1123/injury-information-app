<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorIndexController extends Controller
{
    //ユーザー一覧表示
    public function index(Request $request)
    {
        //登録済みの全トレーナーを詳細情報と一緒に取得する
        $doctors = Doctor::with('doctorAttribute')->paginate(2);

        if(!empty($request))
        {
            //トレーナー検索フォームで検索された際の検索処理
            //検索フォームでの入力された値を取得
            $search = $request->search;
            //入力値をもとに登録済みトレーナーの中から、入力条件に合うトレーナーを検索する
            //doctorモデルで設定されているローカルスコープ(トレーナーの部分一致検索)を使用する。(プレフィックスのscopeはつけない)
            $query = Doctor::searchDoctor($search);

            //$queryにwhere句のクエリビルダーが入っているので、そこにselect句でマイページで表示するトレーナー情報とページネーションを追加する。
            $doctors = $query->with('doctorAttribute')->select('id', 'name', 'email')->paginate(2);
        }

        //トレーナー一覧表示画面にリダイレクトする
        return view('doctor.index', compact('doctors'));
    }
}
