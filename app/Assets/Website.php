<?php

namespace App\Assets;

use App\Models\Category;
use App\Models\LanguageAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use DB;
use Carbon\Carbon;

class Website
{
    public function settings(){
        $pathname = \Request::segments();
        $main_menu = Category::where(['is_menu' => true, 'is_topside' => true, 'is_main_page' => true, 'language' => $pathname[0], 'cate_level' => 0])->orderBy('cate_priority', 'ASC')->get();
        $lang = LanguageAvailable::orderby('defaults', 'DESC')->get();
        $footer = Category::where(['is_menu' => true, 'is_bottomside' => true, 'language' => $pathname[0], 'cate_level' => 0])->get();
        $website = [
            'mainmenu' => $main_menu,
            'language' => $lang,
            'footer_menu' => $footer->where('cate_position', 1),
            'footer_menuinfo' => $footer->where('cate_position', 2),
        ];
        return $website;
    }
}
