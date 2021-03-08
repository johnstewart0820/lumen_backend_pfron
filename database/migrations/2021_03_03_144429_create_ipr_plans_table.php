<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIprPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipr_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ipr');
            $table->integer('id_service');
            $table->integer('amount')->nullable(true);
            $table->dateTime('start_date')->nullable(true);
            $table->string('room_number')->nullable(true);
            $table->integer('id_ork_person')->nullable(true);
            $table->string('remarks')->nullable(true);
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
        Schema::dropIfExists('ipr_plans');
    }
}
