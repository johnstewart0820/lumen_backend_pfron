<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'spotkanie', 'countable' => false],
            ['id' => 2, 'name' => 'spotkanie/warsztat', 'countable' => false],
            ['id' => 3, 'name' => 'godzina', 'minutes' => 60, 'countable' => true],
            ['id' => 4, 'name' => 'godzina lekcyjna/warsztat (45 minut)', 'minutes' => 45, 'countable' => true],
            ['id' => 5, 'name' => 'impreza', 'countable' => false],
            ['id' => 6, 'name' => 'miesiąc ', 'countable' => false],
            ['id' => 7, 'name' => 'doba', 'countable' => false],
            ['id' => 8, 'name' => 'dzień', 'countable' => false],
            ['id' => 9, 'name' => 'osoba/imprez', 'countable' => false],
            ['id' => 10, 'name' => 'wizyta 1 osoby', 'countable' => false],
            ['id' => 11, 'name' => 'badanie', 'countable' => false],
        ];
        foreach($items as $item)
        {
            \App\Models\Unit::create($item);
        }
    }
}
