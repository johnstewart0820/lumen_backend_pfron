<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' =>1, 'value' => 130.00, 'rehabitation_center' => 1, 'service' => 1, 'status' => 1],
            ['id' =>2, 'value' => 140.22, 'rehabitation_center' => 1, 'service' => 2, 'status' => 1],
            ['id' =>3, 'value' => 159.90, 'rehabitation_center' => 1, 'service' => 3, 'status' => 1],
            ['id' =>4, 'value' => 140.22, 'rehabitation_center' => 1, 'service' => 4, 'status' => 1],
            ['id' =>5, 'value' => 159.90, 'rehabitation_center' => 1, 'service' => 5, 'status' => 1],
            ['id' =>6, 'value' => 130.00, 'rehabitation_center' => 1, 'service' => 6, 'status' => 1],
            ['id' =>7, 'value' => 140.22, 'rehabitation_center' => 1, 'service' => 7, 'status' => 1],
            ['id' =>8, 'value' => 159.90, 'rehabitation_center' => 1, 'service' => 8, 'status' => 1],
            ['id' =>9, 'value' => 140.22, 'rehabitation_center' => 1, 'service' => 9, 'status' => 1],
            ['id' =>10, 'value' => 140.22, 'rehabitation_center' => 1, 'service' => 10, 'status' => 1],
            ['id' =>11, 'value' => 159.90, 'rehabitation_center' => 1, 'service' => 11, 'status' => 1],
            ['id' =>12, 'value' => 140.22, 'rehabitation_center' => 1, 'service' => 12, 'status' => 1],
            ['id' =>13, 'value' => 51.66, 'rehabitation_center' => 1, 'service' => 13, 'status' => 1],
            ['id' =>14, 'value' => 32.25, 'rehabitation_center' => 1, 'service' => 15, 'status' => 1],
            ['id' =>15, 'value' => 6.25, 'rehabitation_center' => 1, 'service' => 16, 'status' => 1],
            ['id' =>16, 'value' => 140.22, 'rehabitation_center' => 1, 'service' => 18, 'status' => 1],
            ['id' =>17, 'value' => 159.90, 'rehabitation_center' => 1, 'service' => 22, 'status' => 1],
            ['id' =>18, 'value' => 51.66, 'rehabitation_center' => 1, 'service' => 23, 'status' => 1],
            ['id' =>19, 'value' => 80000.00, 'rehabitation_center' => 1, 'service' => 27, 'status' => 1],
            ['id' =>20, 'value' => 26000.00, 'rehabitation_center' => 1, 'service' => 28, 'status' => 1],
            ['id' =>21, 'value' => 28000.00, 'rehabitation_center' => 1, 'service' => 29, 'status' => 1],
            ['id' =>22, 'value' => 195.00, 'rehabitation_center' => 1, 'service' => 30, 'status' => 1],
            ['id' =>23, 'value' => 100.00, 'rehabitation_center' => 1, 'service' => 31, 'status' => 1],
            ['id' =>24, 'value' => 60024.00, 'rehabitation_center' => 1, 'service' => 41, 'status' => 1],
            ['id' =>25, 'value' => 30.00, 'rehabitation_center' => 2, 'service' => 1, 'status' => 1],
            ['id' =>26, 'value' => 73.80, 'rehabitation_center' => 2, 'service' => 2, 'status' => 1],
            ['id' =>27, 'value' => 30.00, 'rehabitation_center' => 2, 'service' => 3, 'status' => 1],
            ['id' =>28, 'value' => 73.80, 'rehabitation_center' => 2, 'service' => 4, 'status' => 1],
            ['id' =>29, 'value' => 30.00, 'rehabitation_center' => 2, 'service' => 5, 'status' => 1],
            ['id' =>30, 'value' => 30.00, 'rehabitation_center' => 2, 'service' => 6, 'status' => 1],
            ['id' =>31, 'value' => 73.80, 'rehabitation_center' => 2, 'service' => 7, 'status' => 1],
            ['id' =>32, 'value' => 30.00, 'rehabitation_center' => 2, 'service' => 8, 'status' => 1],
            ['id' =>33, 'value' => 73.80, 'rehabitation_center' => 2, 'service' => 9, 'status' => 1],
            ['id' =>34, 'value' => 73.80, 'rehabitation_center' => 2, 'service' => 10, 'status' => 1],
            ['id' =>35, 'value' => 30.00, 'rehabitation_center' => 2, 'service' => 11, 'status' => 1],
            ['id' =>36, 'value' => 73.80, 'rehabitation_center' => 2, 'service' => 12, 'status' => 1],
            ['id' =>37, 'value' => 40.00, 'rehabitation_center' => 2, 'service' => 13, 'status' => 1],
            ['id' =>38, 'value' => 38.00, 'rehabitation_center' => 2, 'service' => 15, 'status' => 1],
            ['id' =>39, 'value' => 29.00, 'rehabitation_center' => 2, 'service' => 16, 'status' => 1],
            ['id' =>40, 'value' => 67.65, 'rehabitation_center' => 2, 'service' => 18, 'status' => 1],
            ['id' =>41, 'value' => 20.00, 'rehabitation_center' => 2, 'service' => 22, 'status' => 1],
            ['id' =>42, 'value' => 10.00, 'rehabitation_center' => 2, 'service' => 23, 'status' => 1],
            ['id' =>43, 'value' => 215000.00, 'rehabitation_center' => 2, 'service' => 27, 'status' => 1],
            ['id' =>44, 'value' => 72000.00, 'rehabitation_center' => 2, 'service' => 28, 'status' => 1],
            ['id' =>45, 'value' => 71000.00, 'rehabitation_center' => 2, 'service' => 29, 'status' => 1],
            ['id' =>46, 'value' => 20.00, 'rehabitation_center' => 2, 'service' => 30, 'status' => 1],
            ['id' =>47, 'value' => 10.00, 'rehabitation_center' => 2, 'service' => 31, 'status' => 1],
            ['id' =>48, 'value' => 69300.00, 'rehabitation_center' => 2, 'service' => 41, 'status' => 1],
            ['id' =>49, 'value' => 70.00, 'rehabitation_center' => 3, 'service' => 1, 'status' => 1],
            ['id' =>50, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 2, 'status' => 1],
            ['id' =>51, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 3, 'status' => 1],
            ['id' =>52, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 4, 'status' => 1],
            ['id' =>53, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 5, 'status' => 1],
            ['id' =>54, 'value' => 70.00, 'rehabitation_center' => 3, 'service' => 6, 'status' => 1],
            ['id' =>55, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 7, 'status' => 1],
            ['id' =>56, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 8, 'status' => 1],
            ['id' =>57, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 9, 'status' => 1],
            ['id' =>58, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 11, 'status' => 1],
            ['id' =>59, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 12, 'status' => 1],
            ['id' =>60, 'value' => 90.00, 'rehabitation_center' => 3, 'service' => 13, 'status' => 1],
            ['id' =>61, 'value' => 90.00, 'rehabitation_center' => 3, 'service' => 15, 'status' => 1],
            ['id' =>62, 'value' => 85.00, 'rehabitation_center' => 3, 'service' => 16, 'status' => 1],
            ['id' =>63, 'value' => 100.00, 'rehabitation_center' => 3, 'service' => 18, 'status' => 1],
            ['id' =>64, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 22, 'status' => 1],
            ['id' =>65, 'value' => 100.00, 'rehabitation_center' => 3, 'service' => 23, 'status' => 1],
            ['id' =>66, 'value' => 4000.00, 'rehabitation_center' => 3, 'service' => 27, 'status' => 1],
            ['id' =>67, 'value' => 1300.00, 'rehabitation_center' => 3, 'service' => 28, 'status' => 1],
            ['id' =>68, 'value' => 1400.00, 'rehabitation_center' => 3, 'service' => 29, 'status' => 1],
            ['id' =>69, 'value' => 70.00, 'rehabitation_center' => 3, 'service' => 30, 'status' => 1],
            ['id' =>70, 'value' => 30.00, 'rehabitation_center' => 3, 'service' => 31, 'status' => 1],
            ['id' =>71, 'value' => 55350.00, 'rehabitation_center' => 3, 'service' => 41, 'status' => 1],
            ['id' =>72, 'value' => 110.00, 'rehabitation_center' => 3, 'service' => 10, 'status' => 1],
            ['id' =>73, 'value' => 80.00, 'rehabitation_center' => 4, 'service' => 1, 'status' => 1],
            ['id' =>74, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 2, 'status' => 1],
            ['id' =>75, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 3, 'status' => 1],
            ['id' =>76, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 4, 'status' => 1],
            ['id' =>77, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 5, 'status' => 1],
            ['id' =>78, 'value' => 80.00, 'rehabitation_center' => 4, 'service' => 6, 'status' => 1],
            ['id' =>79, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 7, 'status' => 1],
            ['id' =>80, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 8, 'status' => 1],
            ['id' =>81, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 9, 'status' => 1],
            ['id' =>82, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 10, 'status' => 1],
            ['id' =>83, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 11, 'status' => 1],
            ['id' =>84, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 12, 'status' => 1],
            ['id' =>85, 'value' => 90.00, 'rehabitation_center' => 4, 'service' => 13, 'status' => 1],
            ['id' =>86, 'value' => 90.00, 'rehabitation_center' => 4, 'service' => 15, 'status' => 1],
            ['id' =>87, 'value' => 80.00, 'rehabitation_center' => 4, 'service' => 16, 'status' => 1],
            ['id' =>88, 'value' => 100.00, 'rehabitation_center' => 4, 'service' => 18, 'status' => 1],
            ['id' =>89, 'value' => 110.00, 'rehabitation_center' => 4, 'service' => 22, 'status' => 1],
            ['id' =>90, 'value' => 90.00, 'rehabitation_center' => 4, 'service' => 23, 'status' => 1],
            ['id' =>91, 'value' => 12000.00, 'rehabitation_center' => 4, 'service' => 27, 'status' => 1],
            ['id' =>92, 'value' => 4000.00, 'rehabitation_center' => 4, 'service' => 28, 'status' => 1],
            ['id' =>93, 'value' => 80.00, 'rehabitation_center' => 4, 'service' => 30, 'status' => 1],
            ['id' =>94, 'value' => 45.00, 'rehabitation_center' => 4, 'service' => 31, 'status' => 1],
            ['id' =>95, 'value' => 55350.00, 'rehabitation_center' => 4, 'service' => 41, 'status' => 1],
            ['id' =>96, 'value' => 51.66, 'rehabitation_center' => 1, 'service' => 14, 'status' => 1],
            ['id' =>97, 'value' => 40.00, 'rehabitation_center' => 2, 'service' => 14, 'status' => 1],
            ['id' =>98, 'value' => 90.00, 'rehabitation_center' => 3, 'service' => 14, 'status' => 1],
            ['id' =>99, 'value' => 90.00, 'rehabitation_center' => 4, 'service' => 14, 'status' => 1],
            ['id' =>100, 'value' => 6.25, 'rehabitation_center' => 1, 'service' => 17, 'status' => 1],
            ['id' =>101, 'value' => 29.00, 'rehabitation_center' => 2, 'service' => 17, 'status' => 1],
            ['id' =>102, 'value' => 90.00, 'rehabitation_center' => 3, 'service' => 17, 'status' => 1],
            ['id' =>103, 'value' => 85.00, 'rehabitation_center' => 4, 'service' => 17, 'status' => 1],
            ['id' =>104, 'value' => 140.22, 'rehabitation_center' => 1, 'service' => 19, 'status' => 1],
            ['id' =>105, 'value' => 67.65, 'rehabitation_center' => 2, 'service' => 19, 'status' => 1],
            ['id' =>106, 'value' => 100.00, 'rehabitation_center' => 3, 'service' => 19, 'status' => 1],
            ['id' =>107, 'value' => 100.00, 'rehabitation_center' => 4, 'service' => 19, 'status' => 1],
            ['id' =>108, 'value' => 1845.00, 'rehabitation_center' => 1, 'service' => 21, 'status' => 1],
            ['id' =>109, 'value' => 2460.00, 'rehabitation_center' => 2, 'service' => 21, 'status' => 1],
            ['id' =>110, 'value' => 12000.00, 'rehabitation_center' => 3, 'service' => 21, 'status' => 1],
            ['id' =>111, 'value' => 12000.00, 'rehabitation_center' => 4, 'service' => 21, 'status' => 1],
            ['id' =>112, 'value' => 159.90, 'rehabitation_center' => 1, 'service' => 24, 'status' => 1],
            ['id' =>113, 'value' => 20.00, 'rehabitation_center' => 2, 'service' => 24, 'status' => 1],
            ['id' =>114, 'value' => 100.00, 'rehabitation_center' => 3, 'service' => 24, 'status' => 1],
            ['id' =>115, 'value' => 100.00, 'rehabitation_center' => 4, 'service' => 24, 'status' => 1],
            ['id' =>116, 'value' => 12838.74, 'rehabitation_center' => 1, 'service' => 25, 'status' => 1],
            ['id' =>117, 'value' => 1500.00, 'rehabitation_center' => 2, 'service' => 25, 'status' => 1],
            ['id' =>118, 'value' => 100.00, 'rehabitation_center' => 3, 'service' => 25, 'status' => 1],
            ['id' =>119, 'value' => 100.00, 'rehabitation_center' => 4, 'service' => 25, 'status' => 1],
            ['id' =>120, 'value' => 123.00, 'rehabitation_center' => 1, 'service' => 26, 'status' => 1],
            ['id' =>121, 'value' => 120.00, 'rehabitation_center' => 2, 'service' => 26, 'status' => 1],
            ['id' =>122, 'value' => 100.00, 'rehabitation_center' => 3, 'service' => 26, 'status' => 1],
            ['id' =>123, 'value' => 100.00, 'rehabitation_center' => 4, 'service' => 26, 'status' => 1],
            ['id' =>124, 'value' => 200.00, 'rehabitation_center' => 1, 'service' => 32, 'status' => 1],
            ['id' =>125, 'value' => 20.00, 'rehabitation_center' => 2, 'service' => 32, 'status' => 1],
            ['id' =>126, 'value' => 80.00, 'rehabitation_center' => 3, 'service' => 32, 'status' => 1],
            ['id' =>127, 'value' => 150.00, 'rehabitation_center' => 4, 'service' => 32, 'status' => 1],
            ['id' =>128, 'value' => 135.00, 'rehabitation_center' => 1, 'service' => 33, 'status' => 1],
            ['id' =>129, 'value' => 20.00, 'rehabitation_center' => 2, 'service' => 33, 'status' => 1],
            ['id' =>130, 'value' => 80.00, 'rehabitation_center' => 3, 'service' => 33, 'status' => 1],
            ['id' =>131, 'value' => 150.00, 'rehabitation_center' => 4, 'service' => 33, 'status' => 1],
            ['id' =>132, 'value' => 130.00, 'rehabitation_center' => 1, 'service' => 34, 'status' => 1],
            ['id' =>133, 'value' => 20.00, 'rehabitation_center' => 2, 'service' => 34, 'status' => 1],
            ['id' =>134, 'value' => 60.00, 'rehabitation_center' => 3, 'service' => 34, 'status' => 1],
            ['id' =>135, 'value' => 150.00, 'rehabitation_center' => 4, 'service' => 34, 'status' => 1],
            ['id' =>136, 'value' => 43.20, 'rehabitation_center' => 1, 'service' => 35, 'status' => 1],
            ['id' =>137, 'value' => 100.00, 'rehabitation_center' => 2, 'service' => 35, 'status' => 1],
            ['id' =>138, 'value' => 85.00, 'rehabitation_center' => 3, 'service' => 35, 'status' => 1],
            ['id' =>139, 'value' => 90.00, 'rehabitation_center' => 4, 'service' => 35, 'status' => 1],
            ['id' =>140, 'value' => 43.20, 'rehabitation_center' => 1, 'service' => 36, 'status' => 1],
            ['id' =>141, 'value' => 75.00, 'rehabitation_center' => 2, 'service' => 36, 'status' => 1],
            ['id' =>142, 'value' => 60.00, 'rehabitation_center' => 3, 'service' => 36, 'status' => 1],
            ['id' =>143, 'value' => 40.00, 'rehabitation_center' => 4, 'service' => 36, 'status' => 1],
            ['id' =>144, 'value' => 52.92, 'rehabitation_center' => 1, 'service' => 37, 'status' => 1],
            ['id' =>145, 'value' => 10.00, 'rehabitation_center' => 2, 'service' => 37, 'status' => 1],
            ['id' =>146, 'value' => 40.00, 'rehabitation_center' => 3, 'service' => 37, 'status' => 1],
            ['id' =>147, 'value' => 35.00, 'rehabitation_center' => 4, 'service' => 37, 'status' => 1],
            ['id' =>148, 'value' => 105.84, 'rehabitation_center' => 1, 'service' => 38, 'status' => 1],
            ['id' =>149, 'value' => 100.00, 'rehabitation_center' => 2, 'service' => 38, 'status' => 1],
            ['id' =>150, 'value' => 140.00, 'rehabitation_center' => 3, 'service' => 38, 'status' => 1],
            ['id' =>151, 'value' => 130.00, 'rehabitation_center' => 4, 'service' => 38, 'status' => 1],
            ['id' =>152, 'value' => 147.60, 'rehabitation_center' => 1, 'service' => 39, 'status' => 1],
            ['id' =>153, 'value' => 30.00, 'rehabitation_center' => 2, 'service' => 39, 'status' => 1],
            ['id' =>154, 'value' => 60.00, 'rehabitation_center' => 3, 'service' => 39, 'status' => 1],
            ['id' =>155, 'value' => 130.00, 'rehabitation_center' => 4, 'service' => 39, 'status' => 1],
            ['id' =>156, 'value' => 60.27, 'rehabitation_center' => 1, 'service' => 40, 'status' => 1],
            ['id' =>157, 'value' => 30.00, 'rehabitation_center' => 2, 'service' => 40, 'status' => 1],
            ['id' =>158, 'value' => 60.00, 'rehabitation_center' => 3, 'service' => 40, 'status' => 1],
            ['id' =>159, 'value' => 130.00, 'rehabitation_center' => 4, 'service' => 40, 'status' => 1],
        ];
        foreach($items as $item)
        {
            \App\Models\Payment::create($item);
        }
    }
}
