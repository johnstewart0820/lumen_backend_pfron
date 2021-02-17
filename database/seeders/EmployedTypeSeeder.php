<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployedTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Administracja rządowa'],
            ['id' => 2, 'name' => 'MMSP'],
            ['id' => 3, 'name' => 'Własna działalność'],
            ['id' => 4, 'name' => 'NGO'],
            ['id' => 5, 'name' => 'Duźe przedsiębiorstwo'],
        ];
        foreach($items as $item)
        {
            \App\Models\EmployedType::create($item);
        }
    }
}
