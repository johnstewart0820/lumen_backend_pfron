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
            $table->integer('id_training');
            $table->string('name');
            $table->dateTime('date');
            $table->string('start_hour');
            $table->string('end_hour');
            $table->string('break_amount');
            $table->string('total_hour');
            $table->string('ork_team');
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
