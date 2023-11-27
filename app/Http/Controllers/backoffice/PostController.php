<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\backoffice\BaseController as BaseController;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class PostController extends BaseController
{
    public function index(Request $req){
        try {
            $data = $this->getPostData($req->language);
            return response([
                'message' => 'ok',
                'data' => $data,
            ], 200);
        } catch (Exception $e){
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function createContent(Request $req ) {
        $this->getAuthUser();
        $files = $req->allFiles();
        $params = $req->all();
        $validator = Validator::make($req->all(), [
            'Thumbnail' => "mimes:jpg,png,jpeg,pdf|max:5000|nullable",
        ]);
        if($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        /* Upload Thumbnail */
        $newFolder = "upload/".date('Y')."/".date('m')."/".date('d')."/";
        $thumbnail = (isset($files['Thumbnail']))? $this->uploadImage($newFolder, $files['Thumbnail'], "", "", $params['ThumbnailName']):"";

        $thumbnail_title = isset($files['Thumbnail']) && !empty($files['Thumbnail']) ? $params['ThumbnailTitle'] : "";
        $thumbnail_alt = isset($files['Thumbnail']) && !empty($files['Thumbnail']) ? $params['ThumbnailAlt'] : "";

        try {

            DB::beginTransaction();
            $postCreated = Post::create([
                "thumbnail_link" => $thumbnail,
                "thumbnail_title" => $thumbnail_title,
                "thumbnail_alt" => $thumbnail_alt,
                "category" => $params['category'],
                "title" => $params['title'],
                "keyword" => $params['keyword'],
                "description" => $params['description'],
                "slug" => $params['slug'],
                "topic" => $params['topic'],
                "content" => $params['content'],
                "redirect" => $params['redirect'],
                "date_begin_display" => $params['display_date'],
                "date_end_display" => $params['hidden_date'],
                "status_display" => $params['display'],
                "pin" => $params['pin'],
                "is_maincontent" => $params['isMainContent'],
                "priority" => $params['priority'],
                "language" => $params['language'],
                "defaults" => 1,
            ], Response::HTTP_CREATED);

            /* Upload Images */
            if(isset($files['Images'])) {
                $images = array();
                foreach($files['Images'] as $key => $val){
                    array_push($images, [
                        "post_id" => $postCreated->id,
                        "image_link" => $this->uploadImage($newFolder, $files['Images'][$key], "", "", $params['ImagesName'][$key]),
                        "title" =>  ($params['ImagesTitle'][$key])?$params['ImagesTitle'][$key]:"",
                        "alt" =>  ($params['ImagesAlt'][$key])?$params['ImagesAlt'][$key]:"",
                        "position" => $key + 1,
                        "language" => $params['language'],
                        "defaults" => 1
                    ]);
                }
                PostImage::insert($images);
            }

            DB::commit();

            return response([
                'message' => 'success',
                'description' => 'Created successful'
            ], 201);
        } catch (Exception $e) {
            DB::rollback();
            return response([
                'message' => 'error',
                'description' => 'Something went wrong',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function updateContent(Request $req) {
        $this->getAuthUser();
        $files = $req->allFiles();
        $params = $req->all();
        $validator = Validator::make($req->all(), [
            'Thumbnail' => "mimes:jpg,png,jpeg,pdf|max:5000|nullable",
        ]);
        if($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        try {
            DB::beginTransaction();
            $newFolder = "upload/".date('Y')."/".date('m')."/".date('d')."/";
            $uploadMoreImage = array();
            $addMoreImage = array();
            $idRemove = explode(',', $params['moreImageRemove']);
            
            if(isset($params['EditImageLink'])) {
                PostImage::where('post_id', $params['id'])->where('language', $params['language'])->delete();
                $numb = count($params['EditImageLink']);
                for($ii = 0; $ii < $numb; $ii++) {
                    array_push($addMoreImage, [
                        "post_id" => $params['id'],
                        "language" =>  $params['language'],
                        "title" => ($params['EditImageTitle'][$ii])?$params['EditImageTitle'][$ii]:"",
                        "alt" => ($params['EditImageAlt'][$ii])?$params['EditImageAlt'][$ii]:"",
                        "image_link" =>   $params['EditImageLink'][$ii],
                        "position" => $ii + 1,
                    ]);
                }
                PostImage::insert($addMoreImage);
            }
            
            if(isset($params['Images'])) {
                foreach($files['Images'] as $key => $val){
                    array_push($uploadMoreImage, [
                        "post_id" => $params['id'],
                        "image_link" => $this->uploadImage($newFolder, $files['Images'][$key], "", "", $params['ImagesName'][$key]),
                        "alt" =>  ($params['ImagesAlt'][$key])?$params['ImagesAlt'][$key]:"",
                        "title" =>  ($params['ImagesTitle'][$key])?$params['ImagesTitle'][$key]:"",
                        "position" => $params['ImagesPosition'][$key],
                        "language" => $params['language'],
                    ]);
                }
                PostImage::insert($uploadMoreImage);
            }

            /* ยังขาด function สำหรับลบ image ออกจาก frontend! */
            PostImage::where('post_id', $params['id'])
                    ->where('language', $params['language'])
                    ->whereIn('id', $idRemove)
                    ->delete();

            /* Upload Thumbnail */
            if (isset($files['Thumbnail'])) {
                $upload = $this->uploadImage($newFolder, $files['Thumbnail'], "", "", $params['ThumbnailName']);
                $thumbnail = $newFolder . $params['ThumbnailName'];
            } 
            else {
                if (!isset($params['ThumbnailName'])) {
                    $thumbnail = '';
                } else {
                    $existingThumbnail = $this->getExistingThumbnail($params['id'], $params['language']);
                    $thumbnail = $existingThumbnail;
                }
            }


            $this->priorityPostUpdate($params['old_priority'], $params['priority'] , $params['language'], "priority");

            $conditions  = ['id' => $params['id'], 'language' => $params['language']];
            $values = [
                'id' => $params['id'],
                "language" => $params['language'],
                "thumbnail_link" => $thumbnail,
                "thumbnail_title" => $params['ThumbnailTitle'],
                "thumbnail_alt" => $params['ThumbnailAlt'],
                "category" => $params['category'],
                "title" => $params['title'],
                "keyword" => $params['keyword'],
                "description" => $params['description'],
                "slug" => $params['slug'],
                "topic" => $params['topic'],
                "content" => $params['content'],
                "redirect" => $params['redirect'],
                "date_begin_display" => $params['display_date'],
                "date_end_display" => $params['hidden_date'],
                "status_display" => $params['status_display'],
                "pin" => $params['pin'],
                "is_maincontent" => $params['is_maincontent'],
                "priority" => $params['priority'],
                "updated_at" => date('Y-m-d H:i:s')
            ];

            DB::table('posts')->updateOrInsert($conditions, $values);
            DB::commit();
            return response([
                'message' => 'success',
                'description' => 'Updated successful'
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response([
                'message' => 'error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function deleteContent($language , $id) {
        try {

            $post = Post::where('id', $id)->where('language', $language)->get()->first();
            if(!$post) {
                return response([
                    'message' => 'error',
                    'description' => 'Token is invalid!'
                ], 422);
            }
            if($post->is_maincontent === 1) {
                $this->getAuthUser(1);
            } else {
                $this->getAuthUser();
            }

            DB::beginTransaction();

            $this->priorityPostUpdate($post->priority, 99999999 , $post->language, "priority");
            Post::where('id', $id)->where('language', $language)->delete();
            PostImage::where('post_id', $id)->where('language', $language)->delete();
            DB::commit();

            return response([
                'message' => 'ok',
                'description' => 'Delete successful'
            ], 200);

        } catch (Exception $e) {
            DB::rollback();
            return response([
                'message' => 'error',
                'description' => 'Something went wrong',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }

    }

    /* Private function  */
    private function getPostData($language) {

        $sql = "SELECT posts.*,
                        GROUP_CONCAT(post_images.id) imgId,
                        GROUP_CONCAT(post_images.title) imgTitle,
                        GROUP_CONCAT(post_images.alt) imgAlt,
                        GROUP_CONCAT(post_images.language) imgLanguage,
                        GROUP_CONCAT(post_images.image_link) imgLink
                    FROM (
                    SELECT * FROM (
                        SELECT * FROM posts
                        WHERE language = ? OR defaults = 1
                        ORDER BY defaults ASC
                    ) as posts
                    GROUP BY posts.id
                    ) as posts
                    LEFT JOIN (SELECT * FROM post_images WHERE post_images.language = ? OR defaults = 1 ORDER BY defaults ASC) as post_images ON posts.id = post_images.post_id
                    GROUP BY posts.id
                    ORDER BY updated_at DESC";
        return DB::select($sql, [$language, $language]);
    }

    private function priorityPostUpdate( $current, $new, $language, $column ){
        $setOp = ($new <= $current)? ["<",">="] : [">","<="];
        $updating = Post::where($column,$setOp[0], $current)->where($column, $setOp[1], $new)->where('language', $language);
        if($new <= $current) {
            return $updating->increment($column, 1);
        } else {
            return $updating->decrement($column, 1);
        }
    }

    private function getExistingThumbnail($productId, $language)
    {
        $existingThumbnail = DB::table('posts')
            ->where('id', $productId)
            ->where('language', $language)
            ->value('thumbnail_link');

        return $existingThumbnail ?: null;
    }

}
