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
            $table->string('id_candidate')->nullable(true);
            $table->string('gender')->nullable(true);
            $table->string('doctor')->nullable(true);
            $table->string('psycology')->nullable(true);
            $table->string('admission')->nullable(true);
            $table->string('doctor_recommendation')->nullable(true);
            $table->date('doctor_date')->nullable(true);
            $table->string('doctor_remark')->nullable(true);
            $table->string('psycology_recommendation')->nullable(true);
            $table->date('psycology_date')->nullable(true);
            $table->string('psycology_remark')->nullable(true);
            $table->string('decision_central_commision')->nullable(true);
            $table->date('date_central_commision')->nullable(true);
            $table->string('general_remark')->nullable(true);
            $table->date('date_referal')->nullable(true);
            $table->string('rehabitation_center')->nullable(true);
            $table->string('participant_number')->nullable(true);
            $table->date('date_rehabitation_center')->nullable(true);
            $table->string('type_to_stay')->nullable(true);
            $table->string('participant_remark')->nullable(true);
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
