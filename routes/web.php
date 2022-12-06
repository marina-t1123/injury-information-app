<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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

require __DIR__.'/auth.php';
