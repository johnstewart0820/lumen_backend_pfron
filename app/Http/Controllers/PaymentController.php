<?php

namespace App\Http\Controllers;
use App\Models\FlatRate;
use App\Models\Payment;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\RehabitationCenter;
use App\Models\RehabitationCenterQuater;
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
            $service = ServiceList::selectRaw('CONCAT(name, " (Numer: ", number, " )") as name, id')->get();
            $service_list = ServiceList::all();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'rehabitation_center' => $rehabitation_center,
                    'service' => $service,
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

    public function getQuaterList(Request $request) {
        try {
            $rehabitation_center = $request->rehabitation_center;
            $quater_list = RehabitationCenterQuater::where('center_id', '=', $rehabitation_center)->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'quater_list' => $quater_list,
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
            $flat_list = FlatRate::where('payment_id', '=', $id)->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'payment' => $payment,
                    'flat_rate' => $flat_list
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
            $value = $request->value;
            $rehabitation_center = $request->rehabitation_center;
            $service = $request->service;
            $pricelist_amount = $request->pricelist_amount;
            $pricelist_cost = $request->pricelist_cost;
            $is_flatrate_service = $request->is_flatrate_service;
            $value_list = $request->value_list;

            $payment = new Payment();
            $payment->value = $value;
            $payment->rehabitation_center = $rehabitation_center;
            $payment->service = $service;
            $payment->pricelist_amount = $pricelist_amount;
            $payment->pricelist_cost = $pricelist_cost;
            $payment->is_flatrate_service = $is_flatrate_service;
            $payment->status = true;
            $payment->save();

            foreach($value_list as $item) {
                $flat_rate = new FlatRate();
                $flat_rate->payment_id = $payment->id;
                $flat_rate->quater_id = $item['quater'];
                $flat_rate->price = $item['value'];
                $flat_rate->save();
            }
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
            $value = $request->value;
            $rehabitation_center = $request->rehabitation_center;
            $service = $request->service;
            $pricelist_amount = $request->pricelist_amount;
            $pricelist_cost = $request->pricelist_cost;
            $is_flatrate_service = $request->is_flatrate_service;
            $value_list = $request->value_list;

            $id = $request->id;

            Payment::find($id)->update([ 'value' => $value,
                'rehabitation_center' =>  $rehabitation_center,
                'service' =>  $service,
                'pricelist_amount' => $pricelist_amount,
                'pricelist_cost' => $pricelist_cost,
                'is_flatrate_service' => $is_flatrate_service
            ]);

            FlatRate::where('payment_id', '=', $id)->delete();

            foreach($value_list as $item) {
                $flat_rate = new FlatRate();
                $flat_rate->payment_id = $id;
                $flat_rate->quater_id = $item['quater'];
                $flat_rate->price = $item['value'];
                $flat_rate->save();
            }

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
            $columns = ["service_lists.number", "name", "value", "rehabitation_center", "service"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchValue = $request->input('searchValue');
            $searchRehabitationCenter = $request->input('searchRehabitationCenter');
            $searchService = $request->input('searchService');
            $payments = [];
            $payments_count = [];
            $query = Payment::leftJoin('service_lists', 'payments.service', '=', 'service_lists.id')->where('value', 'LIKE', "%{$searchValue}%")->where('payments.status', '=', true);
            if ($searchId != '') {
                $query->where('service_lists.number', 'LIKE', "%{$searchId}%");
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
                ->selectRaw('payments.*, service_lists.number')
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
            FlatRate::where('payment_id', '=', $id)->delete();

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
