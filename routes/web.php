<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AthleteController;
use App\Http\Controllers\User\MedicalHistoryController;

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

//既往歴のルーティング
Route::prefix('medical-history') //URLのプレフィックスとして「/athlete」
    ->middleware(['auth:users']) //トレーナーの認証(ルート名の先頭にuser.がつく)
    ->group(function (){ //上記の条件を適応させて、選手関連のルート情報をグループ化
        // 既往歴メニューページ表示
        Route::get('/athlete-id.{athlete_id}', [MedicalHistoryController::class, 'showMedicalHistoryPage'])
        ->name('medical-history.show.menu');

        // 既往歴一覧ページ表示
        Route::get('/index', [MedicalHistoryController::class, 'index'])
        ->name('medical-history.index');

        // 既往歴新規作成画面表示
        Route::get('/{athlete_id}/create', [MedicalHistoryController::class, 'create'])
        ->name('medical-history.create');

        // 既往歴新規作成
        Route::post('/{athlete_id}/create', [MedicalHistoryController::class, 'store'])
        ->name('medical-history.store');

        // 既往歴詳細ページ
        Route::get('/{medical_history_id}/show', [MedicalHistoryController::class, 'show'])
        ->name('medical-history.show');

        // 既往歴編集画面表示
        Route::get('/{medical_history_id}/edit',  [MedicalHistoryController::class, 'edit'])
        ->name('medical-history.edit');

        // 既往歴編集
        Route::post('/{medical_history_id}/edit',  [MedicalHistoryController::class, 'update'])
        ->name('medical-history.update');

        // 既往歴削除
        Route::post('/{medical_history_id}/destroy', [MedicalHistoryController::class, 'destroy'])
        ->name('medical-history.destroy');
});


require __DIR__.'/auth.php';
