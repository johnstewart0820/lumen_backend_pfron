<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIprBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipr_balances', function (Blueprint $table) {
            $table->id();
            $table->string('id_ipr')->index();
            $table->string('id_service')->index();
            $table->string('amount')->nullable(true)->index();
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
        Schema::dropIfExists('ipr_balances');
    }
}
