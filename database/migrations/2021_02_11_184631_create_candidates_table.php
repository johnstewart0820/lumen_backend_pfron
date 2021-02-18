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
            $table->string('second_street');
            $table->string('second_house_number');
            $table->string('second_apartment_number');
            $table->string('second_post_code');
            $table->string('second_post_office');
            $table->string('second_city');
            $table->string('voivodeship');
            $table->string('community');
            $table->string('county');
            $table->string('mobile_phone');
            $table->string('home_phone');
            $table->string('email');
            $table->string('family_mobile_phone');
            $table->string('family_home_phone');
            $table->string('education');
            $table->string('academic_title');
            $table->string('stay_status');
            $table->string('children_applicable');
            $table->string('children_amount');
            $table->string('children_age');
            $table->string('employed_status');
            $table->string('employed_type');
            $table->string('employed_in');
            $table->string('occupation');
            $table->string('unemployed_status');
            $table->string('have_unemployed_person_status');
            $table->string('unemployed_person_id');
            $table->string('long_term_employed_status');
            $table->string('seek_work_status');
            $table->string('passive_person_status');
            $table->string('full_time_status');
            $table->string('evening_student_status');
            $table->string('disabled_person_status');
            $table->string('number_certificate');
            $table->date('date_of_certificate');
            $table->string('level_certificate');
            $table->string('code_certificate');
            $table->string('necessary_certificate');
            $table->string('ethnic_minority_status');
            $table->string('homeless_person_status');
            $table->string('stay_house_status');
            $table->string('house_hold_status');
            $table->string('house_hold_adult_status');
            $table->string('uncomfortable_status');
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
