<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\Category;

class NavbarController extends Controller
{
    public function readCategories()
    {
        // ใช้ leftjoin เนื่องจาก main category บางตัวที่ไม่มี sub category
        $menus = Category::leftjoin("sub_categories", "categories.id", "=", "sub_categories.main_cate_id")
            ->select(
                "categories.id as main_cate_id",
                "categories.cate_title as main_cate_title",
                "categories.cate_url as main_cate_url",
                "sub_categories.id as sub_cate_id",
                "sub_categories.cate_title as sub_cate_title",
                "sub_categories.cate_url as sub_cate_url"
            )
            ->orderBy("categories.id", "ASC")
            ->orderBy("sub_categories.id", "ASC")
            ->get();

        if ($menus) {
            // เนื่องจากใช้ leftjoin จะมีการแสดง data ของ main category ซ้ำ
            // สร้าง format ของ menu โดยใช้ main category ที่มี sub category อยู่ภายใน
            $formattedMenus = [];

            foreach ($menus as $menu) {
                $mainmenu = [
                    'id' => $menu->main_cate_id,
                    'title' => $menu->main_cate_title,
                    'url' => $menu->main_cate_url,
                    'submenu' => [],
                ];

                // เช็คถ้ามี sub category ใน category
                if ($menu->sub_cate_id) {
                    $submenu = [
                        'id' => $menu->sub_cate_id,
                        'title' => $menu->sub_cate_title,
                        'url' => $menu->sub_cate_url,
                    ];

                    $mainmenu['submenu'][] = $submenu;
                }

                // เช็คถ้ามี main category อยู่ใน formatted array
                $existingMainCategoryKey = array_search($mainmenu['id'], array_column($formattedMenus, 'id'));

                if ($existingMainCategoryKey !== false) {
                    // ถ้ามี main category อยู่ใน formatted array เพิ่ม array sub category เข้าไป
                    $formattedMenus[$existingMainCategoryKey]['submenu'][] = $submenu;
                } else {
                    // ถ้าไม่มี main category อยู่ใน formatted array เพิ่ม main category เข้าไปใน formatted array
                    $formattedMenus[] = $mainmenu;
                }
            }

            return response()->json([
                "status" => 200,
                "message" => "Get categories successfully.",
                "data" => $formattedMenus
            ], 200);
        }
        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }
}
