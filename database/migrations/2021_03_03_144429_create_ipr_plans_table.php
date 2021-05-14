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
            $table->integer('id_ipr')->index();
            $table->integer('id_service')->index();
            $table->float('amount')->nullable(true)->index();
            $table->date('start_date')->nullable(true)->index();
            $table->string('room_number')->nullable(true)->index();
            $table->integer('id_ork_person')->nullable(true)->index();
            $table->string('remarks')->nullable(true)->index();
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
