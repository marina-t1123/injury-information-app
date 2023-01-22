<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attribute', function (Blueprint $table) {
            $table->id();
            $table->string('team')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('career')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            //ユーザーID(usersテーブルのIDとリレーションをはり、外部キー制約も設定)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_attribute');

    }
}
