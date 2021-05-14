<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('value')->index();
            $table->integer('rehabitation_center')->index();
            $table->integer('service')->index();
            $table->integer('pricelist_amount')->nullable(true)->index();
            $table->integer('pricelist_cost')->nullable(true)->index();
            $table->boolean('is_flatrate_service')->nullable(true)->index();
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
        Schema::dropIfExists('payments');
    }
}
