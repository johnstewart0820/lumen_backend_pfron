<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrkTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ork_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('rehabitation_center')->index();
            $table->string('specialization')->index();
            $table->boolean('is_accepted')->index();
            $table->date('date_of_acceptance')->index();
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
        Schema::dropIfExists('ork_teams');
    }
}
