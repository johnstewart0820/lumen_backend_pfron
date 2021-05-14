<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRehabitationCenterPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rehabitation_center_partners', function (Blueprint $table) {
            $table->id();
            $table->integer('center_id')->index();
            $table->string('name')->nullable(true)->index();
            $table->string('regon')->index();
            $table->string('nip')->index();
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
        Schema::dropIfExists('rehabitation_center_partners');
    }
}
