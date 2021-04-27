<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'NK - negatywna kwalifikacja'],
            ['id' => 2, 'name' => 'O - oczekuje na skierowanie'],
            ['id' => 3, 'name' => 'R - rezygnacja przed skierowaniem'],
            ['id' => 4, 'name' => 'S - skierowany'],
            ['id' => 5, 'name' => 'ND - nie dojechał'],
            ['id' => 6, 'name' => 'U - uczestnik'],
            ['id' => 7, 'name' => 'URK - uczestnik rehabilitacji kompleksowej (przypisany IPR)'],
            ['id' => 8, 'name' => 'N IPR - negatywny IPR, po ocenie kompetencji'],
            ['id' => 9, 'name' => 'R1 - rezygnacja przed końcem okresu próbnego'],
            ['id' => 10, 'name' => 'R2- rezygnacja po okresie próbnym'],
            ['id' => 11, 'name' => 'R3- rezygnacja w trakcie pobytu'],
            ['id' => 12, 'name' => 'Z - zawieszenie pobytu w ORK'],
            ['id' => 13, 'name' => 'C - zawieszenie pobytu-COVID'],
            ['id' => 14, 'name' => 'UP - ukończony pobyt stacjonarny'],
            ['id' => 15, 'name' => 'UP+P - ukończone + podjęcie pracy'],
            ['id' => 16, 'name' => 'ZZ - zakończenie udziału zgodnie ze ścieżką'],
        ];
        foreach($items as $item)
        {
            \App\Models\Status::create($item);
        }
    }
}
