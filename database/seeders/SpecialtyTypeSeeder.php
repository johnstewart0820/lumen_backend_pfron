<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpecialtyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'psycholog'],
            ['id' => 2, 'name' => 'lekarz'],
        ];
        foreach($items as $item)
        {
            \App\Models\SpecialtyType::create($item);
        }
    }
}
