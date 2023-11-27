<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\backoffice\BaseController as BaseController;
use App\Models\Post;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends BaseController
{
    public function getSubCateMenu(Request $req){
        try {
            $productList = SubCategory::where('main_cate_id', 2)
            ->get();
            $serviceList = SubCategory::where('main_cate_id', 4)
            ->get();
            $cateList =  $this->getSubCategory($req->language);
            //  Category::where('is_menu', 1)->where('language', $req->language)->orderBy('cate_level','ASC')->get()->all();

            return response([
                'message' => 'ok',
                'menu' => $productList,
                'services' => $serviceList,
                'category' => $cateList,
            ], 200);
        } catch (Exception $e){
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function createSubCategory(Request $req) {
        $this->getAuthUser();
        $files = $req->allFiles();
        $params = $req->all();
        $validator = Validator::make($req->all(), [
            'Image' => "mimes:jpg,png,jpeg|max:5120|nullable",
            'ImageName' => 'string|nullable',
            'ImageTitle' => 'string|nullable',
            'ImageAlt' => 'string|nullable',
            'main_cate_id' => 'required|numeric',
            'cate_parent_id' => 'required|numeric',
            'cate_root_id' => 'string|nullable',
            'cate_level' => 'string|nullable',
            'cate_title' => 'required|string',
            'cate_url' => 'required|string',
            'cate_keyword' => 'string|nullable',
            'cate_description' => 'string|nullable',
            'is_main_page' => 'required|numeric',
            'is_menu' => 'required|numeric',
            'is_bottomside' => 'required|numeric',
            'cate_priority' => 'required|numeric',
            'language' => 'required|string',
             // 'cate_h1' => 'string|nullable',
            // 'cate_h2' => 'string|nullable',
            // 'cate_dateDisplay' => 'string|nullable',
            // 'cate_dateHidden' => 'string|nullable',
        ]);
        if($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        try {
            $checkURL = SubCategory::where("language", "!==", $params['language'])
                                ->where('cate_url', $params['cate_url'])
                                ->get()
                                ->first();
            if($checkURL) {
                return response([
                   'message' => 'error',
                   'description' => 'Duplicate URLs'
                ], 422);
            }

            /* Update Position */
            $priority = (int)$params['cate_priority'];
            $this->prioritySubCategoryUpdate(99999999,$priority, $params['language'], "cate_priority");

            /* Update Position */
            $position = (int)$params['cate_position'];
            $this->prioritySubCategoryUpdate(99999999,$position, $params['language'], "cate_position");

            /* Upload Image */
            $newFolder = "upload/".date('Y')."/".date('m')."/".date('d')."/";
            $imgSrc = (isset($files['Image']))? $this->uploadImage($newFolder, $files['Image'], "", "", $params['ImageName']):"";


            $creating = new SubCategory();
            $creating->main_cate_id = $params['main_cate_id'];
            $creating->cate_thumbnail_link = $imgSrc;
            $creating->cate_priority = $priority;
            $creating->cate_position = $position;
            $creating->cate_root_id = $params['cate_root_id'];
            $creating->cate_thumbnail_title = $params['cate_thumbnail_title'];
            $creating->cate_thumbnail_alt = $params['cate_thumbnail_alt'];
            $creating->cate_parent_id = $params['cate_parent_id'];
            $creating->cate_level = $params['cate_level'];
            $creating->cate_url = $params['cate_url'];
            $creating->cate_title = $params['cate_title'];
            $creating->cate_keyword = $params['cate_keyword'];
            $creating->cate_description = $params['cate_description'];
            $creating->is_main_page = $params['is_main_page'];
            $creating->is_menu = $params['is_menu'] ;
            $creating->is_topside = $params['is_menu'] ;
            $creating->is_bottomside = $params['is_bottomside'] ;
            $creating->cate_redirect = "";
            $creating->language = $params['language'];
            $creating->defaults = 1;
            $creating->save();
            /* ถ้า ROOT ID = 0 ให้ใช้ Id ตัวเองเป็น ROOT */
            if($params['cate_root_id'] === 0){
                SubCategory::find($creating->id)->update([
                    "cate_root_id" => $creating->id
                ]);
            }

            return response([
                'message' => 'ok',
                'description' => 'success'
            ]);
        }  catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function updateSubCategory(Request $req)
    {
        $this->getAuthUser();
        $files = $req->allFiles();
        $params = $req->all();
        $validator = Validator::make($req->all(), [
            'id' => 'required|string',
            'main_cate_id' => 'required|numeric',
            'Image' => "mimes:jpg,png,jpeg|max:5120|nullable",
            'ImageName' => 'string|nullable',
            'ImageTitle' => 'string|nullable',
            'ImageAlt' => 'string|nullable',
            'cate_parent_id' => 'required|numeric',
            'cate_root_id' => 'required|numeric',
            'cate_level' => 'required|numeric',
            'cate_title' => 'required|string',
            'cate_keyword' => 'string|nullable',
            'cate_description' => 'string|nullable',
            'is_main_page' => 'required|numeric',
            'is_menu' => 'required|numeric',
            'is_bottomside' => 'required|numeric',
            'cate_priority' => 'required|numeric',
            'language' => 'required|string',
            // 'cate_h1' => 'string|nullable',
            // 'cate_h2' => 'string|nullable',
            // 'cate_dateDisplay' => 'string|nullable',
            // 'cate_dateHidden' => 'string|nullable',
        ]);
        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        try {

            $checkURL = SubCategory::where('id', '<>', $params['id'])->where('cate_url', $params['cate_url'])->get()->first();
            if ($checkURL) {
                return response([
                    'message' => 'error',
                    'description' => 'Duplicate URLs'
                ], 422);
            }

            DB::beginTransaction();

            /* Update Position */
            $priority = (int)$params['cate_priority'];
            $this->prioritySubCategoryUpdate(99999999, $priority, $params['language'], "cate_priority");

            /* Update Position */
            // $position = (int)$params['cate_position'];
            // $this->priorityCategoryUpdate(99999999,$position, $params['language'], "cate_position");
           
            $newFolder = "upload/" . date('Y') . "/" . date('m') . "/" . date('d') . "/";
            
            if (isset($files['Image'])) {
                $upload = $this->uploadImage($newFolder, $files['Image'], "", "", $params['ImageName']);
                $thumbnail = $newFolder . $params['ImageName'];
            } 
            else {
                if (!isset($params['ImageName'])) {
                    $thumbnail = '';
                } else {
                    $existingThumbnail = $this->getExistingThumbnail($params['id'], $params['language']);
                    $thumbnail = $existingThumbnail;
                }
            }

            $conditions  = ['id' => $params['id'], 'language' => $params['language']];
            $values = [
                "main_cate_id" => $params['main_cate_id'],
                "cate_priority" => $priority,
                "cate_position" => (int)$params['cate_position'],
                "cate_root_id" => $params['cate_root_id'],
                "cate_thumbnail_link" => $thumbnail,
                "cate_thumbnail_title" => $params['cate_thumbnail_title'],
                "cate_thumbnail_alt" => $params['cate_thumbnail_alt'],
                "cate_parent_id" => $params['cate_parent_id'],
                "cate_level" => $params['cate_level'],
                "cate_url" => $params['cate_url'],
                "cate_title" => $params['cate_title'],
                "cate_keyword" => $params['cate_keyword'],
                "cate_description" => $params['cate_description'],
                "cate_redirect" => $params['cate_redirect'],
                "is_main_page" => $params['is_main_page'],
                "is_menu" => $params['is_menu'],
                "is_topside" => $params['is_menu'],
                "is_bottomside" => $params['is_bottomside'],
                "updated_at" => date('Y-m-d H:i:s'),
            ];

            $result = DB::table('sub_categories')->updateOrInsert($conditions, $values);
            DB::commit();
            return response([
                'message' => 'success',
                'description' => 'Updated successfully'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response([
                'message' => 'error',
                'description' => 'Something went wrong',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function deleteSubCategory($language , $id) {
        $this->getAuthUser();

        try {

            $cate = SubCategory::where('id', $id)->where('language', $language)->get()->first();
            if(!$cate) {
                return response([
                    'message' => 'error',
                    'description' => 'Token is invalid!'
                ], 422);
            }

            $isCateParent = SubCategory::where('cate_parent_id', $id)->where('language', $language)->get()->first();
            if($isCateParent) {
                return response([
                    'message' => 'error',
                    'description' => 'The Category has relate to another category.'
                ], 422);
            }

            $isPostParent = Post::where('category', 'LIKE', "%,{$id},%")->where('language', $language)->get()->first();
            if($isPostParent) {
                return response([
                    'message' => 'error',
                    'description' => 'The Category has relate to another Post.'
                ], 422);
            }

            $this->prioritySubCategoryUpdate($cate->cate_priority, 99999999 , $cate->language, "cate_priority");
            $this->prioritySubCategoryUpdate($cate->cate_position, 99999999 , $cate->language, "cate_position");

            SubCategory::where('id', $id)->where('language', $language)->delete();


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

    private function prioritySubCategoryUpdate($current, $new, $language, $column)
    {
        $setOp = ($new <= $current) ? ["<", ">="] : [">", "<="];
        $updating = SubCategory::where($column, $setOp[0], $current)->where($column, $setOp[1], $new)->where('language', $language);
        if ($new <= $current) {
            return $updating->increment($column, 1);
        } else {
            return $updating->decrement($column, 1);
        }
    }

    private function getSubCategory($language) {
        $sql = "SELECT * FROM (
            SELECT * FROM `sub_categories`
            WHERE language = :lang OR defaults = 1
            ORDER BY sub_categories.id ASC
        ) as subcate GROUP BY id ASC";
        return DB::select($sql, [':lang' => $language]);
    }

    private function getExistingThumbnail($productId, $language)
    {
        $existingThumbnail = DB::table('sub_categories')
            ->where('id', $productId)
            ->where('language', $language)
            ->value('cate_thumbnail_link');

        return $existingThumbnail ?: null;
    }
    
}
