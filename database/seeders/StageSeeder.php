<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Decyzja negatywna'],
            ['id' => 2, 'name' => 'Etap 1 - Rekrutacja'],
            ['id' => 3, 'name' => 'Etap 2 - Kwalifikacja'],
            ['id' => 4, 'name' => 'Etap 3 - Decyzja komisji'],
            ['id' => 5, 'name' => 'Etap 4 - Przypisanie do ORK'],
            ['id' => 6, 'name' => 'Niezakwalifikowany'],
            ['id' => 7, 'name' => 'Zakwalifikowany']
        ];
        foreach($items as $item)
        {
            \App\Models\Stage::create($item);
        }
    }
}
