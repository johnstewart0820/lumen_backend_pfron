<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
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
            $notification = Notification::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'notification' => $notification
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
    public function getNotificationSetting(Request $request) {
        try {
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'setting' => Auth::user()
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
    public function updateNotificationSetting(Request $request) {
        try {
            $setting = $request->setting;
            User::where('id', '=', Auth::user()->id)->update([
                'end_service_date' => $setting['end_service_date'],
                'undone_service_participant' => $setting['undone_service_participant'],
                'end_stay_participant' => $setting['end_stay_participant'],
                'amount_service_participant' => $setting['amount_service_participant']
            ]);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_NOTIFICATION_SETTING_SUCCESS,
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
    public function updateStatusNotification(Request $request) {
        try {
            $id = $request->id;

            Notification::find($id)->update(['activate_status' => true]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_NOTIFICATION_STATUS_SUCCESS,
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
            $columns = ["title", "updated_at"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchTitle = $request->input('searchTitle');
            $searchUpdatedAt = $request->input('searchUpdatedAt');

            $query = Notification::where('title', 'LIKE', "%{$searchTitle}%")
                ->where('updated_at', 'LIKE', "%{$searchUpdatedAt}%")
                ->where('status', '=', true);


            $notification_count = $query->get();
            $notifications = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [ 'notifications' => $notifications, 'count' => count($notification_count) ]
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    public function deleteNotification(Request $request) {
        try {
            $id = $request->input('id');
            Notification::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_NOTIFICATION_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
