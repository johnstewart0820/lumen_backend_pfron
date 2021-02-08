<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'zawodowy'],
            ['id' => 2, 'name' => 'psychospołeczny'],
            ['id' => 3, 'name' => 'medyczny'],
        ];
        foreach($items as $item)
        {
            \App\Models\Module::create($item);
        }
    }
}
