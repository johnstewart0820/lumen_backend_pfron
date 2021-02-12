<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\RehabitationCenter;
use App\Models\ServiceList;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
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
            $rehabitation_center = RehabitationCenter::all();
            $service = ServiceList::all();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'rehabitation_center' => $rehabitation_center,
                    'service' => $service,
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
            $payment = Payment::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'payment' => $payment
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
            $name = $request->name;
            $value = $request->value;
            $rehabitation_center = $request->rehabitation_center;
            $service = $request->service;

            $payment = new Payment();
            $payment->name = $name;
            $payment->value = $value;
            $payment->rehabitation_center = $rehabitation_center;
            $payment->service = $service;
            $payment->status = true;
            $payment->save();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => CREATE_QUALIFICATION_POINT_SUCCESS,
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
            $name = $request->name;
            $value = $request->value;
            $rehabitation_center = $request->rehabitation_center;
            $service = $request->service;
            $id = $request->id;

            Payment::find($id)->update(['name' => $name, 'value' => $value, 'rehabitation_center' =>  $rehabitation_center, 'service' =>  $service]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_QUALIFICATION_POINT_SUCCESS,
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
            $columns = ["id", "name", "value", "rehabitation_center", "service"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');
            $searchValue = $request->input('searchValue');
            $searchRehabitationCenter = $request->input('searchRehabitationCenter');
            $searchService = $request->input('searchService');
            $payments = [];
            $payments_count = [];
            $query = Payment::where('name', 'LIKE', "%{$searchName}%")->where('value', 'LIKE', "%{$searchValue}%")->where('status', '=', true);
            if ($searchId != '') {
                $query->where('id', '=', $searchId);
            }
            if (intval($searchRehabitationCenter) != 0) {
                $query->where('rehabitation_center', 'LIKE', "%{$searchRehabitationCenter}%");
            }
            if (intval($searchService) != 0) {
                $query->where('service', 'LIKE', "%{$searchService}%");
            }

            $payments_count = $query->get();

            $payments = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [ 'payments' => $payments, 'count' => count($payments_count) ]
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
            Payment::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_QUALIFICATION_POINT_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
