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
            ['id' => 1, 'name' => 'ND – nie dojechał'],
            ['id' => 2, 'name' => 'U – uczestnik w ORK', 'code' => 'U'],
            ['id' => 3, 'name' => 'URK - Uczestnik Rehabilitacji Kompleksowej (przypisany IPR)', 'code' => 'URK'],
            ['id' => 4, 'name' => 'N IPR/R1 – negatywny IPR (po ocenie kompetencji)', 'code' => 'N IPR/R1'],
            ['id' => 5, 'name' => 'R2 – rezygnacja po okresie próbnym', 'code' => 'R2'],
            ['id' => 6, 'name' => 'R3 – rezygnacja późniejsza', 'code' => 'R3'],
            ['id' => 7, 'name' => 'Z - zawieszony pobyt w ORK', 'code' => 'Z'],
            ['id' => 8, 'name' => 'C – zawieszenie Covid ', 'code' => 'C'],
            ['id' => 9, 'name' => 'UP – ukończony pobyt w ORK', "code" => "UP"],
            ['id' => 10, 'name' => 'UP+P – ukończył pobyt i podjął pracę', "code" => "UP+P"],
            ['id' => 11, 'name' => 'ZZ - zakończenie udziału w projekcie zgodnie ze ścieżką', "code" => "ZZ"],
        ];
        foreach($items as $item)
        {
            \App\Models\ParticipantStatusType::create($item);
        }
    }
}
