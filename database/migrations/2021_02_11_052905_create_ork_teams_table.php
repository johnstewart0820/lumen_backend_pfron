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
            $table->string('name');
            $table->string('rehabitation_center');
            $table->string('specialization');
            $table->boolean('is_accepted');
            $table->date('date_of_acceptance');
            $table->boolean('status');
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
