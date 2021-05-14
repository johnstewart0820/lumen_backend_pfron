<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIprSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipr_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ipr')->index();
            $table->integer('id_service')->index();
            $table->integer('status')->index();
            $table->date('date')->index();
            $table->string('start_time')->index();
            $table->string('end_time')->index();
            $table->string('break_time')->index();
            $table->string('total_time')->index();
            $table->string('total_amount')->index();
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
        Schema::dropIfExists('ipr_schedules');
    }
}
