<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_questionnaires', function (Blueprint $table) {
            $table->id();
            $table->date('injured_day');
            $table->string('injured_area');
            $table->string('injury_status');
            $table->string('claim');
            $table->boolean('pain');
            $table->boolean('swelling');
            $table->string('first_aid');
            $table->string('orthopedic_test')->nullable();
            $table->string('muscle_strength_test')->nullable();
            $table->string('trainer_findings');
            $table->string('future_plans');
            $table->string('injury_image1')->nullable();
            $table->string('injury_image2')->nullable();
            $table->string('injury_image3')->nullable();
            $table->foreignId('athlete_id')
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
        Schema::dropIfExists('medical_questionnaires');
    }
}
