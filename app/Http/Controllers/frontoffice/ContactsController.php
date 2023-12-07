<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\Post;

class ContactsController extends Controller
{
    public function readContactBanner()
    {
        $contactBanner = Post::where("posts.category", "=", ",6,")
            ->where("posts.is_maincontent", "=", 1)
            ->orderBy("posts.id", "DESC")
            ->first();

        if ($contactBanner) {
            return response()->json([
                "status" => 200,
                "message" => "Get contact data successfully.",
                "banner" => $contactBanner,
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }
}
