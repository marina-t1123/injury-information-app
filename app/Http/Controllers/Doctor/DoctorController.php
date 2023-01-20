<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\MedicalQuestionnaire;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DoctorController extends Controller
{
    /**
     * マイページ表示
     *
     * @param \Illuminate\Database\Eloquent\Collection||null $athletes
     * @param \Illuminate\Database\Eloquent\Collection||null $todayMedicalQuestionnaires
     * @param Carbon\Carbon $today
     * @return void
     */
    public function doctorMyPage(Request $request)
    {
        //登録済みの全選手を取得する。ページネーションで６個ずつ表示する
        $athletes = Athlete::select('id', 'name', 'team', 'event', 'event_detail')->paginate(6);

        //受診日が今日の問診票を選手情報と一緒に取得
        $todayMedicalQuestionnaires = MedicalQuestionnaire::getTodayMedicalQuestionnaires();

        //今日の日付を取得
        $today = Carbon::today()->format('Y年n月j日');

        if(!empty($request))
        {
            //選手検索フォームで検索された際の検索処理
            //検索フォームでの入力された値を取得
            $search = $request->search;

            //入力値をもとに登録済みの選手の中から、入力条件に合う選手を検索する
            //Athleteモデルで登録されているローカルスコープ(選手の部分一致検索)を使用する。(プレフィックスのscopeはつけない)
            $query = Athlete::searchAthlete($search);

            //$queryにwhere句のクエリビルダーが入っているので、そこにselect句でマイページで表示する選手情報とページネーションを追加する。
            $athletes = $query->select('id', 'name', 'team', 'event', 'event_detail')->paginate(6);
        }

        //マイページに遷移する(選手検索があった場合は検索結果を渡す)
        return view('doctor.mypage', compact('athletes', 'todayMedicalQuestionnaires', 'today'));
    }
}
