<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Athlete;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * マイページ表示
     *
     * @param  \Illuminate\Database\Eloquent\Collection $athletes
     * @return \Illuminate\View\View
     */
    public function userMyPage(){
        //登録済みの全選手を取得する。
        $athletes = Athlete::all();

        return view('user.mypage', compact('athletes'));
    }
}
