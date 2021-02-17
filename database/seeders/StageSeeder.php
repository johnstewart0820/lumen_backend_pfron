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
            ['id' => 1, 'name' => 'Etap 1 - Rekrutacja'],
            ['id' => 2, 'name' => 'Etap 2 - Kwalifikacja'],
            ['id' => 3, 'name' => 'Etap 3 - Decyzja komisji'],
            ['id' => 4, 'name' => 'Etap 4 - Przypisanie do ORK'],
        ];
        foreach($items as $item)
        {
            \App\Models\Stage::create($item);
        }
    }
}
