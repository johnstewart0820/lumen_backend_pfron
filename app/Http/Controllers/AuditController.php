<?php

namespace App\Http\Controllers;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\Specialist;
use App\Models\SpecialtyType;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;
use App\Models\Module;
use App\Models\OrkTeam;
use App\Models\Payment;
use App\Models\RehabitationCenter;
use App\Models\Role;
use App\Models\ServiceList;
use App\Models\Specialization;
use App\Models\Stage;
use App\Models\Unit;
use Illuminate\Support\Carbon;
use Symfony\Component\CssSelector\Node\Specificity;

class AuditController extends Controller
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
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'roles'                => Role::all(),
                    'types'                => QualificationPointType::all(),
                    'ambassadors'          => User::where('id_role', '=', 2)->where('status', '=', 1)->get(),
                    'qualification_points' => QualificationPoint::all(),
                    'stages'               => Stage::all(),
                    'ork_teams'            => OrkTeam::all(),
                    'specializations'      => Specialization::all(),
                    'rehabitation_centers' => RehabitationCenter::all(),
                    'specialists'          => Specialist::all(),
                    'speciality_types'     => SpecialtyType::all(),
                    'service_lists'        => ServiceList::all(),
                    'units'                => Unit::all(),
                    'modules'              => Module::all(),
                    'payments'             => Payment::all(),
                    'users'                => User::all(),
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
            $audit = Audit::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'audit' => $audit
                ]
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
            $columns = ["id", "name", "type", "ambassador"];
            $sort_column = $request->input('sort_column');
            $sort_order  = $request->input('sort_order');
            $count = $request->input('count');
            $page  = $request->input('page');
            $searchId       = $request->input('searchId');
            $searchUserName = $request->input('searchUserName');
            $searchRole     = $request->input('searchRole');
            $searchDate     = $request->input('searchDate');
            $searchEvent    = $request->input('searchEvent');
            $query = Audit::query();
            $query->where(function($query) {
                $query->where('tags->deleted', false)->orWhere('tags->deleted', null);
            });
            if ($searchId != '') {
                $query->where('id', '=', $searchId);
            }
            if (!empty($searchUserName)) {
                $query->whereHas('user', function ($query) use ($searchUserName) {
                    return $query->where('name', 'LIKE', "%{$searchUserName}%");
                });
            }
            if (intval($searchRole) != 0) {
                $query->whereHas('user', function ($query) use ($searchRole) {
                    return $query->where('id_role', '=', $searchRole);
                });
            }
            if (!empty($searchDate)) {
                $query->whereDate('created_at', '=', $searchDate);
            }
            if (!empty($searchEvent)) {
                $query->where('event', '=', $searchEvent);
            }
            $audits = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            $audits->each->makeHidden(['user_type', 'url', 'tags'])->each->setAppends([ 'user', 'role', 'changes' ]);

            return response()->json([
                'code'    => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data'    => ['audits' => $audits, 'count' => $audits->count()]
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code'    => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE,
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function delete(Request $request) {
        try {
            $id = $request->input('id');
            Audit::where('id', '=', $id)->update(['tags' => ['deleted' => true]]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => "???",
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
