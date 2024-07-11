<?php

namespace App\Helpers;

use App\Models\Language;
use App\Models\Currency;
use App\Models\State;
use App\Models\HotelPackage;
use App\Models\Activities;
use App\Models\City;
use Request;

class DefaultLanguage
{
    public static function SelectedLanguage()
    {
        $data = Language::where('bydefault', 1)->get()->last();
        return $data;
    }



    public static function AllLanguage()
    {
        $all_language = Language::where('status', 1)->get();
        return $all_language;
    }

    public static function GetCurrencies()
    {
        $currencies = Currency::where('status', 1)->get();
        return  $currencies;
    }


    public static function SelectedCurrency()
    {


        if(session('currency') != null){
            $data = session('currency');
        }else{
            $data = Currency::where('bydefault', 1)->get()->last();
            $data  = $data ->currency_code;
        }
//dd($data);
        return $data;
    }
    public static function GetSegment()
    {
        $get_language = Language::where('status', 1)->where('language_code', app()->getLocale())->get()->last();
        if ($get_language != null) {
            return $get_language;
        } else {
            $get_language = Language::where('bydefault', 1)->get()->last();
            return $get_language;
        }
    }
    public static function CurrentSegment($route=null,$function=null)
    {
        $segment=Request::segment(1);
        $get_language = Language::where('status', 1)->where('language_code', $segment)->pluck('language_code')->toArray();

        if (in_array($segment,$get_language)) {
            return url('/').'/'.$segment.'/'.$route.'/'.$function;
        } else {
            return url('/').'/'.$route.'/'.$function;
        }
    }

    public static function AllData($id)
    {
        $get_language = Language::where('status', 1)->where('language_code','en')->get()->last();
        $citys = City::leftjoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->where('city_details.language_id',$get_language->id)
            ->where('city_details.states_id',$id)->distinct()->pluck('city_details.title');
        return $citys;
    }


    public static function GetState($id)
    {
        $get_language = Language::where('status', 1)->where('language_code','en')->get()->last();
        $states = State::leftjoin('state_pivots', 'states.id', '=', 'state_pivots.state_id')
            ->where('state_pivots.language_id',$get_language->id)
            ->where('states.id',$id)->distinct()->pluck('state_pivots.title');
        return $states;
    }

    public static function GetCity($id)
    {
        $get_language = Language::where('status', 1)->where('language_code', app()->getLocale())->get()->last();
        $cities = City::leftjoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->where('city_details.language_id',$get_language->id)
            ->whereIn('city_details.city_id', json_decode($id, true))->distinct()->pluck('city_details.title');
        return $cities;
    }

    public static function GetHotel($id)
    {
        $get_language = Language::where('status', 1)->where('language_code', app()->getLocale())->get()->last();
        $hotels = HotelPackage::leftjoin('hotel_details', 'hotel_packages.id', '=', 'hotel_details.hotel_id')
            ->where('hotel_details.language_id',$get_language->id)
            ->whereIn('hotel_packages.id', json_decode($id, true))->distinct()->pluck('hotel_packages.hotel_type');
        return $hotels;
    }

    public static function OnlyHotel($id)
    {
        $get_language = Language::where('status', 1)->where('language_code', app()->getLocale())->get()->last();
        $hotels = HotelPackage::leftjoin('hotel_details', 'hotel_packages.id', '=', 'hotel_details.hotel_id')
            ->where('hotel_details.language_id',$get_language->id)
            ->whereIn('hotel_packages.id', json_decode($id, true))->get()->first();
        return $hotels->title;
    }



//    public static function GetActivities($id)
//    {
//        $get_language = Language::where('status', 1)->where('language_code', app()->getLocale())->get()->last();
//        $activities = Activities::leftJoin('activities_pivot', 'activities_pivot.activity_id', 'activities.id')
//            ->leftJoin('media', 'activities.id', '=', 'media.reference_id')
//            ->where('media.reference_type', '=', 'activity')
//            ->whereIn('activities.id', json_decode($id,true))
//            ->where('activities_pivot.language_id', $get_language->id)
//            ->distinct()->pluck( 'activities_pivot.title','media.image');
//        return $activities;
//    }
}
