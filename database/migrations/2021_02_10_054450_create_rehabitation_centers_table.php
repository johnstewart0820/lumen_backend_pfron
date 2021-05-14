<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRehabitationCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rehabitation_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('contact_number')->nullable(true)->index();
            $table->string('leader_name')->nullable(true)->index();
            $table->string('leader_regon_number')->nullable(true)->index();
            $table->string('leader_nip_number')->nullable(true)->index();
            $table->string('macroregion_number')->nullable(true)->index();
            $table->string('contact')->nullable(true)->index();
            $table->string('position')->nullable(true)->index();
            $table->string('phone')->nullable(true)->index();
            $table->string('email')->nullable(true)->index();
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
        Schema::dropIfExists('rehabitation_centers');
    }
}
