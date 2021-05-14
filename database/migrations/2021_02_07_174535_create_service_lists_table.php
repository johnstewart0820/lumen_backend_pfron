<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->integer('number')->index();
            $table->integer('module')->index();
            $table->integer('type')->index();
            $table->string('amount_usage')->index();
            $table->integer('unit')->index();
            $table->string('amount_takes')->index();
            $table->boolean('is_required')->index();
            $table->boolean('not_applicable')->index();
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
        Schema::dropIfExists('service_lists');
    }
}
