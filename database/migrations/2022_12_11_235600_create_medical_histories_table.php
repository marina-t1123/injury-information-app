<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->date('injured_day'); //受傷日
            $table->string('injured_area'); //受傷部位
            $table->text('injury_status'); //受傷状況
            $table->text('first_aid'); //応急処置
            $table->boolean('hospital_visit'); //病院受診
            $table->string('diagnosis')->nullable(); //診断名
            $table->text('current_situation'); //現在の状態
            $table->foreignId('athlete_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            //選手ID(athletesテーブルのIDとリレーションをはり、外部キー制約も設定)
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
        Schema::dropIfExists('medical_histories');
    }
}
