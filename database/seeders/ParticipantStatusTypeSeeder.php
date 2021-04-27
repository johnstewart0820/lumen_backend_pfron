<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParticipantStatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'code' => "NK", 'name' => "NK - negatywna kwalifikacja"],
            ['id' => 2, 'code' => "O", 'name' => "O - oczekuje na skierowanie"],
            ['id' => 3, 'code' => "R", 'name' => "R - rezygnacja przed skierowaniem"],
            ['id' => 4, 'code' => "S", 'name' => "S - skierowany"],
            ['id' => 5, 'code' => "ND", 'name' => "ND - nie dojechał"],
            ['id' => 6, 'code' => "U", 'name' => "U - uczestnik"],
            ['id' => 7, 'code' => "URK", 'name' => "URK - uczestnik rehabilitacji kompleksowej (przypisany IPR"],
            ['id' => 8, 'code' => "NIPR", 'name' => "N IPR - negatywny IPR, po ocenie kompetencji"],
            ['id' => 9, 'code' => "R1", 'name' => "R1 - rezygnacja przed końcem okresu próbnego"],
            ['id' => 10, 'code' => "R2", 'name' => "R2- rezygnacja po okresie próbnym"],
            ['id' => 11, 'code' => "R3", 'name' => "R3- rezygnacja w trakcie pobytu"],
            ['id' => 12, 'code' => "Z", 'name' => "Z - zawieszenie pobytu w ORK"],
            ['id' => 13, 'code' => "C", 'name' => "C - zawieszenie pobytu-COVID"],
            ['id' => 14, 'code' => "UP", 'name' => "UP - ukończony pobyt stacjonarny"],
            ['id' => 15, 'code' => "UP+P", 'name' => "UP+P - ukończone + podjęcie pracy"],
            ['id' => 16, 'code' => "ZZ", 'name' => "ZZ - zakończenie udziału zgodnie ze ścieżką"],
        ];
        foreach($items as $item)
        {
            \App\Models\ParticipantStatusType::create($item);
        }
    }
}
