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
            $table->string('name')->nullable(true);
            $table->string('surname')->nullable(true);
            $table->string('person_id')->nullable(true);
            $table->string('place_of_birth')->nullable(true);
            $table->date('date_of_birth')->nullable(true);
            $table->string('street')->nullable(true);
            $table->string('house_number')->nullable(true);
            $table->string('apartment_number')->nullable(true);
            $table->string('post_code')->nullable(true);
            $table->string('post_office')->nullable(true);
            $table->string('city')->nullable(true);
            $table->string('second_street')->nullable(true);
            $table->string('second_house_number')->nullable(true);
            $table->string('second_apartment_number')->nullable(true);
            $table->string('second_post_code')->nullable(true);
            $table->string('second_post_office')->nullable(true);
            $table->string('second_city')->nullable(true);
            $table->string('voivodeship')->nullable(true);
            $table->string('community')->nullable(true);
            $table->string('county')->nullable(true);
            $table->string('mobile_phone')->nullable(true);
            $table->string('home_phone')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('family_mobile_phone')->nullable(true);
            $table->string('family_home_phone')->nullable(true);
            $table->string('education')->nullable(true);
            $table->string('academic_title')->nullable(true);
            $table->string('stay_status')->nullable(true);
            $table->string('children_applicable')->nullable(true);
            $table->string('children_amount')->nullable(true);
            $table->string('children_age')->nullable(true);
            $table->string('employed_status')->nullable(true);
            $table->string('employed_type')->nullable(true);
            $table->string('employed_in')->nullable(true);
            $table->string('occupation')->nullable(true);
            $table->string('unemployed_status')->nullable(true);
            $table->string('have_unemployed_person_status')->nullable(true);
            $table->string('unemployed_person_id')->nullable(true);
            $table->string('long_term_employed_status')->nullable(true);
            $table->string('seek_work_status')->nullable(true);
            $table->string('passive_person_status')->nullable(true);
            $table->string('full_time_status')->nullable(true);
            $table->string('evening_student_status')->nullable(true);
            $table->string('disabled_person_status')->nullable(true);
            $table->string('number_certificate')->nullable(true);
            $table->date('date_of_certificate')->nullable(true);
            $table->string('level_certificate')->nullable(true);
            $table->string('code_certificate')->nullable(true);
            $table->string('necessary_certificate')->nullable(true);
            $table->string('ethnic_minority_status')->nullable(true);
            $table->string('homeless_person_status')->nullable(true);
            $table->string('stay_house_status')->nullable(true);
            $table->string('house_hold_status')->nullable(true);
            $table->string('house_hold_adult_status')->nullable(true);
            $table->string('uncomfortable_status')->nullable(true);
            $table->string('stage')->nullable(true);
            $table->string('id_status')->nullable(true);
            $table->string('qualification_point')->nullable(true)->nullable(true);
            $table->string('participant_status_type')->default(0)->nullable(true);
            $table->boolean('is_participant')->default(false)->nullable(true);
            $table->boolean('status')->nullable(true);
            $table->dateTime('created_participant_time')->nullable(true)->nullable(true);
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
