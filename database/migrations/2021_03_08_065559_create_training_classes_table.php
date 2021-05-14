<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_training')->index();
            $table->string('name')->index();
            $table->dateTime('date')->index();
            $table->string('start_hour')->index();
            $table->string('end_hour')->index();
            $table->string('break_amount')->index();
            $table->string('total_hour')->index();
            $table->string('ork_team')->index();
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
        Schema::dropIfExists('training_classes');
    }
}
