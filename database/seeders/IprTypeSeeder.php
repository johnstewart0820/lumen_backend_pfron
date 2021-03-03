<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IprTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'bilans'],
            ['id' => 2, 'name' => 'próbny'],
            ['id' => 3, 'name' => 'podstawowy']
        ];
        foreach($items as $item)
        {
            \App\Models\IprType::create($item);
        }
    }
}
