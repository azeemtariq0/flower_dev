<?php

namespace App\Helpers;

use App\Models\Language;
use App\Models\Currency;
use App\Models\CustomPivot;
use App\Models\Menu;
use Request;

class Menus
{
    public static function SelectedMenu()
    {
        $get_language = Language::where('language_code', app()->getLocale())->get()->first();
        $menu = Menu::leftjoin('menu_pivots', 'menus.id', '=', 'menu_pivots.menu_id')
            ->where('menu_pivots.language_id', $get_language->id)->limit(5)->get();
        return $menu;
    }

    public static function Translator($id)
    {
        $get_language = Language::where('language_code', app()->getLocale())->get()->first();
        $default_language = Language::where('bydefault',1)->get()->first();
        $custom = CustomPivot::where('custom_id', $id)->where('language_id', $get_language->id)->select('title')->first();
        if($custom != null){
            $custom  = $custom;
        }else{
            $custom =  CustomPivot::where('custom_id', $id)->where('language_id', $default_language->id)->select('title')->first();
        }
        if (isset($custom->title)) {
            return $custom->title;
        } else {
            return null;
        }


    }


}
