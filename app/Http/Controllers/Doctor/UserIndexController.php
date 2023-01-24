<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserIndexController extends Controller
{
    //ユーザー一覧表示
    public function index(Request $request)
    {
        //登録済みの全トレーナーを詳細情報と一緒に取得する
        $users = User::with('userAttribute')->paginate(2);

        if(!empty($request))
        {
            //トレーナー検索フォームで検索された際の検索処理
            //検索フォームでの入力された値を取得
            $search = $request->search;
            //入力値をもとに登録済みトレーナーの中から、入力条件に合うトレーナーを検索する
            //Userモデルで設定されているローカルスコープ(トレーナーの部分一致検索)を使用する。(プレフィックスのscopeはつけない)
            $query = User::searchUser($search);

            //$queryにwhere句のクエリビルダーが入っているので、そこにselect句でマイページで表示するトレーナー情報とページネーションを追加する。
            $users = $query->with('userAttribute')->select('id', 'name', 'email')->paginate(2);
        }

        //トレーナー一覧表示画面にリダイレクトする
        return view('user.index', compact('users'));
    }
}
