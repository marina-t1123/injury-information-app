<?php

use App\Http\Controllers\Doctor\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Doctor\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Doctor\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Doctor\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Doctor\Auth\NewPasswordController;
use App\Http\Controllers\Doctor\Auth\PasswordResetLinkController;
use App\Http\Controllers\Doctor\Auth\RegisteredUserController;
use App\Http\Controllers\Doctor\Auth\VerifyEmailController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\DoctorMedicalHistoryController;
use App\Http\Controllers\Doctor\DoctorAthleteController;
use App\Http\Controllers\Doctor\DoctorMedicalRecordController;
use App\Http\Controllers\Doctor\DoctorMedicalQuestionnaireController;
use App\Http\Controllers\Doctor\UserIndexController;
use App\Http\Controllers\Doctor\DoctorAttributeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//TOPページ
Route::get('/injury-information', function () {
    return view('top-page');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth:doctors')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth:doctors', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth:doctors', 'throttle:6,1'])
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

/**
 * ドクター側のルーティング
 */

//マイページ
Route::get('/mypage', [DoctorController::class, 'doctorMyPage'])
    ->middleware(['auth:doctors'])->name('mypage');

//ドクター詳細ルーティング
Route::prefix('doctor-attribute')
    ->middleware(['auth:doctors'])
    ->group(function (){
        //ドクター詳細メニューページ表示
        Route::get('/{id}/setting', [DoctorAttributeController::class, 'showDoctorAttributeMenu'])
            ->name('doctor-attribute.menu');
        //ドクター詳細作成ページ表示
        Route::get('/{id}/create', [DoctorAttributeController::class, 'create'])
        ->name('doctor-attribute.create');
        //ドクター詳細作成
        Route::post('/{id}/create', [DoctorAttributeController::class, 'store'])
        ->name('doctor-attribute.store');
        //ドクター詳細編集ページ表示
        Route::get('/{id}/edit', [DoctorAttributeController::class, 'edit'])
            ->name('doctor-attribute.edit');
        //ドクター詳細編集
        Route::post('/{id}/edit', [DoctorAttributeController::class, 'update'])
            ->name('doctor-attribute.update');
});

//トレーナー一覧
Route::get('/user/index', [UserIndexController::class, 'index'])
    ->middleware(['auth:doctors'])->name('users.index');

//選手ルーティング
Route::get('/athlete/{athlete_id}/show', [DoctorAthleteController::class, 'show'])
    ->middleware(['auth:doctors'])
    ->name('athlete.show');

//既往歴ルーティング
Route::prefix('medical-history')
    ->middleware(['auth:doctors'])
    ->group(function (){
        //既往歴メニュー画面表示
        Route::get('/{athlete_id}', [DoctorMedicalHistoryController::class, 'showMedicalHistoryPage'])
            ->name('medical-history.show.menu');

        //既往歴詳細ページ
        Route::get('/{medical_history_id}/show', [DoctorMedicalHistoryController::class, 'show'])
            ->name('medical-history.show');
});

//問診票ルーティング
Route::prefix('medical-questionnaire')
    ->middleware(['auth:doctors'])
    ->group(function (){
        //問診票メニューページ表示
        Route::get('/{athlete_id}', [DoctorMedicalQuestionnaireController::class, 'showMedicalQuestionnairePage'])
            ->name('medical-questionnaire.show.menu');

        //問診票一覧ページ表示
        Route::get('/index', [DoctorMedicalQuestionnaireController::class, 'index'])
            ->name('medical-questionnaire.index');

        //問診票詳細ページ表示
        Route::get('/{medical_questionnaire_id}/show', [DoctorMedicalQuestionnaireController::class, 'show'])
            ->name('medical-questionnaire.show');
});

//カルテルーティング
Route::prefix('medical-record')
    ->middleware(['auth:doctors'])
    ->group(function (){
        //カルテ詳細・編集ページ表示
        Route::get('/{medical_questionnaire_id}/medical_record', [DoctorMedicalRecordController::class, 'showMedicalRecordPage'])
            ->name('medical-record.show.menu');

        //カルテ編集ページ表示
        Route::get('/{medical_record_id}/edit', [DoctorMedicalRecordController::class, 'edit'])
            ->name('medical-record.edit');

        //カルテ編集
        Route::post('/{medical_record_id}/edit', [DoctorMedicalRecordController::class, 'update'])
            ->name('medical-record.update');

        //カルテ詳細ページ表示
        Route::post('/{medical_questionnaire_id}/medical_record/show', [DoctorMedicalRecordController::class, 'show'])
            ->name('medical-record.show');

});
