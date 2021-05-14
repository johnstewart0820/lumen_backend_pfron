<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iprs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_candidate')->index();
            $table->integer('ipr_type')->index();
            $table->integer('number')->index();
            $table->integer('id_ork_person')->index();
            $table->string('profession')->index();
            $table->date('schedule_date')->index();
            $table->string('balance_remark')->nullable(true)->index();
            $table->boolean('status')->index();
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
        Schema::dropIfExists('iprs');
    }
}
