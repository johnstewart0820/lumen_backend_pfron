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
            ['id' => 1, 'code' => "R", 'name' => "R - rezygnacja przed skierowaniem"],
            ['id' => 2, 'code' => "S", 'name' => "S - skierowany"],
            ['id' => 3, 'code' => "ND", 'name' => "ND - nie dojechał"],
            ['id' => 4, 'code' => "U", 'name' => "U - uczestnik"],
            ['id' => 5, 'code' => "URK", 'name' => "URK - uczestnik rehabilitacji kompleksowej (przypisany IPR"],
            ['id' => 6, 'code' => "NIPR", 'name' => "N IPR - negatywny IPR, po ocenie kompetencji"],
            ['id' => 7, 'code' => "R1", 'name' => "R1 - rezygnacja przed końcem okresu próbnego"],
            ['id' => 8, 'code' => "R2", 'name' => "R2- rezygnacja po okresie próbnym"],
            ['id' => 9, 'code' => "R3", 'name' => "R3- rezygnacja w trakcie pobytu"],
            ['id' => 10, 'code' => "Z", 'name' => "Z - zawieszenie pobytu w ORK"],
            ['id' => 11, 'code' => "C", 'name' => "C - zawieszenie pobytu-COVID"],
            ['id' => 12, 'code' => "UP", 'name' => "UP - ukończony pobyt stacjonarny"],
            ['id' => 13, 'code' => "UP+P", 'name' => "UP+P - ukończone + podjęcie pracy"],
            ['id' => 14, 'code' => "ZZ", 'name' => "ZZ - zakończenie udziału zgodnie ze ścieżką"],
        ];
        foreach($items as $item)
        {
            \App\Models\ParticipantStatusType::create($item);
        }
    }
}
