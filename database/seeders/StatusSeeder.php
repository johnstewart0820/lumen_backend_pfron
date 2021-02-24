<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'F - przyjęty formularz rekrutacyjny'],
            ['id' => 2, 'name' => 'NKW - niekwalifikowalny'],
            ['id' => 3, 'name' => 'NK - negatywna kwalifikacyjna'],
            ['id' => 4, 'name' => 'O - oczekuje na skierowanie do ORK'],
        ];
        foreach($items as $item)
        {
            \App\Models\Status::create($item);
        }
    }
}
