<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AthleteController;
use App\Http\Controllers\User\MedicalHistoryController;
use App\Http\Controllers\User\MedicalQuestionnaireController;
use App\Http\Controllers\User\MedicalRecordController;
use App\Http\Controllers\User\UserAttributeController;
use App\Http\Controllers\User\DoctorIndexController;

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

//TOPページ
Route::get('/injury-information', function () {
    return view('top-page');
});

/**
 * トレーナー側のルーティング
 */

//マイページ
Route::get('/mypage', [UserController::class, 'userMyPage'])
    ->middleware(['auth:users'])->name('mypage');

//トレーナー詳細ルーティング
Route::prefix('trainer-attribute')
    ->middleware(['auth:users'])
    ->group(function (){
        //トレーナー詳細メニューページ表示
        Route::get('/{id}/setting', [UserAttributeController::class, 'showUserAttributeMenu'])
            ->name('user-attribute.menu');
        //トレーナー詳細作成ページ表示
        Route::get('/{id}/create', [UserAttributeController::class, 'create'])
        ->name('user-attribute.create');
        //トレーナー詳細作成
        Route::post('/{id}/create', [UserAttributeController::class, 'store'])
        ->name('user-attribute.store');
        //トレーナー詳細編集ページ表示
        Route::get('/{id}/edit', [UserAttributeController::class, 'edit'])
            ->name('user-attribute.edit');
        //トレーナー詳細編集
        Route::post('/{id}/edit', [UserAttributeController::class, 'update'])
            ->name('user-attribute.update');
});

//ドクター一覧
Route::get('/user/doctor-index', [DoctorIndexController::class, 'index'])
    ->middleware(['auth:users'])->name('doctor-index');

//選手ルーティング
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

//既往歴ルーティング
Route::prefix('medical-history') //URLのプレフィックスとして「/athlete」
    ->middleware(['auth:users']) //トレーナーの認証(ルート名の先頭にuser.がつく)
    ->group(function (){ //上記の条件を適応させて、選手関連のルート情報をグループ化
        // 既往歴メニューページ表示
        Route::get('/{athlete_id}', [MedicalHistoryController::class, 'showMedicalHistoryPage'])
            ->name('medical-history.show.menu');

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
    }
);

//問診票のルーティング
Route::prefix('medical-questionnaire')
    ->middleware(['auth:users'])
    ->group(function (){
        //問診票メニューページ表示
        Route::get('/{athlete_id}', [MedicalQuestionnaireController::class, 'showMedicalQuestionnairePage'])
            ->name('medical-questionnaire.show.menu');

        //問診票一覧ページ表示
        Route::get('/index', [MedicalQuestionnaireController::class, 'index'])
            ->name('medical-questionnaire.index');

        //問診票新規作成画面表示
        Route::get('/{athlete_id}/create', [MedicalQuestionnaireController::class, 'create'])
            ->name('medical-questionnaire.create');

        //問診票新規作成
        Route::post('/{athlete_id}/create', [MedicalQuestionnaireController::class, 'store'])
            ->name('medical-questionnaire.store');

        //問診票詳細ページ
        Route::get('/{medical_questionnaire_id}/show', [MedicalQuestionnaireController::class, 'show'])
            ->name('medical-questionnaire.show');

        //問診票編集画面表示
        Route::get('/{medical_questionnaire_id}/edit', [MedicalQuestionnaireController::class, 'edit'])
            ->name('medical-questionnaire.edit');

        //問診票編集
        Route::post('/{medical_questionnaire_id}/edit', [MedicalQuestionnaireController::class, 'update'])
            ->name('medical-questionnaire.update');

        //問診票削除
        Route::post('/{medical_questionnaire_id}/destroy', [MedicalQuestionnaireController::class, 'destroy'])
            ->name('medical-questionnaire.destroy');
    }
);

//カルテのルーティング
Route::prefix('medical-record')
    ->middleware(['auth:users'])
    ->group(function (){
        //カルテの詳細ページの表示
        Route::get('/{medical_questionnaire_id}/show', [MedicalRecordController::class, 'show'])
            ->name('medical-record.show');
    }
);


require __DIR__.'/auth.php';
