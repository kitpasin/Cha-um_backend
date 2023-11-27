<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\backoffice\BaseController as BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UtilController extends BaseController
{
    public function ckeditorUploadImage(Request $req) {
        try {
            $this->getAuthUser();
            $files = $req->allFiles();
            $validator = Validator::make($req->all(), [ 
                'upload' => "required|mimes:jpg,png,jpeg|max:5120",
            ]); 
            if($validator->fails()) {
                // return $this->sendErrorValidators('Invalid params', $validator->errors());
                return response([
                    "message" => "error",
                    "uploaded" =>  0,
                    "error" =>  [
                        "message" =>  $validator->errors()
                    ]
                ], 400);
            }

            /* Upload Image */
            $fileName = $files['upload']->getClientOriginalName();
            $newFolder = "upload/".date('Y')."/".date('m')."/".date('d')."/";
            $imgSrc = $this->uploadImage($newFolder, $files['upload'], "", "", $fileName);
 
            return response([ 
                "uploaded" => 1,
                "fileName" => $fileName,
                "url" => config('app.url') ."/".  $imgSrc
            ], 201);

        } catch (Exception $e) {
            return response([
                "message" => "error",
                "uploaded" =>  0,
                "error" =>  [
                    "message" =>  $e->getMessage()
                ]
            ], 501);
        }
    }
}
