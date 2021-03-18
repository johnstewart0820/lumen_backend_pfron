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
            ['id' => 1, 'name' => 'Diagnoza i opracowanie'],
            ['id' => 2, 'name' => 'Moduł zawodowy'],
            ['id' => 3, 'name' => 'Moduł psychospołeczny'],
            ['id' => 4, 'name' => 'Moduł medyczny'],
            ['id' => 5, 'name' => 'Świadczenia opcjonalne'],
            ['id' => 6, 'name' => 'Świadczenia towarzyszące'],
            ['id' => 7, 'name' => 'Zarządzanie i ewaluacja'],
        ];
        foreach($items as $item)
        {
            \App\Models\Module::create($item);
        }
    }
}
