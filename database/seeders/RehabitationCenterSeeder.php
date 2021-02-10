<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RehabitationCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'ORK Wągrowiec'],
            ['id' => 2, 'name' => 'ORK Ustroń'],
            ['id' => 3, 'name' => 'ORK Grębiszew'],
            ['id' => 4, 'name' => 'ORK Nałęczów'],
        ];
        foreach($items as $item)
        {
            \App\Models\RehabitationCenter::create($item);
        }
    }
}
