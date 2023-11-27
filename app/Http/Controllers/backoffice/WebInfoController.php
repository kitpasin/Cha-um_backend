<?php

namespace App\Http\Controllers\backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\backoffice\BaseController as BaseController;
use App\Models\AdminAccount;
use App\Models\LanguageAvailable;
use App\Models\WebInfo;
use App\Models\WebInfoType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Exception;
use Throwable;

class WebInfoController extends BaseController
{
    public function index(Request $request) {
        $infoList = [];
        $infoDetail = [];
        $webInfos = $this->webInfoList($request->language); 
        $infoTypeArr =  $this->webInfoType($request->language); 
        $adminLevel = AdminAccount::where('account_id', Auth::user()->id)->get()->first();
 
        try {
    
            foreach( $webInfos as $val) {  
                $infoTypeId = (int)$val->infoTypeId;  
                if($adminLevel->admin_level > $val->admin_level) {
                    continue;
                }
                if($infoTypeId === 1) {
                    array_push($infoDetail, $val);
                }
                 
                array_push($infoList, [
                    "id" => $val->id,
                    "token" => base64_encode($val->id),
                    "attribute" => ($val->attribute)?$val->attribute:"",
                    "description" => ($val->description)?$val->description:"",
                    "param" => ($val->param)?$val->param:"",
                    "link" => ($val->link)?$val->link:"",
                    "iframe" => ($val->iframe)?$val->iframe:"",
                    "value" => ($val->value)?$val->value:"",
                    "display" => ($val->display === 1),
                    "infoTypeName" => $val->infoTypeName,
                    "infoTypeTitle" => $val->infoTypeTitle,
                    "infoTypeId" => $infoTypeId,
                    "language" => $val->language,
                    "priority" => $val->priority,
                    "isDetail" => ($infoTypeId === 1),
                ]);
            }
         
            $webSiteLanguages = LanguageAvailable::select('abbv_name','name')->orderBy('defaults', 'DESC')->get()->all();
            $setDetails = $this->infoSetting($infoDetail);

            return response()->json([
                'data' => [
                    'details' => $setDetails->detail,
                    'languages' => $webSiteLanguages, 
                    'info' => $infoList,  
                    'infoType' => $infoTypeArr
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "error",
                'description' => "Something went wrong."
            ], 501);
        }
    }

    public function updateWebDetails(Request $request) {
        $files = $request->allFiles();
        $params = $request->all();
        $validator = Validator::make($request->all(),[
            "webNameToken" => "required",
            "webNameValue" => "required",
            "extraNameToken" => "",
            "extraNameValue" => "",
            "companyNameToken" => "",
            "companyNameValue" => "",
            "language" => "required",
            "image_1" => "mimes:jpg,png,jpeg|max:2048",
            "image_2" => "mimes:jpg,png,jpeg|max:2048",
            'image_3.*' => 'mimes:jpg,png,jpeg|max:2048',
            'image_4' => "mimes:jpg,png,jpeg|max:2048",
            'favicon' => "mimes:jpg,png,jpeg,ico|max:256",
            'web_desc' => "max:501",
        ]);
        if($validator->fails()){
            return response([
                'message' => 'error',
                'description' => "invalid parameters",
                'info' => $validator->errors()->first()
            ],422);
        }
        $newFolder = "upload/".date('Y')."/".date('m')."/".date('d')."/";
        $img = array();
        $img['image_1'] = (isset($files['image_1']))? $this->uploadImage($newFolder, $files['image_1'],"1",0):"";
        $img['image_2'] = (isset($files['image_2']))? $this->uploadImage($newFolder, $files['image_2'],"2",0):"";
        $img['image_3'] = (isset($files['image_3']))? $this->uploadImage($newFolder, $files['image_3'],"3",0):"";
        $img['image_4'] = (isset($files['image_4']))? $this->uploadImage($newFolder, $files['image_4'],"4",0):"";
        $img['favicon'] = (isset($files['favicon']))? $this->uploadImage($newFolder, $files['favicon'],"5",0):""; 

        /* Set SQL Updates */
        $infoLink = "";
        foreach($img as $key => $value) {
            $setVal = ($value != "")?"'{$value}'":"info_link";
            $infoLink .= " WHEN info_param = '{$key}' THEN {$setVal} ";
        }
        $infoLinkSQL = ($infoLink != "")? " , info_link = (case {$infoLink} end) ": "";
        $sql = "UPDATE web_infos SET info_value = (case 
                    when info_param = 'webname' then :webname
                    when info_param = 'extraname' then :extraname
                    when info_param = 'companyname' then :companyname
                end) {$infoLinkSQL} WHERE info_type = 1 AND language =  :lang "; 

        try {
            DB::update($sql, [
                ":webname" => $params['webNameValue'],
                ":extraname" => $params['extraNameValue'],
                ":companyname" => $params['companyNameValue'],
                ":lang" =>  $params['language']
            ]);

            return response()->json([
                'message' => 'ok',
                'description' => "Web info has been updated successfully.",
                'images' =>  $img
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => "Something went wrong.",
                'errorsMessage' => $e->getMessage()
            ],501);
        }   
    }

