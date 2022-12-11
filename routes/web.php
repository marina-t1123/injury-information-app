<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AthleteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| ここでは、アプリケーションのWebルートを登録することができます。
| これらのルートは、RouteServiceProviderによって、"web "ミドルウェアグループを含むグループ内で読み込まれます。
|
*/

Route::get('/', function () {
    return view('user.welcome');
});

//ログイン後の遷移先(マイページ)
Route::get('/mypage', [UserController::class, 'userMyPage'])
    ->middleware(['auth:users'])->name('mypage');

//選手のルーティングにトレーナーユーザーの認証を設定
Route::prefix('athlete') //URLのプレフィックスとして「/athlete」
    ->middleware(['auth:users']) //トレーナーの認証(ルート名の先頭にuser.がつく)
    ->group(function (){ //上記の条件を適応させて、選手関連のルート情報をグループ化
        // 選手設定ページ表示
        Route::get('/{athlete_id}/setting', [AthleteController::class, 'showSettingPage'])
        ->name('athlete.show.setting');

        // 選手新規作成画面表示
        Route::get('/create', [AthleteController::class, 'create'])
        ->name('athlete.create');

        // 選手新規作成
        Route::post('/create', [AthleteController::class, 'store'])
        ->name('athlete.store');

        // 選手編集画面表示
        Route::get('/{athlete_id}/edit',  [AthleteController::class, 'edit'])
        ->name('athlete.edit');

        // 選手編集
        Route::post('/{athlete_id}/edit',  [AthleteController::class, 'update'])
        ->name('athlete.update');

        // 選手削除
        Route::post('/{athlete_id}/destroy', [AthleteController::class, 'destroy'])
        ->name('athlete.destroy');
});


require __DIR__.'/auth.php';
