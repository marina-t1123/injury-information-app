<?php

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

Route::get('/', function () {
    return view('user.welcome');
});

//ログイン後の遷移先(マイページ)
Route::get('/mypage', function () {
    return view('user.mypage');
})->middleware(['auth:users'])->name('mypage');

require __DIR__.'/auth.php';
