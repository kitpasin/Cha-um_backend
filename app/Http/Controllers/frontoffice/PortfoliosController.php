<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Post;

class PortfoliosController extends Controller
{
    public function readPortfolio()
    {
        $portfolioBanner = Post::where("posts.category", "=", ",3,")
            ->where("posts.is_maincontent", "=", 1)
            ->first();

        $portfolioList = Portfolio::leftjoin("categories", "portfolios.category", "=", "categories.id")
            ->select(
                "portfolios.*",
                "categories.cate_title as type",
                "categories.cate_url as slug"
            )
            ->orderBy("portfolios.id", "DESC")
            ->get();

        if ($portfolioBanner && $portfolioList) {
            return response()->json([
                "status" => 200,
                "message" => "Get portfolio data successfully.",
                "banner" => $portfolioBanner,
                "list" => $portfolioList,
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }

    public function readPortfolioDetail($id)
    {
        $portfolios = Portfolio::join("categories", "portfolios.category", "=", "categories.id")
            ->leftjoin("post_images", "portfolios.id", "=", "post_images.portfolio_id")
            ->where("portfolios.id", "=", $id)
            ->select(
                "portfolios.id as id",
                "portfolios.title as title",
                "portfolios.description as description",
                "portfolios.content as content",
                "portfolios.thumbnail_link as image_link",
                "portfolios.thumbnail_title as image_title",
                "portfolios.thumbnail_alt as image_description",
                "portfolios.address as address",
                "portfolios.size as size",
                "portfolios.status as status",
                "categories.cate_title as type",
                "post_images.id as sub_id",
                "post_images.image_link as sub_image_link",
                "post_images.title as sub_image_title",
                "post_images.alt as sub_image_description"
            )
            ->get();


        $formattedPortfolios = [];
        foreach ($portfolios as $portfolio) {
            $mainportfolio = [
                'id' => $portfolio->id,
                'title' => $portfolio->title,
                'description' => $portfolio->description,
                'content' => $portfolio->content,
                'image_link' => $portfolio->image_link,
                'image_title' => $portfolio->image_title,
                'image_description' => $portfolio->image_description,
                'address' => $portfolio->address,
                'size' => $portfolio->size,
                'status' => $portfolio->status,
                'type' => $portfolio->type,
                'subimages' => [],
            ];
            if ($portfolio->sub_id) {
                $subimages = [
                    'id' => $portfolio->sub_id,
                    'image_link' => $portfolio->sub_image_link,
                    'image_title' => $portfolio->sub_image_title,
                    'image_description' => $portfolio->sub_image_description,
                ];
                $mainportfolio['subimages'][] = $subimages;
            }
            $existingMainPortfolioKey = array_search($mainportfolio['id'], array_column($formattedPortfolios, 'id'));
            if ($existingMainPortfolioKey !== false) {
                $formattedPortfolios[$existingMainPortfolioKey]['subimages'][] = $subimages;
            } else {
                $formattedPortfolios[] = $mainportfolio;
            }
        }

        if ($portfolios) {
            return response()->json([
                "status" => 200,
                "message" => "Get portfolio detail data successfully.",
                "data" => $formattedPortfolios
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }
}
