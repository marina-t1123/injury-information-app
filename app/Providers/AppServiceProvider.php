<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * 任意のアプリケーションサービスを登録します。
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     * あらゆるアプリケーションサービスをブートストラップします。
     *
     * @return void
     */
    public function boot()
    {
        //URLによってどのCookieを使うか判定をかける
        // doctorから始まるURLで使用する場合
        if(request()->is('doctor*')){ //もし、doctorから始まるURLの場合
            config(['session.cookie' => config('session.cookie_doctor')]);
            //doctorのcookieを使用する
            //configのヘルパ関数を使用して、config>session.phpのcookie_doctor(key名)のvalue(doctorのcookie名)を指定している。
        }
    }
}
