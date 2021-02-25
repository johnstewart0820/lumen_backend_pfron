<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceListTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Indywidualne'],
            ['id' => 2, 'name' => 'Grupowe'],
        ];
        foreach($items as $item)
        {
            \App\Models\ServiceListType::create($item);
        }
    }
}
