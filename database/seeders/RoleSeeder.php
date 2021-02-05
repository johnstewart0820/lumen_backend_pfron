<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Administrator'],
            ['id' => 2, 'name' => 'Ambasador projektu'],
            ['id' => 3, 'name' => 'Pracownik biura projektu'],
            ['id' => 4, 'name' => 'ORK'],
        ];
        foreach($items as $item)
        {
            \App\Models\Role::create($item);
        }
    }
}
