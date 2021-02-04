<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QualificationPointTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'PFRON'],
            ['id' => 2, 'name' => 'ZUS'],
            ['id' => 3, 'name' => 'KRUS'],
            ['id' => 4, 'name' => 'MSWiA'],
            ['id' => 5, 'name' => 'Zespół ds. orzekania o niepełnosprawności'],
        ];
        foreach($items as $item)
        {
            \App\Models\QualificationPointType::create($item);
        }
    }
}
