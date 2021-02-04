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
            ['id_role' => 1, 'name' => 'admin'],
            ['id_role' => 2, 'name' => 'ambassador'],
            ['id_role' => 3, 'name' => 'worker'],
            ['id_role' => 4, 'name' => 'ork'],
        ];
        foreach($items as $item)
        {
            \App\Models\Role::create($item);
        }
    }
}
