<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Athlete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * マイページ表示
     *
     * @param  \Illuminate\Database\Eloquent\Collection $athletes
     * @return \Illuminate\View\View
     */
    public function userMyPage(Request $request)
    {
        //登録済みの全選手を取得する。ページネーションで６個ずつ表示する。
        $athletes = Athlete::select('id','name','team','event','event_detail')->paginate(6);

        //選手検索フォームで検索された際の検索処理
        //検索フォームでの入力された値を取得
        $search = $request->search;
        //入力値をもとに登録済み選手の中から、入力条件に合う選手を検索する
        //Athleteモデルで設定されているローカルスコープ(選手の部分一致検索)を使用する。(プレフィックスのscopeはつけない)
        $query = Athlete::searchAthlete($search);

        //$queryにwhere句のクエリビルダーが入っているので、そこにselect句でマイページで表示する選手情報とページネーションを追加する。
        $athletes = $query->select('id', 'name', 'team', 'event', 'event_detail')->paginate(6);

        return view('user.mypage', compact('athletes'));
    }
}
