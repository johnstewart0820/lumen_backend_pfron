<?php

namespace App\Http\Controllers;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\Role;
use App\Models\Specialist;
use App\Models\SpecialtyType;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
            $role = Role::all();
            $activate_status = array(['id' => 2, 'name' => 'Active'], ['id' => 1, 'name' => 'Inactive']);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'role' => $role,
                    'activate_status' => $activate_status,
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
            $user = User::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'user' => $user
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
    public function getProfile(Request $request) {
        try {

            $user = Auth::user();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'user' => $user
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
    public function updateProfile(Request $request) {
        try {
            $user = Auth::user();
            $name = $request->name;
            $email = $request->email;
            $role = $request->id_role;
            $activate_status = $request->activate_status;
            $password = $request->password;
            $newPassword = $request->newPassword;
            if ($password == '')
                User::where('id', '=', $user->id)->update(['name'=>$name, 'email' => $email, 'id_role' => $role, 'activate_status' => $activate_status]);
            else {
                if (Hash::check($password, $user->password)) {
                    User::where('id', '=', $user->id)->update(['name'=>$name, 'email' => $email, 'id_role' => $role, 'activate_status' => $activate_status, 'password' => Hash::make($newPassword)]);
                } else {
                    return response()->json([
                        'code' => BAD_REQUEST_CODE,
                        'message' => PASSWORD_INCORRECT_MESSAGE
                    ]);
                }
            }

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_USER_SUCCESS,
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
            $email = $request->email;
            $role = $request->id_role;
            $activate_status = $request->activate_status;

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->id_role = $role;
            $user->password = Hash::make('123456');
            $user->is_valid = true;
            $user->activate_status = $activate_status;
            $user->status = true;
            $user->save();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => CREATE_USER_SUCCESS,
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
            $email = $request->email;
            $role = $request->id_role;
            $activate_status = $request->activate_status;
            $id = $request->id;

            User::where('id', '=', $id)->update(['name'=>$name, 'email' => $email, 'id_role' => $role, 'activate_status' => $activate_status]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_USER_SUCCESS,
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
            $columns = ["id", "name", "id_role", "email", "activate_status"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');
            $searchRole = $request->input('searchRole');
            $searchEmail = $request->input('searchEmail');
            $searchActivateStatus = $request->input('searchActivateStatus');
            $users = [];
            $users_count = 0;
            $query = User::where('name', 'LIKE', "%{$searchName}%")->where('status', '=', true)->where('email', 'LIKE', "%{$searchEmail}%");
            if ($searchId != '') {
                $query = $query->where('id', '=', $searchId);
            }
            if (intval($searchRole) != 0) {
                $query = $query->where('id_role', '=', $searchRole);
            }
            if (intval($searchActivateStatus) != 0) {
                $query = $query->where('activate_status', '=', intval($searchActivateStatus) - 1);
            }
            $users_count = $query
                ->get();
            $users = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => ['users' => $users, 'count' => count($users_count)]
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
            User::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_USER_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
