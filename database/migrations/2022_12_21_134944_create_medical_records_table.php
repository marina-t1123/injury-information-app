<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->date('hospital_day')->nullable(); //診察日
            $table->string('attending_physician')->nullable(); //担当医
            $table->text('medical_examination')->nullable(); //診察内容
            $table->text('tests')->nullable(); //テスト内容
            $table->text('doctor_findings')->nullable(); //ドクター所見
            $table->string('swelling')->nullable(); //診断名
            $table->text('future_policies')->nullable(); //今後の方針
            $table->foreignId('medical_questionnaire_id') //問診票ID
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('medical_records');
    }
}
