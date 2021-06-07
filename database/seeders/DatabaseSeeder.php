<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            NotificationSeeder::class,
            ServiceListSeeder::class,
            UnitSeeder::class,
            PaymentSeeder::class,
            FlatRateSeeder::class,
            OrkTeamSeeder::class,
            IprTypeSeeder::class,
            SpecialistSeeder::class,
            QualificationPointSeeder::class,
            ServiceListTypeSeeder::class,
            ParticipantStatusTypeSeeder::class,
            EmployedTypeSeeder::class,
            EducationsSeeder::class,
            PlaceSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            QualificationPointTypeSeeder::class,
            SpecialtyTypeSeeder::class,
            ModuleSeeder::class,
            RehabitationCenterQuaterSeeder::class,
            RehabitationCenterSeeder::class,
            SpecializationSeeder::class,
            StageSeeder::class,
            StatusSeeder::class,
            CandidateSeeder::class,
            SlSeeder::class,
            ArrivalSeeder::class,
            FirstIprSeeder::class,
            SecondIprSeeder::class,
            ThreeIprSeeder::class,
            FourIprSeeder::class,
        ]);
    }
}
