<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_attribute', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('particular_field')->nullable();
            $table->text('career')->nullable();
            $table->foreignId('doctor_id')
                ->constrained()
                ->onDelete('cascade');
            //ドクターID(doctorsテーブルのIDとリレーションをはり、外部キー制約も設定)
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
        Schema::dropIfExists('doctor_attribute');
    }
}
