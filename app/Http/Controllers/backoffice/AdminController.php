<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\backoffice\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AdminAccount;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;

class AdminController extends BaseController
{
    public function index(Request $request) {
        $user = Auth::user();
        if(!$user || $user->account_role !== "backoffice") {
            return response()->json([
                'message' => 'ok',
                'description' => 'You have no permission!'
            ], 403);
        }

        $accountProfile = AdminAccount::where('admin_status', 1)->where('account_id', $user->id)->get()->first();
        if(!$accountProfile) {
            return response()->json([
                'message' => 'ok',
                'description' => 'You have no permission.'
            ], 400);
        }
        $rows = DB::select("SELECT  users.email, users.username, admin_roles.role_name, ac.profile_image, ac.account_id, ac.display_name, ac.admin_level, ac.admin_status, ac.language, ac.admin_verify_at, ac.updated_at
                            FROM users
                            INNER JOIN admin_accounts as ac ON users.id = ac.account_id
                            INNER JOIN admin_roles ON admin_roles.id = ac.admin_level
                            WHERE ac.admin_level >= ? ", [$accountProfile->admin_level]);
        $newArr = [];
        foreach($rows as $value) {
            array_push($newArr, [
                "image" => ($value->profile_image !== null)?$value->profile_image:"",
                "token" => base64_encode($value->account_id),
                "username" => $value->username,
                "displayName" => $value->display_name,
                "email" => $value->email,
                "roleId" => $value->admin_level,
                "roleName" => $value->role_name,
                "status" => $value->admin_status,
                "languageActive" => ($value->language !== null)?$value->language:"",
                "registered" =>  ($value->admin_verify_at !== null),
                "updated_at" => $value->updated_at,
            ]);
        }
        return response()->json([
            'message' => 'ok',
            'data' => $newArr
        ]);
    }

    public function editAdminAccount(Request $request) {
        $validator = Validator::make($request->all(), [
            'token' => 'required'
        ]);
        if($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        $authUser = $this->getAuthUser();
        $params = $request->all();

        $id = base64_decode($params['token']);
        $adminAccount = AdminAccount::where('updated_at', $params['updated_at'])->where('account_id', $id)->get()->first();
        if(!$adminAccount) {
            return response()->json([
                'message' => 'error',
                'description' => 'An account has been updated a few minute ago. please refresh data!'
            ], 400);
        }

        $oldDate = date("YmdHis", strtotime($adminAccount->updated_at));
        $newData = date("YmdHis", strtotime($params['updated_at']));
        if( $oldDate !== $newData) {
            return response()->json([
                'message' => 'error',
                'description' => 'Data has been updated a few minute ago!',
            ], 400);
        }

        $adminAccount->display_name = $params['display_name'];
        $adminAccount->admin_level = ($params['role_id'] <= $authUser->admin_level)?$authUser->admin_level:$params['role_id'];
        $adminAccount->admin_status = $params['status'];
        $adminAccount->language = $params['language'];
        if($adminAccount->admin_verify_at === null){
            $adminAccount->admin_verify_at = date('Y-m-d H:i:s');
        }

        try {
            $adminAccount->save();
            return response()->json([
                'message' => 'success',
                'data' => 'Updated successfully!'
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'message' => 'error',
                'description' => "Something went wrong.",
                'error' => $e
            ], 501);
        }

    }

    public function deleteAdminAccount($language, $token) {
        $auth = $this->getAuthUser();
        $id = base64_decode($token);
        $check = AdminAccount::where('account_id', $id)->get()->first();
        if(!$check){
            return response()->json([
                'message' => 'error',
                'description' => 'Admin not found!'
            ], 409 );

        }
        if($check->admin_level < $auth->admin_level ){
            return response()->json([
                'message' => 'error',
                'description' => 'You have no permission!'
            ], 409 );
        }
        try {
            DB::beginTransaction();

            $deleteUser = User::find($check->account_id);
            $deleteUser->delete();

            $deleteAccount = AdminAccount::find($check->id);
            $deleteAccount->delete();

            DB::commit();
            return response()->json([
                'message' => 'ok',
                'description' => 'An account has been deleted.'
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'error',
                'description' => 'Something went wrong.',
            ], 501);
        }
    }
}
