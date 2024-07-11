<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Currency;
use App\Http\Controllers\Controller;
use App\Helpers\DefaultLanguage;
use App\Models\blog;
use App\Models\City;
use App\Models\ShippingAddress;
use App\Models\coupon;
use App\Models\categories;
use App\Models\Country;
use App\Models\EnquireNow;
use App\Models\SeasonPackage;
use App\Models\faqs;
use App\Models\Highlights;
use App\Models\Gallery;
use App\Models\HotelReviews;
use App\Models\ProductReviews;
use App\Models\Activities;
use App\Models\Itinerary;
use App\Models\ItineraryDetail;
use App\Models\category_package_pivot;
use App\Models\Holidays;
use App\Models\HotelPackage;
use App\Models\HelpPlanning;
use App\Models\FormPackage;
use App\Models\inclusion;
use App\Models\Language;
use App\Models\media;
use App\Models\Package;
use App\Models\seo;
use App\Models\store;

//use Request;
use Illuminate\Http\Request;
use Route;
use Session;
use DB;
use App\Helper;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Pages(Request $request)
    {
        $lang_id = Language::where('language_code', app()->getLocale())->get()->first();
        $slug = $request->segment(3);
        $pages = blog::leftjoin('blog_details', function ($join) {
            $join->on('blogs.id', '=', 'blog_details.blog_id');
        })
            ->where('blogs.slug', '=', $slug)
            ->where('blog_details.language_id', $lang_id->id)
            ->select('blogs.id', 'blogs.user_id', 'blogs.slug', 'blogs.status', 'blog_details.title', 'blog_details.short_description', 'blog_details.long_description', 'blog_details.language_id')
            ->get()->first();
        if ($pages != null) {
            $media = media::where('reference_id', $pages->id)->where('media.reference_type', '=', 'post')->get()->first();
            return view('Frontend/pages/index', compact('pages', 'media'));
        } else {
            return view('Frontend/pages/404');
        }
    }


    public function index(Request $request)
    {
        $languages = DefaultLanguage::GetSegment($request);
        return view('Frontend/blog/index', $languages);
    }

    public function singlePackage(Request $request)
    {
        $slug = $request->segment(3);
        $data_activity = [];
        $lang_id = Language::where('language_code', app()->getLocale())->get()->first();
        $data['currency'] = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        $data['single_package'] = Package::leftjoin('package_details', function ($join) {
            $join->on('packages.id', '=', 'package_details.package_id');
        })
            ->where('packages.slug', $slug)
            ->where('package_details.language_id', $lang_id->id)
            ->select('package_details.*', 'packages.id', 'packages.slug', 'packages.compare_price', 'packages.discount_price', 'packages.minimum_days', 'packages.maximum_days', 'packages.season_package', 'packages.category_id', 'packages.hotel_id', 'packages.theme_id', 'packages.inclusions', 'packages.exclusions', 'packages.activities', 'packages.faqs', 'packages.itineraries', 'packages.city', 'packages.select_package')
            ->get()->first();
        $data['media'] = media::where('reference_id', $data['single_package']->id)->where('reference_type', 'package')->get();
        $data['gallery'] = Gallery::where('package_id', $data['single_package']->id)->get();
        $data['holidays'] = Holidays::leftJoin('holiday_details', 'holidays.id', '=', 'holiday_details.holiday_id')
            ->leftJoin('media', 'holidays.id', '=', 'media.reference_id')
            ->where('media.reference_type', 'holidays')
            ->where('holiday_details.language_id', $lang_id->id)
            ->select('holidays.id', 'holiday_details.title', 'holiday_details.language_id', 'holiday_details.description', 'media.image')
            ->latest('holiday_details.created_at')->limit(4)->get();
        $category_id = category_package_pivot::where('package_id', $data['single_package']->id)->pluck('category_id')->toArray();
        $all_package = category_package_pivot::groupBy('package_id')->whereIn('category_id', $category_id)->pluck('package_id')->toArray();
        $data['hotels_star'] = HotelPackage::get()->groupBy('hotel_type');
        if (isset($all_package)) {
            $data['similarPackage'] = Package::where('packages.status', 1)->leftjoin('package_details', function ($join) {
                $join->on('packages.id', '=', 'package_details.package_id');
            })
                ->leftJoin('media', function ($join) {
                    $join->on('media.reference_id', '=', 'packages.id');
                })
                ->where('media.reference_type', 'package')
                ->where('package_details.language_id', $lang_id->id)
                ->whereIn('packages.id', $all_package)
                ->where('packages.id', '!=', $data['single_package']->id)
                ->select('package_details.*', 'packages.*', 'package_details.title', 'media.image')
                ->groupBy('packages.id')->get();
        }
        foreach ($data['similarPackage'] as $packages) {
            if ($packages->activities != null) {
                $data_activity[] = Activities::leftJoin('activities_pivot', 'activities_pivot.activity_id', 'activities.id')
                    ->leftJoin('media', 'activities.id', '=', 'media.reference_id')
                    ->where('media.reference_type', '=', 'activity')
                    ->whereIn('activities.id', json_decode($packages->activities, true))
                    ->where('activities_pivot.language_id', $lang_id->id)
                    ->select('activities.id', 'activities.status', 'activities_pivot.title', 'activities_pivot.language_id', 'media.image')
                    ->get();
            }
        }
        $data['similar_activity'] = $data_activity;
        if (isset($data['single_package']->activities)) {
            $data['activities'] = Activities::leftJoin('activities_pivot', 'activities_pivot.activity_id', 'activities.id')
                ->leftJoin('media', 'activities.id', '=', 'media.reference_id')
                ->where('media.reference_type', '=', 'activity')
                ->whereIn('activities.id', json_decode($data['single_package']->activities, true))
                ->where('activities_pivot.language_id', $lang_id->id)
                ->select('activities.id', 'activities.status', 'activities_pivot.title', 'activities_pivot.language_id', 'media.image')
                ->get();
        }
        if (isset($data['single_package']->hotel_id)) {
            $data['hotels'] = HotelPackage::leftJoin('hotel_details', 'hotel_details.hotel_id', 'hotel_packages.id')
                ->leftJoin('media', 'hotel_packages.id', '=', 'media.reference_id')
                ->where('media.reference_type', '=', 'hotel')
                ->whereIn('hotel_packages.id', json_decode($data['single_package']->hotel_id, true))
                ->where('hotel_details.language_id', $lang_id->id)
                ->select('hotel_details.*', 'hotel_packages.hotel_type', 'media.image')
                ->orderByRaw(DB::raw("FIELD(hotel_packages.id, ".implode(',', json_decode($data['single_package']->hotel_id)) . ")"))

                ->groupBy('hotel_details.hotel_id')->get();
        }
        if (isset($data['single_package']->faqs)) {
            $data['faqs'] = faqs::leftJoin('faqs_details', function ($join) {
                $join->on('faqs.id', '=', 'faqs_details.faqs_id');
            })
                ->whereIn('faqs.id', json_decode($data['single_package']->faqs, true))
                ->where('faqs_details.language_id', $lang_id->id)
                ->select('faqs_details.*')
                ->get();
        }
        if (isset($data['single_package']->inclusions)) {

            $data['inclusion'] = inclusion::leftJoin('inclusion_pivot', function ($join) {
                $join->on('inclusions.id', '=', 'inclusion_pivot.inc_exc_id');
            })
                ->whereIn('inclusions.id', json_decode($data['single_package']->inclusions, true))
                ->where('inclusions.type', 0)
                ->where('inclusion_pivot.language_id', $lang_id->id)
                ->select('inclusion_pivot.*')
                ->orderByRaw(DB::raw("FIELD(inclusions.id, ".implode(',', json_decode($data['single_package']->inclusions)) . ")"))
                ->get();
        }
        if (isset($data['single_package']->exclusions)) {
            $data['exclusion'] = inclusion::leftJoin('inclusion_pivot', function ($join) {
                $join->on('inclusions.id', '=', 'inclusion_pivot.inc_exc_id');
            })
                ->whereIn('inclusions.id', json_decode($data['single_package']->exclusions, true))
                ->where('inclusions.type', 1)
                ->where('inclusion_pivot.language_id', $lang_id->id)
                ->select('inclusion_pivot.*')
                ->orderByRaw(DB::raw("FIELD(inclusions.id, ".implode(',', json_decode($data['single_package']->exclusions)) . ")"))
                ->get();
        }
        if (isset($data['single_package']->city)) {
            $data['citys'] = City::leftJoin('city_details', 'cities.id', '=', 'city_details.city_id')
                ->whereIn('city_details.city_id', json_decode($data['single_package']->city, true))
                ->where('city_details.language_id', $lang_id->id)
                ->select('city_details.title', 'cities.id')
                ->get();
        }
        if (isset($data['single_package']->itineraries)) {
            $data['itinerarys'] = Itinerary::leftJoin('itinerary_details', 'itineraries.id', '=', 'itinerary_details.itinerary_id')
                ->whereIn('itineraries.id', json_decode($data['single_package']->itineraries, true))
                ->where('itinerary_details.language_id', $lang_id->id)
                ->select('itinerary_details.*', 'itineraries.id')
                ->orderByRaw(DB::raw("FIELD(itineraries.id, ".implode(',', json_decode($data['single_package']->itineraries)) . ")"))
                ->groupBy('itineraries.id')->get();

            $data['itinerary_media'] = media::whereIn('reference_id', json_decode($data['single_package']->itineraries, true))->where('reference_type', 'itinerary')->get();
        }
        if (isset($data['single_package']->season_package)) {
            $data['season_package'] = SeasonPackage::where('package_id', json_decode($data['single_package']->package_id, true))
                ->where('language_id', $lang_id->id)
                ->get();
        }

        return view('Frontend/package/single-package', $data);
    }

    public function enquireNow(Request $request)
    {
        $data = [
            'package_id' => $request->package_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];
        $enquireNow = EnquireNow::create($data);
        return redirect()->back()->with('success', 'EnquireNow Submit successfully');
    }

    public function helpPlanning(Request $request)
    {
        $help_data = [
            'help_planning' => $request->help_planning,
            'looking_for' => $request->looking_for,
            'suggested_destination' => $request->suggested_destination,
            'fixed_travel_date' => $request->fixed_travel_date,
            'firstname' => $request->firstname,
            'surname' => $request->surname,
            'birthdate' => $request->birthdate,
            'insurance_number' => $request->insurance_number,
            'family_status' => $request->family_status,
            'month' => $request->month,
            'street' => $request->street,
            'city' => $request->city,
            'post_code' => $request->post_code,
            'country' => $request->country,
            'email' => $request->email,
            'phone_code' => $request->phone_code,
            'mobile' => $request->mobile,
            'phone_num' => $request->phone_num,
        ];
        $HelpPlanning = HelpPlanning::create($help_data);
        return $HelpPlanning;
    }

    public function formPackage(Request $request)
    {
        $form_data = [
            'package_id' => $request->package_id,
            'city_to' => $request->city_to,
            'city_from' => $request->city_from,
            'exploring' => $request->exploring,
            'fixed_date' => $request->fixed_date,
            'flexible_date' => $request->flexible_date,
            'date_anytime' => $request->date_anytime,
            'number_of_days' => $request->number_of_days,
            'travel_ticket' => $request->travel_ticket,
            'email' => $request->email,
            'phone_code' => $request->phone_code,
            'phone' => $request->phone,
            'rating' => $request->rating,
            'yesnobtn' => $request->yesnobtn,
            'budgetvalue' => $request->budgetvalue,
            'adults_12_' => $request->adults_12_,
            'infant' => $request->infant,
            'adults_2_12' => $request->adults_2_12,
            'willbook' => $request->willbook,
            'yesnobtn' => $request->yesnobtn,
            'pkgdays' => $request->pkgdays,
            'timetocall' => $request->timetocall,
            'pkgtype' => $request->pkgtype,
            'additional_requirements' => $request->additional_requirements,
        ];
        $form_package = FormPackage::create($form_data);
        return $form_package;
    }

    public function Months(Request $request)
    {
        $language = DefaultLanguage::SelectedLanguage();
        $data['prices'] = SeasonPackage::where("id", $request->month_id)
            ->where("language_id", $language->id)
            ->pluck('price');
        $data['currency'] = $request->currency_id;
        $data['money'] = $request->money_id;

        return $data;
    }

    public function Checkout()
    {
        $lang_id = Language::where('language_code', app()->getLocale())->get()->first();
        $package = Package::leftjoin('package_details', function ($join) {
            $join->on('packages.id', '=', 'package_details.package_id');
        })->leftjoin('media', function ($join) {
            $join->on('packages.id', '=', 'media.reference_id');
        })
            ->where('media.reference_type', '=', 'package')
            ->where('packages.id', $_GET['id'])
            ->where('package_details.language_id', $lang_id->id)
            ->select('package_details.*', 'packages.id', 'packages.slug', 'packages.compare_price', 'packages.discount_price', 'packages.minimum_days', 'packages.maximum_days', 'packages.season_package', 'packages.category_id', 'packages.hotel_id', 'packages.theme_id', 'packages.inclusions', 'packages.exclusions', 'packages.activities', 'packages.faqs', 'packages.itineraries', 'packages.city', 'packages.select_package', 'media.image','media.reference_id')->groupby('media.reference_id')
            ->get()->first();
        $currency = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        return view('Frontend/checkout/index',compact('package','currency'));
    }

    public function DataCheckOut(Request $request)
    {
        $lang_id = Language::where('language_code', app()->getLocale())->get()->first();
        $shipping1 = [
            'user_id' => auth()->user()->id,
            'email' => $request->email,
            'email_me' => $request->email_me,
            'country' => $request->country,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'apartment' => $request->apartment,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'save_info' => $request->save_info,
            'text_me' => $request->text_me,
        ];
        $shipping = array (
                          'merchant_id' => '45990',
                          'order_id' => '123654789',
                          'amount' => $request->amount,
                          'currency' => $request->currency,
                          'redirect_url' => url('/package/payment-response'),
                          'cancel_url' => url('/package/payment-response'),
                          'language' => $request->language,
                          'billing_name' => $request->first_name.' '.$request->last_name,
                          'billing_address' => $request->address,
                          'billing_city' => $request->city,
                          'billing_state' => $request->state,
                          'billing_zip' => $request->postal_code,
                          'billing_country' => $request->country,
                          'billing_tel' => $request->phone,
                          'billing_email' => $request->email,
                          'delivery_name' => '',
                          'delivery_address' => '',
                          'delivery_city' => '',
                          'delivery_state' => '',
                          'delivery_zip' => '',
                          'delivery_country' => '',
                          'delivery_tel' => '',
                          'merchant_param1' => '',
                          'merchant_param2' => '',
                          'merchant_param3' => '',
                          'merchant_param4' => '',
                          'merchant_param5' => '',
                          'promo_code' => '',
                          'customer_identifier' => '',
                        );
        ShippingAddress::create($shipping1);
        return view('Frontend/checkout/redirect',compact('shipping'));
        //return redirect()->back()->with('success', 'Data Submitted Successfully!!!');
    }
    
    public function PaymentResponse()
    {
        dd('dfsdf');
        return view('Frontend/checkout/response');
    }
}
