<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RehabitationCenterQuaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'center_id' => 1, 'start_date' => '2019-09-02', 'end_date' => '2019-12-01'],
            ['id' => 2, 'center_id' => 1, 'start_date' => '2019-12-02', 'end_date' => '2020-03-01'],
            ['id' => 3, 'center_id' => 1, 'start_date' => '2020-03-02', 'end_date' => '2020-06-01'],
            ['id' => 4, 'center_id' => 1, 'start_date' => '2020-06-02', 'end_date' => '2020-09-01'],
            ['id' => 5, 'center_id' => 1, 'start_date' => '2020-09-02', 'end_date' => '2020-12-01'],
            ['id' => 6, 'center_id' => 1, 'start_date' => '2020-12-02', 'end_date' => '2021-03-01'],
            ['id' => 7, 'center_id' => 1, 'start_date' => '2021-03-02', 'end_date' => '2021-06-01'],
            ['id' => 8, 'center_id' => 1, 'start_date' => '2021-06-02', 'end_date' => '2021-09-01'],
            ['id' => 9, 'center_id' => 1, 'start_date' => '2021-09-02', 'end_date' => '2021-12-01'],
            ['id' => 10, 'center_id' => 1, 'start_date' => '2021-12-02', 'end_date' => '2022-03-01'],
            ['id' => 11, 'center_id' => 1, 'start_date' => '2022-03-02', 'end_date' => '2022-06-01'],
            ['id' => 12, 'center_id' => 1, 'start_date' => '2022-06-02', 'end_date' => '2022-09-01'],
            ['id' => 13, 'center_id' => 1, 'start_date' => '2022-09-02', 'end_date' => '2022-12-01'],
            ['id' => 14, 'center_id' => 1, 'start_date' => '2022-12-02', 'end_date' => '2023-03-01'],
            ['id' => 15, 'center_id' => 1, 'start_date' => '2023-03-02', 'end_date' => '2023-06-01'],
            ['id' => 16, 'center_id' => 1, 'start_date' => '2023-06-02', 'end_date' => '2023-09-01'],

            ['id' => 17, 'center_id' => 2, 'start_date' => '2019-09-17', 'end_date' => '2019-12-16'],
            ['id' => 18, 'center_id' => 2, 'start_date' => '2019-12-17', 'end_date' => '2020-03-16'],
            ['id' => 19, 'center_id' => 2, 'start_date' => '2020-03-17', 'end_date' => '2020-06-16'],
            ['id' => 20, 'center_id' => 2, 'start_date' => '2020-06-17', 'end_date' => '2020-09-16'],
            ['id' => 21, 'center_id' => 2, 'start_date' => '2020-09-17', 'end_date' => '2020-12-16'],
            ['id' => 22, 'center_id' => 2, 'start_date' => '2020-12-17', 'end_date' => '2021-03-16'],
            ['id' => 23, 'center_id' => 2, 'start_date' => '2021-03-17', 'end_date' => '2021-06-16'],
            ['id' => 24, 'center_id' => 2, 'start_date' => '2021-06-17', 'end_date' => '2021-09-16'],
            ['id' => 25, 'center_id' => 2, 'start_date' => '2021-09-17', 'end_date' => '2021-12-16'],
            ['id' => 26, 'center_id' => 2, 'start_date' => '2021-12-17', 'end_date' => '2022-03-16'],
            ['id' => 27, 'center_id' => 2, 'start_date' => '2022-03-17', 'end_date' => '2022-06-16'],
            ['id' => 28, 'center_id' => 2, 'start_date' => '2022-06-17', 'end_date' => '2022-09-16'],
            ['id' => 29, 'center_id' => 2, 'start_date' => '2022-09-17', 'end_date' => '2022-12-16'],
            ['id' => 30, 'center_id' => 2, 'start_date' => '2022-12-17', 'end_date' => '2023-03-16'],
            ['id' => 31, 'center_id' => 2, 'start_date' => '2023-03-17', 'end_date' => '2023-06-16'],
            ['id' => 32, 'center_id' => 2, 'start_date' => '2023-06-17', 'end_date' => '2023-09-16'],

            ['id' => 33, 'center_id' => 3, 'start_date' => '2019-09-08', 'end_date' => '2019-12-07'],
            ['id' => 34, 'center_id' => 3, 'start_date' => '2019-12-08', 'end_date' => '2020-03-07'],
            ['id' => 35, 'center_id' => 3, 'start_date' => '2020-03-08', 'end_date' => '2020-06-07'],
            ['id' => 36, 'center_id' => 3, 'start_date' => '2020-06-08', 'end_date' => '2020-09-07'],
            ['id' => 37, 'center_id' => 3, 'start_date' => '2020-09-08', 'end_date' => '2020-12-07'],
            ['id' => 38, 'center_id' => 3, 'start_date' => '2020-12-08', 'end_date' => '2021-03-07'],
            ['id' => 39, 'center_id' => 3, 'start_date' => '2021-03-08', 'end_date' => '2021-06-07'],
            ['id' => 40, 'center_id' => 3, 'start_date' => '2021-06-08', 'end_date' => '2021-09-07'],
            ['id' => 41, 'center_id' => 3, 'start_date' => '2021-09-08', 'end_date' => '2021-12-07'],
            ['id' => 42, 'center_id' => 3, 'start_date' => '2021-12-08', 'end_date' => '2022-03-07'],
            ['id' => 43, 'center_id' => 3, 'start_date' => '2022-03-08', 'end_date' => '2022-06-07'],
            ['id' => 44, 'center_id' => 3, 'start_date' => '2022-06-08', 'end_date' => '2022-09-07'],
            ['id' => 45, 'center_id' => 3, 'start_date' => '2022-09-08', 'end_date' => '2022-12-07'],
            ['id' => 46, 'center_id' => 3, 'start_date' => '2022-12-08', 'end_date' => '2023-03-07'],
            ['id' => 47, 'center_id' => 3, 'start_date' => '2023-03-08', 'end_date' => '2023-06-07'],
            ['id' => 48, 'center_id' => 3, 'start_date' => '2023-06-08', 'end_date' => '2023-09-07'],

            ['id' => 49, 'center_id' => 4, 'start_date' => '2019-09-23', 'end_date' => '2019-12-22'],
            ['id' => 50, 'center_id' => 4, 'start_date' => '2019-12-23', 'end_date' => '2020-03-22'],
            ['id' => 51, 'center_id' => 4, 'start_date' => '2020-03-23', 'end_date' => '2020-06-22'],
            ['id' => 52, 'center_id' => 4, 'start_date' => '2020-06-23', 'end_date' => '2020-09-22'],
            ['id' => 53, 'center_id' => 4, 'start_date' => '2020-09-23', 'end_date' => '2020-12-22'],
            ['id' => 54, 'center_id' => 4, 'start_date' => '2020-12-23', 'end_date' => '2021-03-22'],
            ['id' => 55, 'center_id' => 4, 'start_date' => '2021-03-23', 'end_date' => '2021-06-22'],
            ['id' => 56, 'center_id' => 4, 'start_date' => '2021-06-23', 'end_date' => '2021-09-22'],
            ['id' => 57, 'center_id' => 4, 'start_date' => '2021-09-23', 'end_date' => '2021-12-22'],
            ['id' => 58, 'center_id' => 4, 'start_date' => '2021-12-23', 'end_date' => '2022-03-22'],
            ['id' => 59, 'center_id' => 4, 'start_date' => '2022-03-23', 'end_date' => '2022-06-22'],
            ['id' => 60, 'center_id' => 4, 'start_date' => '2022-06-23', 'end_date' => '2022-09-22'],
            ['id' => 61, 'center_id' => 4, 'start_date' => '2022-09-23', 'end_date' => '2022-12-22'],
            ['id' => 62, 'center_id' => 4, 'start_date' => '2022-12-23', 'end_date' => '2023-03-22'],
            ['id' => 63, 'center_id' => 4, 'start_date' => '2023-03-23', 'end_date' => '2023-06-22'],
            ['id' => 64, 'center_id' => 4, 'start_date' => '2023-06-23', 'end_date' => '2023-09-22'],
        ];
        foreach($items as $item)
        {
            \App\Models\RehabitationCenterQuater::create($item);
        }
    }
}
