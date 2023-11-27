<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\backoffice\BaseController as BaseController;
use App\Models\AdminAccount;
use App\Models\AdSlidePosition;
use App\Models\LanguageAvailable;
use App\Models\WebInfoType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\File;

class ConfigController extends BaseController
{
    public function index(Request $request)
    {
        $this->getAuthUser(1);
        $bannerType = AdSlidePosition::orderBy('name', 'ASC')->get()->all();
        $languageAvailable = LanguageAvailable::orderBy('defaults', 'DESC')->get()->all();
        $infoType = $this->webInfoType($request->language);

        #BANNER
        $bannerTypeArr = [];
        foreach ($bannerType as $val) {
            array_push($bannerTypeArr, [
                'id' => $val->id,
                'token' => base64_encode($val->id),
                'title' => $val->type_name,
                'dimension' => $val->dimension,
                'type' => $val->position,
                'updatedDate' => date('Y-m-d H:i:s', strtotime($val->updated_at)),
                'active' => false,
            ]);
        }

        #LANGUAGE
        $languageAvailableArr = [];
        foreach ($languageAvailable as $val) {
            array_push($languageAvailableArr, [
                'id' => $val->id,
                'token' => base64_encode($val->id),
                'title' => $val->name,
                'language' => $val->abbv_name,
                'flag' => $val->flag,
                'defaults' => $val->defaults,
                'updatedDate' =>  date('Y-m-d H:i:s', strtotime($val->updated_at)),
                'active' => false,
            ]);
        }

        #DataType
        $InfoTypeArr = [];
        foreach ($infoType as $val) {
            array_push($InfoTypeArr, [
                'id' => $val->id,
                'token' => base64_encode($val->id),
                'title' => $val->title,
                'typeName' => $val->typeName,
                'updatedDate' =>  date('Y-m-d H:i:s', strtotime($val->updated_at)),
            ]);
        }

        return response()->json([
            'message' => 'ok',
            'data' => [
                'languages' => $languageAvailableArr,
                'bannerTypes' => $bannerTypeArr,
                'infoTypes' => $InfoTypeArr
            ]
        ]);
    }

    public function createLanguage(Request $request)
    {
        $auth = $this->getAuthUser(1);
        $files = $request->allFiles();
        $params = $request->all();
        $validator = Validator::make($request->all(), [
            'language' => 'required',
            'title' => 'required',
            'image' => "mimes:jpg,png,jpeg|max:512"
        ]);
        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }
        $newFolder = "upload/" . date('Y') . "/" . date('m') . "/" . date('d') . "/";
        $image = (isset($files['image'])) ? $this->uploadImage($newFolder, $files['image'], $params['language'], 0) : "";

        try {
            LanguageAvailable::create([
                'abbv_name' => $params['language'],
                'name' => $params['title'],
                'flag' => $image,
                'defaults' => 0
            ], Response::HTTP_CREATED);

            AdminAccount::where('account_id', $auth->account_id)->update([
                "language" => $auth->language . "," .  $params['language']
            ]);

            return response()->json([
                'message' => 'success',
                'description' => 'Created successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function deleteConfigLanguage($token)
    {
        $this->getAuthUser(1);
        $id = (int)(base64_decode($token));
        $find = LanguageAvailable::find($id);
        if (!$find) {
            return response()->json([
                'message' => 'error',
                'description' => 'Invalid token.',
            ], 409);
        }

        try {

            $find->delete();
            return response()->json([
                'message' => 'success',
                'description' => 'Language have been deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function createDataType(Request $request)
    {
        $this->getAuthUser(1);
        $params = $request->all();
        $validator = Validator::make($request->all(), [
            'typeName' => 'required',
            'title' => 'required',
            'language' => "required"
        ]);
        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        /* ถ้าเป็น main ภาษาหลักให้ set เป็น default */
        $defaultLang = LanguageAvailable::orderBy('defaults', 'desc')->get()->first();
        $defaultValue = ($defaultLang->abbv_name === $params['language']) ? 1 : 0;

        try {

            WebInfoType::create([
                'type_name' => $params['typeName'],
                'title' => $params['title'],
                'language' => $params['language'],
                'defaults' => $defaultValue
            ], Response::HTTP_CREATED);

            return response()->json([
                'message' => 'success',
                'description' => 'Data type has been created.'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }
    public function deleteConfigDataType($token)
    {
        $this->getAuthUser(1);
        $id = (int)(base64_decode($token));
        $find = WebInfoType::find($id);
        if (!$find) {
            return response()->json([
                'message' => 'error',
                'description' => 'Invalid token.',
            ], 409);
        }
        try {
            $find->delete();
            return response()->json([
                'message' => 'success',
                'description' => 'Language have been deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function createAdType(Request $request)
    {
        $this->getAuthUser(1);
        $params = $request->all();
        $validator = Validator::make($request->all(), [
            'position' => 'required',
            'typeName' => 'required',
            'dimension' => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        try {

            AdSlidePosition::create([
                'position' => $params['position'],
                'name' => $params['typeName'],
                'dimension' => $params['dimension']
            ], Response::HTTP_CREATED);

            return response()->json([
                'message' => 'success',
                'description' => 'Data Ad Type has been created.'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function editAdType(Request $request)
    {
        $this->getAuthUser(1);
        $params = $request->all();
        $validator = Validator::make($request->all(), [
            'token' => "required",
            'position' => 'required',
            'typeName' => 'required',
            'dimension' => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }
        $id = base64_decode($params['token']);
        $updating = AdSlidePosition::find($id);
        if (!$updating) {
            return response()->json([
                'message' => 'error',
                'description' => 'Token is invalid.'
            ], 400);
        }

        try {
            $updating->position = $params['position'];
            $updating->name = $params['typeName'];
            $updating->dimension = $params['dimension'];
            $updating->save();

            return response()->json([
                'message' => 'success',
                'description' => 'Data Ad Type has been updated.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function deleteConfigAdType($token)
    {
        $this->getAuthUser(1);
        $id = (int)(base64_decode($token));
        $find = AdSlidePosition::find($id);
        if (!$find) {
            return response()->json([
                'message' => 'error',
                'description' => 'Invalid token.',
            ], 409);
        }
        try {
            $find->delete();
            return response()->json([
                'message' => 'success',
                'description' => 'Language have been deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }


    /* Function */
    private function webInfoType($language)
    {
        $sql = "SELECT id, type_name as typeName, title, updated_at  FROM web_info_types WHERE language = :lang OR defaults = 1 GROUP BY id ORDER BY defaults ASC, id ASC";
        return DB::select($sql, [":lang" => $language]);
    }


    public function uploadManual(Request $request)
    {
        try {
            $this->getAuthUser();
            $files = $request->allFiles();

            /* Upload Image */
            $fileName = "manual";
            $newFolder = "upload/manual/";
            $filePathName = $newFolder . $fileName . '.pdf';
            if(file_exists($filePathName)){
                unlink($filePathName);
            }
            $imgSrc = $this->uploadImage($newFolder, $files['upload'], "", "", $fileName);

            return response([
                "uploaded" => 1,
                "fileName" => $fileName,
                "url" => config('app.url') . "/" .  $imgSrc
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
