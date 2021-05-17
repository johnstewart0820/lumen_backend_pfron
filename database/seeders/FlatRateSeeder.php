<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FlatRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['payment_id' => 83, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 83, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 83, 'quater_id' => 3, 'price' => 5.75],
            ['payment_id' => 83, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 83, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 115, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 115, 'quater_id' => 18, 'price' => 7.5],
            ['payment_id' => 115, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 115, 'quater_id' => 20, 'price' => 6],
            ['payment_id' => 115, 'quater_id' => 21, 'price' => 34.2],
            ['payment_id' => 147, 'quater_id' => 33, 'price' => 16],
            ['payment_id' => 147, 'quater_id' => 34, 'price' => 17],
            ['payment_id' => 147, 'quater_id' => 35, 'price' => 4],
            ['payment_id' => 147, 'quater_id' => 36, 'price' => 20],
            ['payment_id' => 147, 'quater_id' => 37, 'price' => 27.5],
            ['payment_id' => 179, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 179, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 179, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 179, 'quater_id' => 52, 'price' => 21],
            ['payment_id' => 179, 'quater_id' => 53, 'price' => 20.5],

            ['payment_id' => 85, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 85, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 85, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 85, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 85, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 117, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 117, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 117, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 117, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 117, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 149, 'quater_id' => 33, 'price' => 0],
            ['payment_id' => 149, 'quater_id' => 34, 'price' => 0],
            ['payment_id' => 149, 'quater_id' => 35, 'price' => 0],
            ['payment_id' => 149, 'quater_id' => 36, 'price' => 11],
            ['payment_id' => 149, 'quater_id' => 37, 'price' => 6],
            ['payment_id' => 181, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 181, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 181, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 181, 'quater_id' => 52, 'price' => 13],
            ['payment_id' => 181, 'quater_id' => 53, 'price' => 14],

            ['payment_id' => 87, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 87, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 87, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 87, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 87, 'quater_id' => 5, 'price' => 1],
            ['payment_id' => 119, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 119, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 119, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 119, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 119, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 151, 'quater_id' => 33, 'price' => 0],
            ['payment_id' => 151, 'quater_id' => 34, 'price' => 0],
            ['payment_id' => 151, 'quater_id' => 35, 'price' => 0],
            ['payment_id' => 151, 'quater_id' => 36, 'price' => 0],
            ['payment_id' => 151, 'quater_id' => 37, 'price' => 0],
            ['payment_id' => 183, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 183, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 183, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 183, 'quater_id' => 52, 'price' => 0],
            ['payment_id' => 183, 'quater_id' => 53, 'price' => 0],

            ['payment_id' => 89, 'quater_id' => 1, 'price' => 3],
            ['payment_id' => 89, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 89, 'quater_id' => 3, 'price' => 0.82],
            ['payment_id' => 89, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 89, 'quater_id' => 5, 'price' => 3],
            ['payment_id' => 121, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 121, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 121, 'quater_id' => 19, 'price' => 0.36],
            ['payment_id' => 121, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 121, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 153, 'quater_id' => 33, 'price' => 3],
            ['payment_id' => 153, 'quater_id' => 34, 'price' => 3],
            ['payment_id' => 153, 'quater_id' => 35, 'price' => 0.59],
            ['payment_id' => 153, 'quater_id' => 36, 'price' => 1.79],
            ['payment_id' => 153, 'quater_id' => 37, 'price' => 3],
            ['payment_id' => 185, 'quater_id' => 49, 'price' => 3],
            ['payment_id' => 185, 'quater_id' => 50, 'price' => 3],
            ['payment_id' => 185, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 185, 'quater_id' => 52, 'price' => 2.38],
            ['payment_id' => 185, 'quater_id' => 53, 'price' => 3],

            ['payment_id' => 90, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 90, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 90, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 90, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 90, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 122, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 122, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 122, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 122, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 122, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 154, 'quater_id' => 33, 'price' => 0],
            ['payment_id' => 154, 'quater_id' => 34, 'price' => 0],
            ['payment_id' => 154, 'quater_id' => 35, 'price' => 0],
            ['payment_id' => 154, 'quater_id' => 36, 'price' => 0],
            ['payment_id' => 154, 'quater_id' => 37, 'price' => 0],
            ['payment_id' => 186, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 186, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 186, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 186, 'quater_id' => 52, 'price' => 0],
            ['payment_id' => 186, 'quater_id' => 53, 'price' => 0],

            ['payment_id' => 91, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 91, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 91, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 91, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 91, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 123, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 123, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 123, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 123, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 123, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 155, 'quater_id' => 33, 'price' => 0],
            ['payment_id' => 155, 'quater_id' => 34, 'price' => 0],
            ['payment_id' => 155, 'quater_id' => 35, 'price' => 0],
            ['payment_id' => 155, 'quater_id' => 36, 'price' => 0],
            ['payment_id' => 155, 'quater_id' => 37, 'price' => 0],
            ['payment_id' => 187, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 187, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 187, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 187, 'quater_id' => 52, 'price' => 0],
            ['payment_id' => 187, 'quater_id' => 53, 'price' => 0],

            ['payment_id' => 101, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 101, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 101, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 101, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 101, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 133, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 133, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 133, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 133, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 133, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 165, 'quater_id' => 33, 'price' => 3],
            ['payment_id' => 165, 'quater_id' => 34, 'price' => 3],
            ['payment_id' => 165, 'quater_id' => 35, 'price' => 1],
            ['payment_id' => 165, 'quater_id' => 36, 'price' => 3],
            ['payment_id' => 165, 'quater_id' => 37, 'price' => 3],
            ['payment_id' => 197, 'quater_id' => 49, 'price' => 4],
            ['payment_id' => 197, 'quater_id' => 50, 'price' => 3],
            ['payment_id' => 197, 'quater_id' => 51, 'price' => 3],
            ['payment_id' => 197, 'quater_id' => 52, 'price' => 3],
            ['payment_id' => 197, 'quater_id' => 53, 'price' => 3],

            ['payment_id' => 102, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 102, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 102, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 102, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 102, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 134, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 134, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 134, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 134, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 134, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 166, 'quater_id' => 33, 'price' => 0],
            ['payment_id' => 166, 'quater_id' => 34, 'price' => 0],
            ['payment_id' => 166, 'quater_id' => 35, 'price' => 2],
            ['payment_id' => 166, 'quater_id' => 36, 'price' => 0],
            ['payment_id' => 166, 'quater_id' => 37, 'price' => 0],
            ['payment_id' => 198, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 198, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 198, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 198, 'quater_id' => 52, 'price' => 0],
            ['payment_id' => 198, 'quater_id' => 53, 'price' => 0],

            ['payment_id' => 103, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 103, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 103, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 103, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 103, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 135, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 135, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 135, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 135, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 135, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 167, 'quater_id' => 33, 'price' => 0],
            ['payment_id' => 167, 'quater_id' => 34, 'price' => 0],
            ['payment_id' => 167, 'quater_id' => 35, 'price' => 0],
            ['payment_id' => 167, 'quater_id' => 36, 'price' => 0],
            ['payment_id' => 167, 'quater_id' => 37, 'price' => 0],
            ['payment_id' => 199, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 199, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 199, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 199, 'quater_id' => 52, 'price' => 0],
            ['payment_id' => 199, 'quater_id' => 53, 'price' => 0],

            ['payment_id' => 104, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 104, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 104, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 104, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 104, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 136, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 136, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 136, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 136, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 136, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 168, 'quater_id' => 33, 'price' => 0],
            ['payment_id' => 168, 'quater_id' => 34, 'price' => 0],
            ['payment_id' => 168, 'quater_id' => 35, 'price' => 0],
            ['payment_id' => 168, 'quater_id' => 36, 'price' => 0],
            ['payment_id' => 168, 'quater_id' => 37, 'price' => 3],
            ['payment_id' => 200, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 200, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 200, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 200, 'quater_id' => 52, 'price' => 0],
            ['payment_id' => 200, 'quater_id' => 53, 'price' => 0],

            ['payment_id' => 105, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 105, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 105, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 105, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 105, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 137, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 137, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 137, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 137, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 137, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 169, 'quater_id' => 33, 'price' => 0],
            ['payment_id' => 169, 'quater_id' => 34, 'price' => 0],
            ['payment_id' => 169, 'quater_id' => 35, 'price' => 0],
            ['payment_id' => 169, 'quater_id' => 36, 'price' => 0],
            ['payment_id' => 169, 'quater_id' => 37, 'price' => 91],
            ['payment_id' => 201, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 201, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 201, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 201, 'quater_id' => 52, 'price' => 0],
            ['payment_id' => 201, 'quater_id' => 53, 'price' => 137],

            ['payment_id' => 106, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 106, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 106, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 106, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 106, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 138, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 138, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 138, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 138, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 138, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 170, 'quater_id' => 33, 'price' => 0],
            ['payment_id' => 170, 'quater_id' => 34, 'price' => 0],
            ['payment_id' => 170, 'quater_id' => 35, 'price' => 0],
            ['payment_id' => 170, 'quater_id' => 36, 'price' => 0],
            ['payment_id' => 170, 'quater_id' => 37, 'price' => 37],
            ['payment_id' => 202, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 202, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 202, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 202, 'quater_id' => 52, 'price' => 0],
            ['payment_id' => 202, 'quater_id' => 53, 'price' => 20],

            ['payment_id' => 107, 'quater_id' => 1, 'price' => 0],
            ['payment_id' => 107, 'quater_id' => 2, 'price' => 0],
            ['payment_id' => 107, 'quater_id' => 3, 'price' => 0],
            ['payment_id' => 107, 'quater_id' => 4, 'price' => 0],
            ['payment_id' => 107, 'quater_id' => 5, 'price' => 0],
            ['payment_id' => 139, 'quater_id' => 17, 'price' => 0],
            ['payment_id' => 139, 'quater_id' => 18, 'price' => 0],
            ['payment_id' => 139, 'quater_id' => 19, 'price' => 0],
            ['payment_id' => 139, 'quater_id' => 20, 'price' => 0],
            ['payment_id' => 139, 'quater_id' => 21, 'price' => 0],
            ['payment_id' => 171, 'quater_id' => 33, 'price' => 0],
            ['payment_id' => 171, 'quater_id' => 34, 'price' => 0],
            ['payment_id' => 171, 'quater_id' => 35, 'price' => 0],
            ['payment_id' => 171, 'quater_id' => 36, 'price' => 0],
            ['payment_id' => 171, 'quater_id' => 37, 'price' => 0],
            ['payment_id' => 203, 'quater_id' => 49, 'price' => 0],
            ['payment_id' => 203, 'quater_id' => 50, 'price' => 0],
            ['payment_id' => 203, 'quater_id' => 51, 'price' => 0],
            ['payment_id' => 203, 'quater_id' => 52, 'price' => 0],
            ['payment_id' => 203, 'quater_id' => 53, 'price' => 0],

        ];
        foreach($items as $item)
        {
            \App\Models\Payment::create($item);
        }
    }
}