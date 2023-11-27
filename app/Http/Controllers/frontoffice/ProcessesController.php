<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProcessesController extends Controller
{
    public function readProcess()
    {
        $processBanner = Post::where("posts.category", "=", ",5,")
            ->where("posts.is_maincontent", "=", 1)
            ->first();

        $processSubmenu = SubCategory::where("sub_categories.main_cate_id", "=", 5)
            ->join("posts", "sub_categories.cate_title", "=", "posts.title")
            ->select(
                "sub_categories.*",
                "posts.thumbnail_link",
                "posts.thumbnail_alt",
            )
            ->get();

        if ($processBanner && $processSubmenu) {
            return response()->json([
                "status" => 200,
                "message" => "Get portfolio data successfully.",
                "banner" => $processBanner,
                "submenu" => $processSubmenu,
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }

    public function readProcessByCategory(Request $request)
    {
        $url = $request->url;
        $process = SubCategory::where("sub_categories.cate_url", "=", $url)
            ->join("posts", "sub_categories.cate_title", "=", "posts.title")
            ->select(
                "posts.*",
            )
            ->first();

        if ($process) {
            return response()->json([
                "status" => 200,
                "message" => "Get data successfully.",
                "process" => $process,
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }
}
