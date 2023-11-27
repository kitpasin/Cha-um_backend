<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\backoffice\BaseController as BaseController;
use App\Models\AdSlide;
use App\Models\AdSlidePosition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SlideController extends BaseController
{
    public function index(Request $request) {
        try {
            $slideData = $this->getSlideList($request->language); 
            $sliedPos = AdSlidePosition::orderBy('position','ASC')->get()->all();
            $positionList = [];
            foreach( $sliedPos as $val){
                array_push($positionList, [
                    "id" => $val->id,
                    "title" => $val->position  . " ({$val->dimension})" ,
                ]);
            }
            return response([
                'message' => 'ok',
                'data' => $slideData,
                'positionList' => $positionList
            ]);
        } catch (Exception $e) { 
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function getSlideById(Request $req) {
        try {
            $data = AdSlide::where("id",$req->id)->get()->first();
            return response([
                'message' => 'ok',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function createSlide(Request $req) {
        $this->getAuthUser();
        $files = $req->allFiles();
        $params = $req->all();
        $validator = Validator::make($req->all(), [ 
            'image' => "mimes:jpg,png,jpeg|max:5120|nullable",
            'imageName' => 'string|nullable',
            'imageTitle' => 'string|nullable',
            'imageAlt' => 'string|nullable',
            'title' => 'string|nullable',
            'description' => 'string|nullable',
            'h1' => 'string|nullable',
            'h2' => 'string|nullable',
            'type' => 'required|numeric',
            'link' => 'string|nullable',
            'redirect' => 'string|nullable',
            'positionId' => 'numeric',
            'display' => 'required|numeric',
            'pageId' => 'numeric',
            'priority' => 'required|numeric',
            'language' => 'required|string|nullable',
            'dateDisplay' => 'string|nullable',
            'dateHidden' => 'string|nullable',
        ]); 
        if($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        try {

            /* Update Position */
            $priority = (int)$params['priority'];
            $this->prioritySlideUpdate(99999999,$params['priority'], $params['language']);
            
            
            /* Upload Image */
            $newFolder = "upload/".date('Y')."/".date('m')."/".date('d')."/";
            $imgSrc = (isset($files['image']))? $this->uploadImage($newFolder, $files['image'], "", "", $params['imageName']):"";
            
            $creating = new AdSlide();
            $creating->ad_image = $imgSrc;
            $creating->ad_image_alt = $params['imageAlt'];
            $creating->ad_image_title =  $params['imageTitle'];
            $creating->ad_title = $params['title'];
            $creating->ad_description = $params['description'];
            $creating->ad_h1 = $params['h1'];
            $creating->ad_h2 = $params['h2'];
            $creating->ad_type = $params['type'];
            $creating->ad_link = $params['link'];
            $creating->ad_redirect = $params['redirect'];
            $creating->ad_position_id = $params['positionId'];
            $creating->ad_priority = $priority;
            $creating->page_id = $params['pageId'];
            $creating->language = $params['language']; 
            $creating->ad_status_display = ($params['display'] == 1)?1:0;
            $creating->defaults = true;
            $creating->ad_date_display = ($params['dateDisplay'] !== null)?date('Y-m-d H:i',strtotime($params['dateDisplay'])):null;
            $creating->ad_date_hidden = ($params['dateHidden'] !== null)?date('Y-m-d H:i',strtotime($params['dateHidden'])):null;
            $creating->save();

            return response([
                'message' => 'success',
                'description' => 'Ad has been created successfully.',
            ], 201);

        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Something went wrong',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function updateSlideById(Request $req) {
        $this->getAuthUser();
        $files = $req->allFiles();
        $params = $req->all();
        $validator = Validator::make($req->all(), [
            'id' => 'required|numeric',
            'image' => "mimes:jpg,png,jpeg|max:5120",
            'imageName' => 'string|nullable',
            'imageTitle' => 'string|nullable',
            'imageAlt' => 'string|nullable',
            'title' => 'string|nullable',
            'description' => 'string|nullable',
            'h1' => 'string|nullable',
            'h2' => 'string|nullable',
            'type' => 'required|numeric',
            'link' => 'string|nullable',
            'redirect' => 'string|nullable',
            'positionId' => 'numeric',
            'display' => 'required|numeric', 
            'pageId' => 'numeric',
            'priority' => 'required|numeric',
            'priorityNew' => 'numeric|nullable',
            'language' => 'required|string|nullable',
            'dateDisplay' => 'string|nullable',
            'dateHidden' => 'string|nullable',
            'isEdit' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        try {

            $priority = (int)$params['priority'];
            /* Update Position */
            if(isset($params['priorityNew'])) {
                $this->prioritySlideUpdate($priority,$params['priorityNew'], $params['language']);
                $priority = (int)$params['priorityNew'];
            }
            
            /* Upload Image */
            $newFolder = "upload/".date('Y')."/".date('m')."/".date('d')."/";
            $imgSrc = (isset($files['image']))? $this->uploadImage($newFolder, $files['image'], "", "", $params['imageName']): $params['imageSrc'];

            $conditions  = ['id' => $params['id'], 'language' => $params['language']]; 
            $values = [
                "id" => $params['id'],
                "ad_image" => $imgSrc,
                "ad_image_alt" =>  $params['imageAlt'],
                "ad_image_title" =>   $params['imageTitle'],
                "ad_title" =>  $params['title'],
                "ad_description" =>  $params['description'],
                "ad_h1" =>  $params['h1'],
                "ad_h2" =>  $params['h2'],
                "ad_type" =>  $params['type'],
                "ad_link" =>  $params['link'],
                "ad_redirect" =>  $params['redirect'],
                "ad_position_id" =>  $params['positionId'],
                "ad_priority" =>  $priority,
                "page_id" =>  $params['pageId'],
                "language" =>  $params['language'],
                "ad_status_display" =>  ($params['display'] == 1)?1:0,
                "ad_date_display" =>  ($params['dateDisplay'] !== null)?date('Y-m-d H:i',strtotime($params['dateDisplay'])):null,
                "ad_date_hidden" =>  ($params['dateHidden'] !== null)?date('Y-m-d H:i',strtotime($params['dateHidden'])):null,
                "updated_at" => date('Y-m-d H:i:s')
            ];
            DB::table('ad_slides')->updateOrInsert($conditions, $values);

            return response([
                'message' => 'success',
                'description' => 'Ad has been created successfully.'
            ], ($params['isEdit'] == 1)?200:201);

        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Something went wrong',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function deleteWebInfoByInfoId($language , $token) {
        $this->getAuthUser();

        try {
            $id =  base64_decode($token);
            $deleting = AdSlide::where('id', $id)->where('language', $language);
            if(!$deleting) {
                return response([
                    'message' => 'error',
                    'description' => 'Token is invalid!'
                ], 400);
            }

            $slide = $deleting->get()->first();
            $this->prioritySlideUpdate($slide->ad_priority, 99999999 , $slide->language);
          
            $deleting->delete();
            return response([
                'message' => 'ok',
                'description' => 'Delete successful'
            ], 200);
        
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Something went wrong',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }

    }

    /* Private Function */
    private function getSlideList($language){
        $sql = "SELECT * FROM ( 
            SELECT * FROM `ad_slides` 
            WHERE language = :lang OR defaults = 1 
            ORDER BY defaults ASC 
        ) as slides GROUP BY id ORDER BY updated_at  DESC";
        return DB::select($sql, [':lang' => $language]);
    }
    
    private function prioritySlideUpdate( $current, $new, $language){
        $setOp = ($new <= $current)? ["<",">="] : [">","<="];
        $updating = AdSlide::where("ad_priority",$setOp[0], $current)->where("ad_priority", $setOp[1], $new)->where('language', $language);
        if($new <= $current) {
            return $updating->increment("ad_priority", 1);
        } else {
            return $updating->decrement("ad_priority", 1);
        }
    }
}
