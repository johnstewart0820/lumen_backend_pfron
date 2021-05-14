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
            $table->string('name')->nullable(true)->index();
            $table->string('surname')->nullable(true)->index();
            $table->string('person_id')->nullable(true)->index();
            $table->string('place_of_birth')->nullable(true)->index();
            $table->string('age')->nullable(true)->index();
            $table->date('date_of_birth')->nullable(true)->index();
            $table->string('street')->nullable(true)->index();
            $table->string('house_number')->nullable(true)->index();
            $table->string('apartment_number')->nullable(true)->index();
            $table->string('post_code')->nullable(true)->index();
            $table->string('post_office')->nullable(true)->index();
            $table->string('city')->nullable(true)->index();
            $table->string('second_street')->nullable(true)->index();
            $table->string('second_house_number')->nullable(true)->index();
            $table->string('second_apartment_number')->nullable(true)->index();
            $table->string('second_post_code')->nullable(true)->index();
            $table->string('second_post_office')->nullable(true)->index();
            $table->string('second_city')->nullable(true)->index();
            $table->string('voivodeship')->nullable(true)->index();
            $table->string('community')->nullable(true)->index();
            $table->string('county')->nullable(true)->index();
            $table->string('mobile_phone')->nullable(true)->index();
            $table->string('home_phone')->nullable(true)->index();
            $table->string('email')->nullable(true)->index();
            $table->string('family_mobile_phone')->nullable(true)->index();
            $table->string('family_home_phone')->nullable(true)->index();
            $table->string('education')->nullable(true)->index();
            $table->string('academic_title')->nullable(true)->index();
            $table->string('stay_status')->nullable(true)->index();
            $table->string('children_applicable')->nullable(true)->index();
            $table->string('children_amount')->nullable(true)->index();
            $table->string('children_age')->nullable(true)->index();
            $table->string('employed_status')->nullable(true)->index();
            $table->string('employed_type')->nullable(true)->index();
            $table->string('employed_in')->nullable(true)->index();
            $table->string('occupation')->nullable(true)->index();
            $table->string('unemployed_status')->nullable(true)->index();
            $table->string('have_unemployed_person_status')->nullable(true)->index();
            $table->string('unemployed_person_id')->nullable(true)->index();
            $table->string('long_term_employed_status')->nullable(true)->index();
            $table->string('seek_work_status')->nullable(true)->index();
            $table->string('passive_person_status')->nullable(true)->index();
            $table->string('full_time_status')->nullable(true)->index();
            $table->string('evening_student_status')->nullable(true)->index();
            $table->string('disabled_person_status')->nullable(true)->index();
            $table->string('number_certificate')->nullable(true)->index();
            $table->date('date_of_certificate')->nullable(true)->index();
            $table->string('level_certificate')->nullable(true)->index();
            $table->string('code_certificate')->nullable(true)->index();
            $table->string('necessary_certificate')->nullable(true)->index();
            $table->string('ethnic_minority_status')->nullable(true)->index();
            $table->string('homeless_person_status')->nullable(true)->index();
            $table->string('stay_house_status')->nullable(true)->index();
            $table->string('house_hold_status')->nullable(true)->index();
            $table->string('house_hold_adult_status')->nullable(true)->index();
            $table->string('uncomfortable_status')->nullable(true)->index();
            $table->string('stage')->nullable(true)->index();
            $table->string('id_status')->nullable(true)->index();
            $table->string('qualification_point')->nullable(true)->nullable(true)->index();
            $table->string('participant_status_type')->default(0)->nullable(true)->index();
            $table->boolean('is_participant')->default(false)->nullable(true)->index();
            $table->boolean('status')->nullable(true)->index();
            $table->dateTime('created_participant_time')->nullable(true)->nullable(true)->index();
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
