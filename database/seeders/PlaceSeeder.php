<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $file_n = storage_path('/app/data.csv');
        $file = fopen($file_n, "r");
        $id_voivodeship = 0;
        $id_county = 0;
        while ( ($data = fgetcsv($file, 200, ";")) !==FALSE ) {
            if (count($data) < 6)
                continue;
            if ($data[5] === 'województwo') {
                \App\Models\Voivodeship::create(['id' => $data[0],'name' => $data[4]]);
                $id_voivodeship = $data[0];
            } else if ($data[5] === 'powiat' || $data[5] === 'miasto na prawach powiatu' || $data[5] === "miasto stołeczne, na prawach powiatu") {
                \App\Models\County::create(['name' => $data[4], 'voivodeship_id' => $id_voivodeship]);
                $id_county++;
            } else if ($data[5] !== 'NAZWA_DOD') {
                \App\Models\Community::create(['name' => $data[4], 'county_id' => $id_county, 'type' => $data[5]]);
            }
        }
    }
}
