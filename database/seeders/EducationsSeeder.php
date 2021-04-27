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
            ['id' => 2, 'name' => 'podstawowe (ISCED 1)'],
            ['id' => 3, 'name' => 'gimnazjalne (ISCED 2)'],
            ['id' => 4, 'name' => 'średnie zawodowe (technik) (ISCED 3)'],
            ['id' => 5, 'name' => 'zasadnicze zawodowe(ISCED 3)'],
            ['id' => 6, 'name' => 'Licealne (ISCED 3)'],
            ['id' => 7, 'name' => 'ponadgimnazjalne (ISCED 3)'],
            ['id' => 8, 'name' => 'policealne (ISCED 4)'],
            ['id' => 9, 'name' => 'wyższe (ISCED 5-8)'],
            ['id' => 10, 'name' => 'wyższy stopień lub tytuł naukowy (dr, prof.) (ISCED 8)'],
        ];
        foreach($items as $item)
        {
            \App\Models\Educations::create($item);
        }
    }
}
