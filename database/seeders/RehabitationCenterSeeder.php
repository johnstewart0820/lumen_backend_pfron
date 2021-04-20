<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RehabitationCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'ORK Wągrowiec', 'contact_number' => '2019/06/740', 'leader_name' => 'WIELSPIN spółka z ograniczoną odpowiedzialnością',
                'leader_regon_number' => '30192269500000', 'leader_nip_number' => '7811873010', 'macroregion_number' => 1,
                'contact' => 'Beata Dopierała', 'position' => 'Specjalista ds. pilotażu i oraz monitorowania postępów uczestników',
                'phone' => '509 072 981', 'email' => 'ork@wielspin.pl'],
            ['id' => 2, 'name' => 'ORK Ustroń', 'contact_number' => '2019/06/741', 'leader_name' => 'Hotel Róża spółka z ograniczoną odpowiedzialnością',
                'leader_regon_number' => '93193096500000', 'leader_nip_number' => '5482133988', 'macroregion_number' => 2,
                'contact' => 'Przemysław Gołdyn', 'position' => 'Specjalista ds. pilotażu i oraz monitorowania postępów uczestników',
                'phone' => '693 580 53', 'email' => 'p.goldyn@zdz.katowice.pl'],
            ['id' => 3, 'name' => 'ORK Grębiszew', 'contact_number' => '2019/06/742', 'leader_name' => 'MDDP spółka akcyjna Akademia Biznesu spółka komandytowa',
                'leader_regon_number' => '14112298100000', 'leader_nip_number' => '7010088170', 'macroregion_number' => 3,
                'contact' => 'Tomasz Gierwatowski', 'position' => 'Specjalista ds. pilotażu i oraz monitorowania postępów uczestników',
                'phone' => '602 365 697', 'email' => 'Tomasz.gierwatowski@akademiamddp.pl'],
            ['id' => 4, 'name' => 'ORK Nałęczów', 'contact_number' => '2019/06/743', 'leader_name' => 'MDDP spółka akcyjna Akademia Biznesu spółka komandytowa',
                'leader_regon_number' => '14112298100000', 'leader_nip_number' => '7010088170', 'macroregion_number' => 3,
                'contact' => 'Sylwia Nowak', 'position' => 'Specjalista ds. pilotażu i oraz monitorowania postępów uczestników',
                'phone' => '22 208 28 80', 'email' => 'Sylwia.nowak@akademiamddp.pl'],
        ];
        foreach($items as $item)
        {
            \App\Models\RehabitationCenter::create($item);
        }

        $partner_items = [
            ['id' => 1, 'center_id' => 2, 'name' => 'Zakład Doskonalenia Zawodowego w Katowicach', 'regon' => '51253300000', 'nip' => '6430135558'],
            ['id' => 2, 'center_id' => 3, 'name' => 'Krajowa Izba Gospodarcza', 'regon' => '621018700000', 'nip' => '5260001708'],
            ['id' => 3, 'center_id' => 4, 'name' => 'Krajowa Izba Gospodarcza', 'regon' => '621018700000', 'nip' => '5260001708'],
        ];

        foreach($partner_items as $item)
        {
            \App\Models\RehabitationCenterPartner::create($item);
        }
    }
}
