<?php

namespace App\Http\Controllers;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\RehabitationCenter;
use App\Models\RehabitationCenterPartner;
use App\Models\RehabitationCenterQuater;
use App\Models\Specialist;
use App\Models\SpecialtyType;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;

class RehabitationCenterController extends Controller
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
    public function get(Request $request) {
        try {
            $id = $request->input('id');
            $rehabitationCenter = RehabitationCenter::find($id);
            $quaters = RehabitationCenterQuater::where('center_id', '=', $id)->get();
            $partners = RehabitationCenterPartner::where('center_id', '=', $id)->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'rehabitation_center' => $rehabitationCenter,
                    'quaters' => $quaters,
                    'partners' =>$partners
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
    public function update(Request $request) {
        try {
            $quaters = $request->quaters;
            $partners = $request->partners;
            $rehabitation_center = $request->rehabitation_center;
            $id = $request->id;
            $rehabitation_center['created_at'] = null;
            $rehabitation_center['updated_at'] = null;
            RehabitationCenter::where('id', '=', $id)->update($rehabitation_center);
            RehabitationCenterPartner::where('center_id', '=', $id)->delete();
            foreach($partners as $partner) {
                $item = new RehabitationCenterPartner();
                $item->center_id = $id;
                $item->name = $partner['name'];
                $item->nip = $partner['nip'];
                $item->regon = $partner['regon'];
                $item->save();
            }
            RehabitationCenterQuater::where('center_id', '=', $id)->delete();
            foreach($quaters as $quater) {
                $item = new RehabitationCenterQuater();
                $item->center_id = $id;
                $item->start_date = $quater['start_date'];
                $item->end_date = $quater['end_date'];
                $item->save();
            }

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_REHABITATION_CENTER_SUCCESS,
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
            $columns = ["id", "name"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');

            $rehabitationCenters = [];
            $rehabitationCentersCount = 0;
            $query = RehabitationCenter::where('name', 'LIKE', "%{$searchName}%");
            if ($searchId != '') {
                $query = $query->where('id', '=', $searchId);
            }

            $rehabitationCentersCount = $query
                ->get();
            $rehabitationCenters = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => ['rehabitation_centers' => $rehabitationCenters, 'count' => count($rehabitationCentersCount)]
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
