<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    public function sendErrorValidators($message, $errorMessages) {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errorMessage' => $errorMessages
        ], 422);
    }

    public function queryAccount($id) {
        $account = DB::select("SELECT  
                users.email,
                users.username,
                admin_roles.role_name,
                ac.profile_image,
                ac.cover_image,
                ac.admin_note,
                ac.account_id,
                ac.display_name,
                ac.admin_level,
                ac.admin_status,
                ac.language,
                ac.admin_verify_at,
                ac.updated_at
            FROM users 
            INNER JOIN admin_accounts as ac ON users.id = ac.account_id 
            INNER JOIN admin_roles ON admin_roles.id = ac.admin_level
            WHERE users.id = ? ", [$id]);
        return $account;
    }

    public function getAuthUser($level = 0){
        $auth = $this->queryAccount(Auth::user()->id)[0];
        if(!$auth || $auth->admin_status !== 1) {
            return response()->json([
                'message' => 'error',
                'description' => "You have no permission"
            ], 409);
        }
        
        if($level > 0) {
            if($auth->admin_level > $level) {
                return response()->json([
                    'message' => 'error',
                    'description' => "You have no permission"
                ], 409);
            }
        }
        return $auth;
    }

    // // $set = "priority = priority+1";
    // // $where = "priority >= '".$post_priority_new."' AND category LIKE '%".$cate_id."%'";

    // public function priorityAutoUpdate($target, $tableName, $columnName, $conditions = "") { 
    //     $sql = "UPDATE {$tableName} SET {$columnName} = {$columnName} + 1 WHERE {$columnName} >= {$target} {$condition} ";
    //     return DB::update($sql,[]);
    // }

}
