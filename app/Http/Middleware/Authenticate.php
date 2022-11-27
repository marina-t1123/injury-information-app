<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected $user_route = 'user.login';
    protected $doctor_route = 'doctor.login';
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     * 各ユーザーが未認証(ログインしていない)の場合のリダイレクト処理を設定している
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Route::is('doctor.*')){
                return route($this->doctor_route);
            } else {
                return route($this->user_route);
            }

        }
    }
}
