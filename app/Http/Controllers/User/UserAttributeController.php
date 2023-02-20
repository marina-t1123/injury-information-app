<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAttribute;
use App\Http\Requests\UserAttributeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserAttributeController extends Controller
{
    /**
     * トレーナー詳細設定画面表示
     *
     * @param int $id
     * @return Illuminate\View\View
     */
    public function showUserAttributeMenu($id)
    {
        //トレーナーの詳細情報を取得する
        $user = user::getUserAndAttribute($id);

        //トレーナー詳細設定画面にリダイレクト
        return view('user-attribute.user-attribute-menu', compact('user'));
    }

    public function create($id)
    {
        //トレーナー詳細を作成するトレーナーを取得する
        $user = user::getUser($id);

        //トレーナー詳細編集ページにリダイレクトする
        return view('user-attribute.create', compact('user'));
    }

    public function store(UserAttributeRequest $request, $id)
    {

        //トレーナーの名前を登録する。
        User::registerUserName($id, $request->name);

        //トレーナー編集情報を新規作成する
        UserAttribute::create([
            'hospital_name' => $request->hospital_name,
            'phone_number' => $request->phone_number,
            'particular_field' => $request->particular_field,
            'career' => $request->career,
            'user_id' => $id
        ]);

        //トレーナーと作成したトレーナー詳細を取得
        $user = user::getUserAndAttribute($id);

        //トレーナー詳細登録成功時に表示するフラッシュメッセージ
        Session::flash('message', 'トレーナー詳細情報を登録しました。');

        //トレーナー詳細編集ページにリダイレクトする
        return view('user-attribute.user-attribute-menu', compact('user'));
    }

    public function edit($id)
    {
        //トレーナーの詳細情報を取得する
        $user = User::getUserAndAttribute($id);

        //トレーナー詳細編集ページにリダイレクトする
        return view('user-attribute.edit', compact('user'));
    }

    public function update(UserAttributeRequest $request, $id)
    {
        //編集するトレーナー詳細を取得する
        $targetUser = User::getUser($id);

        //トレーナーの名前が編集前と違った場合、更新する
        if( $targetUser->name !== $request->name)
        {
            //編集後の名前を登録する
            User::registerUserName($id, $request->name);
        }

        //トレーナー詳細情報を更新する
        if( !empty($request))
        {
            DB::beginTransaction();
            try {
                //編集する詳細データを設定
                $userAttribute = [
                    'team' => $request->team,
                    'phone_number' => $request->phone_number,
                    'career' => $request->career,
                ];
                //詳細データを更新する
                $targetUser->userAttribute()->update($userAttribute);
                DB::commit();
            } catch (\Throwable $e) {
                // 全てのエラー・例外をキャッチしてログに残す
                Log::error($e);
                //フロントにエラーを通知するので、例外を投げる
                throw $e;
                DB::rollBack();
            }
        }

        //トレーナーと編集後のトレーナー詳細を取得する
        $user = user::getUserAndAttribute($id);

        //トレーナー詳細更新成功時に表示するフラッシュメッセージ
        Session::flash('message', 'トレーナー詳細情報を編集しました。');

        //詳細情報ページにリダイレクトする
        return view('user-attribute.user-attribute-menu', compact('user'));

    }
}
