<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QualificationPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Katowice', 'type' => 1],
            ['id' => 2, 'name' => 'Opole/Katowice', 'type' => 1],
            ['id' => 3, 'name' => 'Kielce', 'type' => 1],
            ['id' => 4, 'name' => 'Lublin', 'type' => 1],
            ['id' => 5, 'name' => 'Poznań', 'type' => 1],
            ['id' => 6, 'name' => 'Warszawa', 'type' => 1],
            ['id' => 7, 'name' => 'Białystok', 'type' => 2],
            ['id' => 8, 'name' => 'Bielsko-Biała', 'type' => 2],
            ['id' => 9, 'name' => 'Biłgoraj', 'type' => 2],
            ['id' => 10, 'name' => 'Bydgoszcz', 'type' => 2],
            ['id' => 11, 'name' => 'Chorzów', 'type' => 2],
            ['id' => 12, 'name' => 'Chrzanów', 'type' => 2],
            ['id' => 13, 'name' => 'Częstochowa', 'type' => 2],
            ['id' => 14, 'name' => 'Gdańsk', 'type' => 2],
            ['id' => 15, 'name' => 'Gorzów Wlkp', 'type' => 2],
            ['id' => 16, 'name' => 'Kielce', 'type' => 2],
            ['id' => 17, 'name' => 'Kraków', 'type' => 2],
            ['id' => 18, 'name' => 'Lublin', 'type' => 2],
            ['id' => 19, 'name' => 'Łódź', 'type' => 2],
            ['id' => 20, 'name' => 'Nowy Sącz', 'type' => 2],
            ['id' => 21, 'name' => 'Olsztyn', 'type' => 2],
            ['id' => 22, 'name' => 'Opole', 'type' => 2],
            ['id' => 23, 'name' => 'Poznań', 'type' => 2],
            ['id' => 24, 'name' => 'Radom', 'type' => 2],
            ['id' => 25, 'name' => 'Rybnik', 'type' => 2],
            ['id' => 26, 'name' => 'Rzeszów', 'type' => 2],
            ['id' => 27, 'name' => 'Siedlce', 'type' => 2],
            ['id' => 28, 'name' => 'Słupsk', 'type' => 2],
            ['id' => 29, 'name' => 'Sosnowiec', 'type' => 2],
            ['id' => 30, 'name' => 'Szczecin', 'type' => 2],
            ['id' => 31, 'name' => 'Toruń', 'type' => 2],
            ['id' => 32, 'name' => 'Wałbrzych', 'type' => 2],
            ['id' => 33, 'name' => 'Warszawa', 'type' => 2],
            ['id' => 34, 'name' => 'Wrocław', 'type' => 2],
            ['id' => 35, 'name' => 'Zielona Góra', 'type' => 2],
            ['id' => 36, 'name' => 'Gniezno', 'type' => 3],
            ['id' => 37, 'name' => 'Mińsk Maz.', 'type' => 3],
            ['id' => 38, 'name' => 'Rybnik', 'type' => 3],
            ['id' => 39, 'name' => 'Świdnik', 'type' => 3],
            ['id' => 40, 'name' => 'Wągrowiec', 'type' => 3],
        ];
        foreach($items as $item)
        {
            \App\Models\QualificationPoint::create($item);
        }
    }
}
