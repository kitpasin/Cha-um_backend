<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function readProduct()
    {
        $productBanner = Post::where("posts.category", "=", ",2,")
            ->where("posts.is_maincontent", "=", 1)
            ->first();

        $productSubmenu = SubCategory::where("sub_categories.main_cate_id", "=", 2)
            ->join("posts", "sub_categories.cate_title", "=", "posts.title")
            ->select(
                "sub_categories.*",
                "posts.thumbnail_link",
                "posts.thumbnail_alt",
            )
            ->get();

        $productRecoment = Product::leftjoin("sub_categories", "products.sub_cate_id", "=", "sub_categories.id")
            ->where("products.pin", "=", 1)
            ->select(
                "products.*",
                "sub_categories.cate_url as slug"
            )
            ->orderBy("products.id", "DESC")
            ->get();

        if ($productBanner && $productSubmenu && $productRecoment) {
            return response()->json([
                "status" => 200,
                "message" => "Get home data successfully.",
                "banner" => $productBanner,
                "submenu" => $productSubmenu,
                "recoment" => $productRecoment
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }

    public function readProductDetail($id)
    {
        $products = Product::join("sub_categories", "products.id", "=", "sub_categories.id")
            ->leftjoin("post_images", "products.id", "=", "post_images.product_id")
            ->where("products.id", "=", $id)
            ->select(
                "products.id as id",
                "products.title as title",
                "products.description as description",
                "products.content as content",
                "products.thumbnail_link as thumbnail_link",
                "products.thumbnail_title as thumbnail_title",
                "products.thumbnail_alt as thumbnail_alt",
                "products.price as price",
                "products.tel as tel",
                "products.line_id as line_id",
                "sub_categories.cate_title as type",
                "post_images.id as sub_id",
                "post_images.image_link as sub_image_link",
                "post_images.title as sub_image_title",
                "post_images.alt as sub_image_description"
            )
            ->get();

        $formattedProducts = [];
        foreach ($products as $product) {
            $mainproduct = [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'content' => $product->content,
                'thumbnail_link' => $product->thumbnail_link,
                'thumbnail_title' => $product->thumbnail_title,
                'thumbnail_alt' => $product->thumbnail_alt,
                'price' => $product->price,
                'tel' => $product->tel,
                'line_id' => $product->line_id,
                'type' => $product->type,
                'subimages' => [],
            ];
            if ($product->sub_id) {
                $subimages = [
                    'id' => $product->sub_id,
                    'image_link' => $product->sub_image_link,
                    'image_title' => $product->sub_image_title,
                    'image_description' => $product->sub_image_description,
                ];
                $mainproduct['subimages'][] = $subimages;
            }
            $existingMainProductKey = array_search($mainproduct['id'], array_column($formattedProducts, 'id'));
            if ($existingMainProductKey !== false) {
                $formattedProducts[$existingMainProductKey]['subimages'][] = $subimages;
            } else {
                $formattedProducts[] = $mainproduct;
            }
        }

        if ($products) {
            return response()->json([
                "status" => 200,
                "message" => "Get product detail data successfully.",
                "data" => $formattedProducts
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }

    public function readProductByCategory(Request $request)
    {
        $url = $request->url;
        $banner = SubCategory::where("sub_categories.cate_url", "=", $url)
            ->join("posts", "sub_categories.cate_title", "=", "posts.title")
            ->select(
                "posts.*",
            )
            ->first();

        $product = Product::join("sub_categories", "products.sub_cate_id", "=", "sub_categories.id")
            ->where("sub_categories.cate_url", "=", $url)
            ->select('products.*', 'sub_categories.*', 'products.id AS id', 'sub_categories.id AS sub_id')
            ->get();

        if ($banner) {
            return response()->json([
                "status" => 200,
                "message" => "Get data successfully.",
                "banner" => $banner,
                "product" => $product
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }
}
