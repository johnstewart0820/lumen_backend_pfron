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
            $table->integer('id_ipr');
            $table->integer('id_service');
            $table->integer('status');
            $table->date('date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('break_time');
            $table->string('total_time');
            $table->string('total_amount');
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
