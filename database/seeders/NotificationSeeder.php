<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'title' => 'Usługa 2254: Zakończenie', 'description' => 'Uczestniki Jan Kowalski nie zrealizowal ...', 'id_service' => 1, 'activate_status' => true],
            ['id' => 2, 'title' => 'Usługa 5548: Przekroczenie wymiaru danej usługi', 'description' => 'description', 'id_candidate' => 1, 'activate_status' => false],

        ];
        foreach($items as $item)
        {
            \App\Models\Notification::create($item);
        }
    }
}
