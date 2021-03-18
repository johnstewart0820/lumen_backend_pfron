<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EducationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'niepełne podstawowe (ISCED 0)'],
            ['id' => 2, 'name' => 'Gimnazjalne (ISCED 2)'],
            ['id' => 3, 'name' => 'średnie zawodowe (technik) (ISCED 3)'],
            ['id' => 4, 'name' => 'Pomaturalne (ISCED 4)'],
            ['id' => 5, 'name' => 'wyższe magisterskie (mgr lub równorzędne) (ISCED 7)'],
            ['id' => 6, 'name' => 'Podstawowe (ISCED 1)'],
            ['id' => 7, 'name' => 'zasadnicze zawodowe(ISCED 3)'],
            ['id' => 8, 'name' => 'Licealne (ISCED 3)'],
            ['id' => 9, 'name' => 'wyższe zawodowe (lic., inż. lub równorzędne) (ISCED 5-6)'],
            ['id' => 10, 'name' => 'wyższy stopień lub tytuł naukowy (dr, prof.) (ISCED 8)'],
        ];
        foreach($items as $item)
        {
            \App\Models\Educations::create($item);
        }
    }
}
