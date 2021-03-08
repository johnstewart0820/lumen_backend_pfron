<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use App\Models\OrkTeam;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\RehabitationCenter;
use App\Models\ServiceList;
use App\Models\Training;
use App\Models\TrainingClass;
use App\Models\TrainingComment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getInfo(Request $request) {
        try {
            $participant = Candidate::leftJoin('candidate_infos as ci', 'candidates.id', '=', 'ci.id_candidate')->where('status', '=', true)->where('is_participant', '=', true)
                ->selectRaw('candidates.*, ci.participant_number')->get();
            $participants_number = Candidate::leftJoin('candidate_infos as ci', 'candidates.id', '=', 'ci.id_candidate')
                ->where('status', '=', true)->where('is_participant', '=', true)
                ->selectRaw('candidates.*, ci.participant_number as participant_number, ci.participant_number as participant_name')->get();
            $participants_name = Candidate::leftJoin('candidate_infos as ci', 'candidates.id', '=', 'ci.id_candidate')->where('status', '=', true)->where('is_participant', '=', true)
                ->selectRaw('candidates.*, ci.participant_number as participant_number, candidates.name as participant_name')->get();
            $participants = [];
            foreach($participants_number as $item) {
                $participants[] = $item;
            }
            foreach($participants_name as $item) {
                $participants[] = $item;
            }

            $rehabitation_center = RehabitationCenter::all();
            $service_list = ServiceList::where('status', '=', true)->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'participant' => $participant,
                    'participants_edit' => $participants,
                    'rehabitation_center' => $rehabitation_center,
                    'service_list' => $service_list
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }

    }

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getOrkTeam(Request $request) {
        try {
            $rehabitation_center = $request->rehabitation_center;
            $ork_team = OrkTeam::where('status', '=', true)->where('rehabitation_center', '=', $rehabitation_center)->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'ork_team' => $ork_team,
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }

    }

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function get(Request $request) {
        try {
            $id = $request->input('id');
            $training = Training::find($id);
            $training_class = TrainingClass::where('id_training', '=', $id)->get();
            $ork_team = OrkTeam::where('status', '=', true)->where('rehabitation_center', '=', $training->rehabitation_center)->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'training' => $training,
                    'training_class' => $training_class,
                    'ork_team' => $ork_team
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request) {
        try {
            $training_input = $request->training;
            $participant = $request->participant;
            $training_class_input = $request->training_class;

            $training = new Training();
            $training->name = $training_input['name'];
            $training->number = $training_input['number'];
            $training->rehabitation_center = $training_input['rehabitation_center'];
            $training->service = $training_input['service'];
            $training->participant = $participant;

            if (str_contains(Auth::user()->id_role, '1')) {
                $training->training_status = $training_input['training_status'];
            } else {
                $training->training_status = '2';
            }
            $training->status = true;
            $training->save();

            $training_comment = new TrainingComment();
            $training_comment->id_training = $training['id'];
            $training_comment->description = $training_input['comment'];
            $training_comment->created_by = Auth::user()->id;
            $training_comment->save();

            for ($i = 0; $i < count($training_class_input); $i ++) {
                $training_class = new TrainingClass();
                $training_class->id_training = $training['id'];
                $training_class->name = $training_class_input[$i]['name'];
                $training_class->date = $training_class_input[$i]['date'];
                $training_class->start_hour = $training_class_input[$i]['start_hour'];
                $training_class->end_hour = $training_class_input[$i]['end_hour'];
                $training_class->break_amount = $training_class_input[$i]['break_amount'];
                $training_class->total_hour = $training_class_input[$i]['total_hour'];
                $training_class->ork_team = $training_class_input[$i]['ork_team_str'];
                $training_class->save();
            }
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => CREATE_TRAINING_SUCCESS,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request) {
        try {
            $training_input = $request->training;
            $participant = $request->participant;
            $training_class_input = $request->training_class;
            $id = $request->id;
            $training_status = '';
            if (str_contains(Auth::user()->id_role, '1')) {
                $training_status = $training_input['training_status'];
            } else {
                $training_status = '2';
            }

            Training::find($id)
                ->update([
                    'name' => $training_input['name'],
                    'number' => $training_input['number'],
                    'rehabitation_center' => $training_input['rehabitation_center'],
                    'service' => $training_input['service'],
                    'participant' => $participant,
                    'training_status' => $training_status]);

            $training_comment = new TrainingComment();
            $training_comment->id_training = $id;
            $training_comment->description = $training_input['comment'];
            $training_comment->created_by = Auth::user()->id;
            $training_comment->save();
            TrainingClass::where('id_training', '=', $id)->delete();

            for ($i = 0; $i < count($training_class_input); $i ++) {
                $training_class = new TrainingClass();
                $training_class->id_training = $id;
                $training_class->name = $training_class_input[$i]['name'];
                $training_class->date = $training_class_input[$i]['date'];
                $training_class->start_hour = $training_class_input[$i]['start_hour'];
                $training_class->end_hour = $training_class_input[$i]['end_hour'];
                $training_class->break_amount = $training_class_input[$i]['break_amount'];
                $training_class->total_hour = $training_class_input[$i]['total_hour'];
                $training_class->ork_team = $training_class_input[$i]['ork_team_str'];
                $training_class->save();
            }

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_TRAINING_SUCCESS,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    public function getListByOption(Request $request) {
        try {
            $columns = ["trainings.id", "trainings.name", "trainings.participant", "trainings.training_status", "tc.date"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');
            $searchParticipant = $request->input('searchParticipant');
            $searchTrainingStatus = $request->input('searchTrainingStatus');
            $searchScheduleDate = $request->input('searchScheduleDate');
            $query = Training::leftJoin('training_classes as tc', 'trainings.id', '=', 'tc.id_training')->where('trainings.name', 'LIKE', "%{$searchName}%")->where('status', '=', true);
            if ($searchId != '') {
                $query->where('trainings.id', '=', $searchId);
            }
            if (intval($searchParticipant) != 0) {
                $query->where('trainings.participant', 'LIKE', "%{$searchParticipant}%");
            }
            if (intval($searchTrainingStatus) != 0) {
                $query->where('trainings.training_status', '=', $searchTrainingStatus);
            }
            if ($searchScheduleDate != '') {
                $query->where('tc.date', 'LIKE', "%{$searchScheduleDate}%");
            }
            $query->selectRaw('trainings.*, tc.date, tc.id as tc_id');
            $training_count = $query->get();
            $trainings = $query
                ->groupBy('trainings.id')
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [ 'trainings' => $trainings, 'count' => count($training_count) ]
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    public function delete(Request $request) {
        try {
            $id = $request->input('id');
            Training::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_TRAINING_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
