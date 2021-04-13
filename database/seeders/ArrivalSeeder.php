<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\CandidateInfo;
use App\Models\Community;
use App\Models\County;
use App\Models\Educations;
use App\Models\QualificationPoint;
use App\Models\Specialist;
use App\Models\Voivodeship;
use Illuminate\Database\Seeder;
use Rap2hpoutre\FastExcel\FastExcel;
use Storage;

class ArrivalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = (new FastExcel)->import(storage_path('/app/arrivals.xlsx'));
        foreach($collection as $item) {
            $candidate =  Candidate::where('surname', '=', $item['surname'])->where('name', '=', $item['name'])->get();
            if (count($candidate) == 0) {
                continue;
            }
            $id = $candidate[0]->id;
            CandidateInfo::where('id_candidate', '=', $id)->update(['date_referal' => $item['date']]);
            if (str_starts_with($item['content'], 'ST,')) {
                CandidateInfo::where('id_candidate', '=', $id)->update(['type_to_stay' => '1']);
                Candidate::where('id', '=', $id)->update(['stay_status' => 1]);
            }

        }
    }
}
