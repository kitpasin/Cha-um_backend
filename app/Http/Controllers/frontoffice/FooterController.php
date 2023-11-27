<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class FooterController extends Controller
{
    public function readFooter() 
    {
        $menu = SubCategory::where("sub_categories.is_bottomside", "=", 1)
        ->select(
            "sub_categories.id",
            "sub_categories.cate_title as title",
            "sub_categories.cate_url as slug"
        )
     
        ->get();
        
        if ($menu) {
            return response()->json([
                "status" => 200,
                "message" => "Get home data successfully.",
                "menu" => $menu,
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }
}
