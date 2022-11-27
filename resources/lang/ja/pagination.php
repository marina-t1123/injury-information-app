このページの内容を含め、auth.php、passwords.php、pagination.php,validation.phpの４日本語ファイルをまとめて生成するには、以下のコマンドをプロジェクトのルートディレクトリで実行してください。（Windows環境ではまだ試していません。）

php -r "copy('https://readouble.com/laravel/8.x/ja/install-ja-lang-files.php', 'install-ja-lang.php');"
php -f install-ja-lang.php
php -r "unlink('install-ja-lang.php');"
以下が言語ファイルの内容です。

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ペジネーション言語行
    |--------------------------------------------------------------------------
    |
    | 以下の言語行はペジネーターライブラリーによりシンプルなペジネーション
    | リンクを生成するために使用されます。アプリケーションに合うように、
    | 自由に変更してください。
    |
    */

    'previous' => '&laquo; 前',
    'next' => '次 &raquo;',

];
