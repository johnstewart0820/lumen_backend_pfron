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
            $table->string('name');
            $table->string('contact_number')->nullable(true);
            $table->string('leader_name')->nullable(true);
            $table->string('leader_regon_number')->nullable(true);
            $table->string('leader_nip_number')->nullable(true);
            $table->string('macroregion_number')->nullable(true);
            $table->string('contact')->nullable(true);
            $table->string('position')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->string('email')->nullable(true);
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
