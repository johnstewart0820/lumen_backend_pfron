<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Specjalista ds. zarządzania rehabilitacją'],
            ['id' => 2, 'name' => 'Psycholog', 'module_type' => 'moduł psychospołeczny'],
            ['id' => 3, 'name' => 'Doradca zawodowy', 'module_type' => 'moduł zawodowy'],
            ['id' => 4, 'name' => 'Pośrednik pracy', 'module_type' => 'moduł zawodowy'],
            ['id' => 5, 'name' => 'Trener', 'module_type' => 'moduł zawodowy'],
            ['id' => 6, 'name' => 'Lekarz', 'module_type' => 'moduł medyczny'],
            ['id' => 7, 'name' => 'Rehabilitant', 'module_type' => 'moduł medyczny'],
            ['id' => 8, 'name' => 'Terapeuta zajęciowy', 'module_type' => 'moduł medyczny'],
            ['id' => 9, 'name' => 'Dietetyk', 'module_type' => 'moduł świadczenia opcjonalne'],
            ['id' => 10, 'name' => 'Logopeda', 'module_type' => 'moduł świadczenia opcjonalne'],
            ['id' => 11, 'name' => 'Wsparcie lekarskie specjalistyczne', 'module_type' => 'moduł świadczenia opcjonalne'],
            ['id' => 12, 'name' => 'Specjalista ds. pilotażu'],
            ['id' => 13, 'name' => 'Lekarz specjalista', 'module_type' => 'moduł świadczenia opcjonalne'],
            ['id' => 14, 'name' => 'Fizjoterapeuta'],
            ['id' => 15, 'name' => 'Pielęgniarka'],
            ['id' => 16, 'name' => 'Sekretarka medyczna'],
            ['id' => 17, 'name' => 'Specjalista ds. obsługi pilotażu'],
        ];
        foreach($items as $item)
        {
            \App\Models\Specialization::create($item);
        }
    }
}
