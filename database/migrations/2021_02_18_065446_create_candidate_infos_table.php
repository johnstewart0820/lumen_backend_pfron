<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_infos', function (Blueprint $table) {
            $table->id();
            $table->string('id_candidate')->nullable(true)->index();
            $table->string('gender')->nullable(true)->index();
            $table->string('doctor')->nullable(true)->index();
            $table->string('psycology')->nullable(true)->index();
            $table->string('admission')->nullable(true)->index();
            $table->string('doctor_recommendation')->nullable(true)->index();
            $table->date('doctor_date')->nullable(true)->index();
            $table->string('doctor_remark')->nullable(true)->index();
            $table->string('psycology_recommendation')->nullable(true)->index();
            $table->date('psycology_date')->nullable(true)->index();
            $table->string('psycology_remark')->nullable(true)->index();
            $table->string('decision_central_commision')->nullable(true)->index();
            $table->date('date_central_commision')->nullable(true)->index();
            $table->string('general_remark')->nullable(true)->index();
            $table->date('date_referal')->nullable(true)->index();
            $table->string('rehabitation_center')->nullable(true)->index();
            $table->string('participant_number')->nullable(true)->index();
            $table->date('date_rehabitation_center')->nullable(true)->index();
            $table->string('type_to_stay')->nullable(true)->index();
            $table->string('participant_remark')->nullable(true)->index();
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
        Schema::dropIfExists('candidate_infos');
    }
}
