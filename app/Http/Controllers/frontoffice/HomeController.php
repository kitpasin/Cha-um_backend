<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;

class HomeController extends Controller
{
    // คำอธิบายอ้างอิงจาก NavbarController function readCategories
    public function readHome()
    {
        $posts = Post::leftjoin("post_images", "posts.id", "=", "post_images.post_id")
            ->where("posts.category", "=", ",1,")
            ->select(
                "posts.id as main_id",
                "posts.title as main_title",
                "posts.description as main_description",
                "posts.thumbnail_link as main_image_link",
                "posts.thumbnail_title as main_image_title",
                "posts.thumbnail_alt as main_image_description",
                "post_images.id as sub_id",
                "post_images.image_link as sub_image_link",
                "post_images.title as sub_image_title",
                "post_images.alt as sub_image_description",
            )
            ->orderBy("posts.id", "ASC")
            ->get();

        $formattedPosts = [];
        foreach ($posts as $post) {
            $mainpost = [
                'id' => $post->main_id,
                'title' => $post->main_title,
                'description' => $post->main_description,
                'image_link' => $post->main_image_link,
                'image_title' => $post->main_image_title,
                'image_description' => $post->main_image_description,
                'subpost' => [],
            ];
            if ($post->sub_id) {
                $subpost = [
                    'id' => $post->sub_id,
                    'image_link' => $post->sub_image_link,
                    'image_title' => $post->sub_image_title,
                    'image_description' => $post->sub_image_description,
                ];
                $mainpost['subpost'][] = $subpost;
            }
            $existingMainPostKey = array_search($mainpost['id'], array_column($formattedPosts, 'id'));
            if ($existingMainPostKey !== false) {
                $formattedPosts[$existingMainPostKey]['subpost'][] = $subpost;
            } else {
                $formattedPosts[] = $mainpost;
            }
        }

        $homeExample = Portfolio::where('pin', 1)->orderBy("updated_at", "DESC")
            ->first();

        $homeService = Service::leftjoin("sub_categories", "services.sub_cate_id", "=", "sub_categories.id")
            ->where("services.pin", "=", 1)
            ->select(
                "services.*",
                "sub_categories.cate_url as slug"
            )
            ->orderBy("id", "DESC")
            ->take(4)
            ->get();

        $homeProduct = Product::leftjoin("sub_categories", "products.sub_cate_id", "=", "sub_categories.id")
            ->where("products.pin", "=", 1)
            ->select(
                "products.*",
                "sub_categories.cate_url as slug"
            )
            ->orderBy("id", "DESC")
            ->take(4)
            ->get();

        $homePortfolio = Portfolio::leftjoin("sub_categories", "portfolios.sub_cate_id", "=", "sub_categories.id")
            ->select(
                "portfolios.*",
                "sub_categories.cate_url as slug"
            )
            ->orderBy("id", "DESC")
            ->take(4)
            ->get();


        if ($posts && $homeExample && $homeService && $homeProduct && $homePortfolio) {
            return response()->json([
                "status" => 200,
                "message" => "Get home data successfully.",
                "post" => $formattedPosts,
                "example" => $homeExample,
                "service" => $homeService,
                "product" => $homeProduct,
                "portfolio" => $homePortfolio
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }
}
