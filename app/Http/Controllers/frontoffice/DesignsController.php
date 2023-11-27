<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\Post;
use App\Models\SubCategory;

class DesignsController extends Controller
{
    public function readDesign()
    {
        $designBanner = Post::where("posts.category", "=", ",6,")
            ->where("posts.is_maincontent", "=", 1)
            ->first();

        $designList = Design::join("sub_categories", "designs.sub_cate_id", "=", "sub_categories.id")
            ->select(
                "designs.*",
                "sub_categories.cate_title as type",
                "sub_categories.cate_url as slug"
            )
            ->get();

        if ($designBanner && $designList) {
            return response()->json([
                "status" => 200,
                "message" => "Get design data successfully.",
                "banner" => $designBanner,
                "designs" => $designList,
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }

    public function readDesignDetail($id)
    {
        $designs = Design::join("sub_categories", "designs.sub_cate_id", "=", "sub_categories.id")
            ->leftjoin("post_images", "designs.id", "=", "post_images.design_id")
            ->where("designs.id", "=", $id)
            ->select(
                "designs.id as id",
                "designs.title as title",
                "designs.description as description",
                "designs.content as content",
                "designs.thumbnail_link as thumbnail_link",
                "designs.thumbnail_title as thumbnail_title",
                "designs.thumbnail_alt as thumbnail_alt",
                "designs.address as address",
                "designs.size as size",
                "designs.status as status",
                "sub_categories.cate_title as type",
                "post_images.id as sub_id",
                "post_images.image_link as sub_image_link",
                "post_images.title as sub_image_title",
                "post_images.alt as sub_image_description"
            )
            ->get();

        $formattedDesigns = [];
        foreach ($designs as $design) {
            $maindesign = [
                'id' => $design->id,
                'title' => $design->title,
                'description' => $design->description,
                'content' => $design->content,
                'thumbnail_link' => $design->thumbnail_link,
                'thumbnail_title' => $design->thumbnail_title,
                'thumbnail_alt' => $design->thumbnail_alt,
                'address' => $design->address,
                'size' => $design->size,
                'status' => $design->status,
                'type' => $design->type,
                'subimages' => [],
            ];
            if ($design->sub_id) {
                $subimages = [
                    'id' => $design->sub_id,
                    'image_link' => $design->sub_image_link,
                    'image_title' => $design->sub_image_title,
                    'image_description' => $design->sub_image_description,
                ];
                $maindesign['subimages'][] = $subimages;
            }
            $existingMainDesignKey = array_search($maindesign['id'], array_column($formattedDesigns, 'id'));
            if ($existingMainDesignKey !== false) {
                $formattedDesigns[$existingMainDesignKey]['subimages'][] = $subimages;
            } else {
                $formattedDesigns[] = $maindesign;
            }
        }

        if ($designs) {
            return response()->json([
                "status" => 200,
                "message" => "Get design detail data successfully.",
                "data" => $formattedDesigns
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }
}