    public function deleteImage($language, $position) {
        try {    
            $info = WebInfo::where("info_param", $position)->where('language', $language)->get()->first();
             
            if(!$info) {
                return response([
                    'message' => 'error',
                    'description' => 'Can not find image.'
                ], 400);
            }
            
            DB::beginTransaction();
            WebInfo::where("info_param", $position)->where('language', $language)->update([
                "info_link" => "",
                "updated_at" => date('Y-m-d H:i:s')
            ]);
         
            DB::commit();

            return response([
                'message' => 'success',
                'description' => 'Image has been deleted successfully.',
                'image' => $position
            ]);


        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => "error",
                'description' => "Something went wrong.",
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function createWebInfo(Request $request) {
        $validator = Validator::make($request->all(),[
            'param_name' => 'required|max:255',
            'title' => 'required|string|max:255',
            'priority' => 'required|integer',
            'display' => 'required|integer',
            'language' => 'required|string|max:10',
            'infoType' => 'required|integer'
        ]);

        if($validator->fails()){
            return response([
                'message' => 'error',
                'description' => "invalid parameters",
                'info' => $validator->errors()->first()
            ],422);
        }

        $params = $request->all();

        $webInfoCheck = WebInfo::where('info_param', $params['param_name'])->get()->first();
        if($webInfoCheck) {
            return response()->json([
                'message' => 'error',
                'description' => 'Duplicate parameter!'
            ], 409);
        }
        try {
            WebInfo::create([
                'info_type' => $params['infoType'],
                'info_param' => $params['param_name'],
                'info_title' => $params['title'],
                'info_value' => $params['value'],
                'info_link' => $params['link'],
                'info_iframe' => $params['iframe'],
                'info_attribute' => $params['attribute'],
                'info_priority' => $params['priority'],
                'info_display' => ((int)$params['display'] === 1)?1:0,
                'language' => $params['language'],
                'admin_level' => 3,
                'defaults' => 1,
            ], Response::HTTP_CREATED);

            return response()->json([
                'message' => 'ok',
                'description' => "Webinfo has been created."
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => "Something went wrong.",
                'errorsMessage' => $e->getMessage()
            ], 501);
        }

    }

    public function editWebInfo(Request $request, $token) {
        $validator = Validator::make($request->all(),[
            'token' => 'required|max:50',
            'param_name' => 'required|max:255',
            'title' => 'required|string|max:255',
            'priority' => 'required|integer',
            'display' => 'required|integer',
            'language' => 'required|string|max:10',
            'infoType' => 'required|integer'
        ]);
        if($validator->fails()){
            return response([
                'message' => 'error',
                'description' => "invalid p arameters",
                'info' => $validator->errors()->first()
            ],422);
        }
        try {

            WebInfo::where('info_id', base64_decode($request->token))->where('language', $request->language)->update([
                'info_title' => $request->title,
                'info_value' => $request->value,
                'info_link' => $request->link,
                'info_iframe' => $request->iframe,
                'info_attribute' => $request->attribute,
                'info_priority' => $request->priority,
                'info_display' => ((int)$request->display === 1)?1:0,
            ]);

            return response()->json([
                'message' => 'ok',
                'description' => "Webinfo has been updated."
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => "Something went wrong.",
            ], 501);
        }

    }

    public function addWebInfo(Request $request, $token) {
        $validator = Validator::make($request->all(),[
            'token' => 'required|max:50',
            'param_name' => 'required|max:255',
            'title' => 'required|string|max:255',
            'priority' => 'required|integer',
            'display' => 'required|integer',
            'language' => 'required|string|max:10',
            'infoType' => 'required|integer'
        ]);

        if($validator->fails()){
            return response([
                'message' => 'error',
                'description' => "invalid parameters",
                'info' => $validator->errors()->first()
            ],422);
        }

        $params = $request->all();
        $webInfoCheck = WebInfo::where('info_id', '!=', base64_decode($params['token']))->where('info_param', $params['param_name'])->get()->first();
        if($webInfoCheck) {
            return response()->json([
                'message' => 'error',
                'description' => 'Duplicate parameter!'
            ], 409);
        }
        try {
            WebInfo::create([
                'info_id'=> base64_decode($params['token']),
                'info_type' => $params['infoType'],
                'info_param' => $params['param_name'],
                'info_title' => $params['title'],
                'info_value' => $params['value'],
                'info_link' => $params['link'],
                'info_iframe' => $params['iframe'],
                'info_attribute' => $params['attribute'],
                'info_priority' => $params['priority'],
                'info_display' => ((int)$params['display'] === 1)?1:0,
                'language' => $params['language'],
                'admin_level' => 3,
                'defaults' => 0,
            ], Response::HTTP_CREATED);

            return response()->json([
                'message' => 'ok',
                'description' => "Webinfo has been created."
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => "Something went wrong.",
            ], 501);
        }

    }

    public function toggleDisplayByToken(Request $request){
        $validator = Validator::make($request->all(),[
            'token' => 'required|max:20',
            'language' => 'required|max:20',
        ]);

        if($validator->fails()){
            return response([
                'message' => 'error',
                'description' => "invalid parameters",
                'info' => $validator->errors()->first()
            ],422);
        }
        try {
            $updateDisplay = WebInfo::where('info_id', base64_decode($request->token))->where('language', $request->language)->get()->first();
            if(!$updateDisplay) {
                return response()->json([
                    'message' => 'error',
                    'description' => 'Invalid webinfo token.'
                ], 400);
            }
            
            WebInfo::where('info_id', base64_decode($request->token))->where('language', $request->language)->update([
                'info_display' => ($updateDisplay->info_display === 1)? 0:1
            ]);

            return response()->json([
                'message' => 'success',
                'descipriotn'=> 'Display has been changed!', 
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => 'Something went wrong.',
            ], 501);
        }
    }

    public function deleteWebInfoByInfoId($language, $token) {
 
        try {
            $id = base64_decode($token);
            $adminLevel = AdminAccount::where('account_id', Auth::user()->id)->get()->first();
            $deleted = WebInfo::where('info_id', $id)->where('language', $language)->where('admin_level', '>=', $adminLevel->admin_level)->delete();
            if(!$deleted) {
                return response()->json([
                    'message' => 'ok',
                    'description' => 'Web info was not delete!',
                ], 400);  
            }

            return response()->json([
                'message' => 'ok',
                'description' => 'Web info has been deleted.',
                'status' => $deleted
            ]);

        } catch (Exception $e) {

            return response()->json([
                'message' => 'error',
                'description' => 'Something went wrong.',
            ], 501);
        }
     
    }


    /* function */
    private function webInfoList($language) {
        /* custom select by infoTypeId */
        $sql = "SELECT * FROM (
            SELECT 
                i.info_id as id,
                i.admin_level,
                i.created_at,
                i.defaults,
                i.info_attribute as attribute,
                i.info_display as display,
                i.info_link as link,
                i.info_iframe as iframe,
                i.info_param as param,
                i.info_priority as priority,
                i.info_title as description,
                i.info_value as value,
                i.language as language,
                i.updated_at,
                i.info_type as infoTypeId,
                t.type_name as infoTypeName,
                t.title as infoTypeTitle
            FROM `web_infos` as i 
            INNER JOIN web_info_types as t ON i.info_type = t.id  
            WHERE i.language = :lang OR i.defaults = 1 
            order by i.defaults ASC
        ) as webinfo GROUP BY id ";
        return DB::select($sql, [':lang' => $language]);
    }

    private function webInfoType($language) {
        $sql = "SELECT id, type_name as typeName, title  FROM web_info_types WHERE language = :lang OR defaults = 1 GROUP BY id ORDER BY defaults ASC, id ASC";
        return DB::select($sql, [":lang" => $language]);
    }
}

 