<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\AdminAccount;
use App\Models\LanguageAvailable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebInfosController extends Controller
{
    public function readWebInfo(Request $request) {
        $infoList = [];
        $infoDetail = [];
        $webInfos = $this->webInfoList($request->language); 
        $infoTypeArr =  $this->webInfoType($request->language); 
        // $adminLevel = AdminAccount::where('account_id', Auth::user()->id)->get()->first();
 
        try {
    
            foreach( $webInfos as $val) {  
                $infoTypeId = (int)$val->infoTypeId;  
                // if($adminLevel->admin_level > $val->admin_level) {
                //     continue;
                // }
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
