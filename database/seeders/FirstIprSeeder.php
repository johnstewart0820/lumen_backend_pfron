<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\CandidateInfo;
use App\Models\Community;
use App\Models\County;
use App\Models\Educations;
use App\Models\Ipr;
use App\Models\IprPlan;
use App\Models\IprSchedule;
use App\Models\QualificationPoint;
use App\Models\RehabitationCenterQuater;
use App\Models\Specialist;
use App\Models\Voivodeship;
use Carbon\Traits\Date;
use Illuminate\Database\Seeder;
use Rap2hpoutre\FastExcel\FastExcel;
use Storage;

class FirstIprSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = (new FastExcel)->import(storage_path('/app/iprs/1/iprs.xlsx'));
        foreach($collection as $item) {
            $participant_number = str_replace(' ', '', $item['id']);
            if (!$participant_number)
                continue;
            $candidate_list = CandidateInfo::where('participant_number', '=', $participant_number)->get();
            if (count($candidate_list) === 0) {
                Storage::append('ipr_error.txt', 'participant_number => '.$participant_number);
                continue;
            }
            $id_candidate = $candidate_list[0]->id_candidate;
            $date = $candidate_list[0]->date_referal;
            $ipr = new Ipr();
            $ipr->id_candidate = $id_candidate;
            $ipr->ipr_type = 3;
            $ipr->status = 1;
            $ipr->number = 1;
            $ipr->id_ork_person = 0;
            $ipr->profession = '';
            $ipr->schedule_date = $date;
            $ipr->save();
            $id_ipr = $ipr->id;
            for ($i = 12; $i <= 34; $i ++) {
                if (!isset($item[strval($i)]))
                    continue;
                $ipr_plan = new IprPlan();
                $ipr_plan->id_ipr = $id_ipr;
                $ipr_plan->id_service =  $i;
                $ipr_plan->amount = $item[strval($i)];
                $ipr_plan->save();
            }
        }
        $arr = ['week_1.xlsx', 'week_2.xlsx', 'week_3.xlsx', 'week_4.xlsx', 'week_5.xlsx'];
        for ($i = 0; $i < 5; $i ++ ){
            $collection_schedule = (new FastExcel)->import(storage_path('/app/iprs/1/'.$arr[$i]));
            foreach($collection_schedule as $item) {
                $participant_number = str_replace(' ', '', $item['id']);
                if (!$participant_number)
                    continue;
                $candidate_list = CandidateInfo::where('participant_number', '=', $participant_number)->get();
                if (count($candidate_list) === 0) {
                    Storage::append('ipr_error.txt', 'participant_number => '.$participant_number);
                    continue;
                }
                $id_candidate = $candidate_list[0]->id_candidate;
                $rehabitation_center_quaters = RehabitationCenterQuater::where('center_id', '=', 1)->get();
                $id_ipr= Ipr::where('id_candidate', '=', $id_candidate)->where('ipr_type', '=', 3)->first()->id;
                for ($j = 1; $j <= 40; $j ++) {
                    $ipr_schedule = new IprSchedule();
                    $ipr_schedule->id_ipr = $id_ipr;
                    $ipr_schedule->id_service = $j;
                    $ipr_schedule->status = 0;
                    if ($candidate_list[0]->date_referal < $rehabitation_center_quaters[$i]->start_date)
                        $ipr_schedule->date = $rehabitation_center_quaters[$i]->start_date;
                    else
                        $ipr_schedule->date = $candidate_list[0]->date_referal;
                    $ipr_schedule->total_amount = $item[strval($j)];
                    $ipr_schedule->save();

                }
            }
        }

    }
}
