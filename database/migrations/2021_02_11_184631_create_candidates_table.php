<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('person_id');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('street');
            $table->string('house_number');
            $table->string('apartment_number');
            $table->string('post_code');
            $table->string('post_office');
            $table->string('city');
            $table->string('stage');
            $table->string('comment');
            $table->string('qualification_point')->nullable(true);
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
        Schema::dropIfExists('candidates');
    }
}
