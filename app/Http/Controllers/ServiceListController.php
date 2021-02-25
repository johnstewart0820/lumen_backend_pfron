<?php

namespace App\Http\Controllers;
use App\Models\Module;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\ServiceList;
use App\Models\ServiceListType;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;

class ServiceListController extends Controller
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
            $modules = Module::all();
            $units = Unit::all();
            $types = ServiceListType::all();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'modules' => $modules,
                    'units' => $units,
                    'types' => $types,
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
            $service_list = ServiceList::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
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
    public function create(Request $request) {
        try {
            $name = $request->name;
            $number = $request->number;
            $module = $request->module;
            $type = $request->type;
            $amount_usage = $request->amount_usage;
            $unit = $request->unit;
            $amount_takes = $request->amount_takes;
            $is_required = $request->is_required;
            $not_applicable = $request->not_applicable;

            $service = new ServiceList();
            $service->name = $name;
            $service->number = $number;
            $service->module = $module;
            $service->type = $type;
            $service->amount_usage = $amount_usage;
            $service->unit = $unit;
            $service->amount_takes = $amount_takes;
            $service->is_required = $is_required;
            $service->not_applicable = $not_applicable;
            $service->status = true;
            $service->save();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => CREATE_SERVICE_SUCCESS,
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
            $number = $request->number;
            $module = $request->module;
            $type = $request->type;
            $amount_usage = $request->amount_usage;
            $unit = $request->unit;
            $amount_takes = $request->amount_takes;
            $is_required = $request->is_required;
            $not_applicable = $request->not_applicable;
            $id = $request->id;

            ServiceList::where('id', '=', $id)->update(['name'=>$name, 'number' => $number, 'module' => $module, 'type' => $type, 'amount_usage' => $amount_usage, 'unit' => $unit, 'amount_takes' => $amount_takes, 'is_required' => $is_required, 'not_applicable' => $not_applicable]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_SERVICE_SUCCESS,
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
            $columns = ["id", "number", "name", "module", "unit"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchNumber = $request->input('searchNumber');
            $searchName = $request->input('searchName');
            $searchModule = $request->input('searchModule');
            $searchUnit = $request->input('searchUnit');

            $service_lists = [];
            $service_lists_count = 0;
            $query = ServiceList::where('name', 'LIKE', "%{$searchName}%")->where('status', '=', true);
            if ($searchId != '') {
                $query = $query->where('id', '=', $searchId);
            }
            if (intval($searchNumber) != 0) {
                $query = $query->where('number', '=', $searchNumber);
            }
            if (intval($searchModule) != 0) {
                $query = $query->where('module', '=', $searchModule);
            }
            if (intval($searchUnit) != 0) {
                $query = $query->where('unit', '=', $searchUnit);
            }
            $service_lists_count = $query
                ->get();
            $service_lists = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => ['service_list' => $service_lists, 'count' => count($service_lists_count)]
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
            ServiceList::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_SERVICE_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
