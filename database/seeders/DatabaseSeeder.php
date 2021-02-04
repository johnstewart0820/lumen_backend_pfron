<?php

namespace Database\Seeders;

use App\Models\Voivodeships;
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
            UserSeeder::class,
            RoleSeeder::class,
            QualificationPointTypeSeeder::class
        ]);
    }
}
