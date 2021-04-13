<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('id_role');
            $table->boolean('is_valid')->default(false);
            $table->string('token')->nullable();
            $table->string('activate_status')->default(true);
            $table->boolean('status')->default(true);
            $table->boolean('end_service_date')->default(true);
            $table->boolean('undone_service_participant')->default(true);
            $table->boolean('end_stay_participant')->default(true);
            $table->boolean('amount_service_participant')->default(true);
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
        Schema::dropIfExists('users');
    }
}
