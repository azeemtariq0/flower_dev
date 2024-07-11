<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Pagination\Paginator;
use App\Helpers\DefaultLanguage;
use App\Helpers\Paginate;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use App\Models\Language;
use App\Models\Currency;
use App\Models\User;
use App\Models\CustomPivot;
use App\Models\ProductSubCategory;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function Ramsey\Uuid\v1;
use Route;
use Carbon\Carbon;
use Session;
use DB;
use Cookie;
use App\Helper;

class UserDashboardController extends Controller
{
    public $perpage = 1;
    public function index()
    {
        $data['languages'] = DefaultLanguage::AllLanguage();
        $data_languages = DefaultLanguage::SelectedLanguage();
        $language = DefaultLanguage::GetSegment(app()->getLocale());
//        $data['currency'] = Currency::where('language_code', app()->getLocale())->get()->first();
        $data['currency'] = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        
        
        
        $data['products'] = Product::all();
        return view('Frontend/home/index', $data);
    }

    public function setCookie(Request $request)
    {
        $minutes = 2880;
        $cookie = cookie('popup', 1, $minutes);
        return response('Hello World' . $cookie)->cookie($cookie);
    }

    public function singleProduct($id){

        
        $data['product'] = Product::where('id',$id)->first();
        $data['related_products'] = Product::where('product_sub_category_id',$data['product']['sub_category'])->limit(8)->get();


        return view('Frontend/home/single', $data);


    }
    public function allPackages()
    {

        $data['language'] = Language::where('language_code', app()->getLocale())->get()->first();
//        $data['currency'] = Currency::where('language_code', app()->getLocale())->get()->first();
        $data['currency'] = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        $data['single'] = [];
        $data['faqs'] = [];
        $data['package'] = DB::table('packages')
            ->where('packages.status', 1)
            ->leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
            ->leftJoin('media', 'packages.id', '=', 'media.reference_id')
            ->where('media.reference_type', 'package')
            ->where('package_details.language_id', $data['language']->id)
            ->select('package_details.description', 'package_details.tags', 'media.image', 'package_details.title', 'packages.id',
                'packages.slug', 'packages.faqs', 'packages.compare_price', 'packages.discount_price', 'packages.minimum_days', 'packages.maximum_days', 'packages.country', 'packages.state', 'packages.city', 'packages.trending', 'packages.season_package','packages.hotel_id')->groupby('packages.id')->paginate(5);

        $data['categories'] = categories::leftJoin('category_details', 'categories.id', '=', 'category_details.category_id')
            ->where('categories.reference_type', 'package')
            ->where('category_details.language_id', $data['language']->id)
            ->select('categories.id', 'categories.slug', 'category_details.*')
            ->get();
        $data['activities'] = Activities::leftJoin('activities_pivot', 'activities.id', '=', 'activities_pivot.activity_id')
            ->where('activities_pivot.language_id', $data['language']->id)
            ->select('activities.id', 'activities.slug', 'activities_pivot.*')
            ->get();
        $data['inclusions'] = inclusion::leftJoin('inclusion_pivot', 'inclusions.id', '=', 'inclusion_pivot.inc_exc_id')
            ->where('inclusion_pivot.language_id', $data['language']->id)
            ->where('inclusions.type', 0)
            ->select('inclusions.id', 'inclusion_pivot.*')
            ->get();
        $data['holidays'] = DB::table('packages')
            ->where('packages.status', 1)
            ->leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
            ->leftJoin('media', 'packages.id', '=', 'media.reference_id')
            ->where('media.reference_type', 'package')
            ->where('packages.trending', '1')
            ->where('package_details.language_id', $data['language']->id)
            ->select('package_details.*', 'media.image', 'packages.id', 'packages.compare_price', 'packages.discount_price', 'packages.slug')
            ->groupby('media.reference_id')
            ->get();
        $data['cities'] = City::leftJoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->where('city_details.language_id', $data['language']->id)
            ->select('city_details.title', 'cities.id')
            ->get();
        $data['reviews'] = HotelReviews::leftJoin('packages', 'packages.id', '=', 'hotel_reviews.package_id')
            ->leftJoin('users', 'users.id', '=', 'hotel_reviews.user_id')
            ->where('packages.status', 1)
            ->where('hotel_reviews.status', 1)->select('users.name', 'packages.title', 'hotel_reviews.comment', 'hotel_reviews.rating')->get();
        $data['months'] = Package::where('status', 1)->groupBy('season_package')->get();
        $data['blogs'] = OrderController::FetchAndSaveData();
        return view('Frontend/collection/index', $data);
    }

    public function allTheme(Request $request)
    {
        $slug = $request->segment(2);
        $data['slug'] = $slug;
        $data['faqs'] = [];
        $data['language'] = Language::where('language_code', app()->getLocale())->get()->first();
//        $data['currency'] = Currency::where('language_code', app()->getLocale())->get()->first();
        $data['currency'] = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        
       
        // $data['categories'] = categories::leftJoin('category_details', 'categories.id', '=', 'category_details.category_id')
        //     ->where('categories.reference_type', 'package')
        //     ->where('category_details.language_id', $data['language']->id)
        //     ->select('categories.id', 'categories.slug', 'category_details.*')
        //     ->get();
        
          
        
        // $data['months'] = Package::groupBy('season_package')->get();
        // $data['blogs'] = OrderController::FetchAndSaveData();
        return view('Frontend/collection/index', $data);
    }

    public function allCategory(Request $request)
    {
        $data['city_id']  = null;
        $slug = $request->segment(3);
        $data['faqs'] = [];
        $data['slug'] = $slug;
        $data['language'] = Language::where('language_code', app()->getLocale())->get()->first();
//        $data['currency'] = Currency::where('language_code', app()->getLocale())->get()->first();
        $data['currency'] = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        $data['single'] = City::leftjoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->where('cities.slug', $slug)->where('city_details.language_id', $data['language']->id)->select('cities.id', 'cities.title')->first();
        if (isset($data['single'])) {
            $package_pivot = CityPackagePivot::where('city_id', $data['single']->id)->groupBy('package_id')->pluck('package_id')->toArray();
            $data['city_id'] = $data['single']->id;

            $package = DB::table('packages')->leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
                ->leftJoin('media', 'packages.id', '=', 'media.reference_id')
                ->where('media.reference_type', 'package')
                ->whereIn('packages.id', $package_pivot)
                ->where('package_details.language_id', $data['language']->id);


            $city_package = CityPackagePivot::where('package_id', $package_pivot)->groupBy('city_id')->pluck('city_id')->toArray();
            $data['cityss'] = City::leftJoin('city_details', 'cities.id', '=', 'city_details.city_id')
                ->whereIn('cities.id', $city_package)
                ->where('city_details.language_id', $data['language']->id)
                ->where('cities.id', '!=', $data['single']->id)
                ->select('city_details.title', 'cities.slug', 'cities.id')
                ->get();
        } else {
            $package = Package::where('packages.status', 1)->leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
                ->leftJoin('media', 'packages.id', '=', 'media.reference_id')
                ->where('media.reference_type', 'package')
                ->where('package_details.language_id', $data['language']->id);
        }
        if (isset($request->month)) {
            $package->where('packages.season_package', $request->month);
        }
        if (isset($request->days)) {
            foreach ($request->days as $day) {
                $lol = explode('-', $day);
                $minDuration[] = $lol[0];
                $maxDuration[] = $lol[1];
            }

            for ($i = min($minDuration); $i <= max($minDuration); $i++) {
                $minDurationfil[] = (int)$i;
            }
            for ($x = min($maxDuration); $x <= max($maxDuration); $x++) {
                $maxDurationfil[] = (int)$x;
            }
            $package = $package->whereIn('maximum_days', $maxDurationfil);
            $package = $package->whereIn('minimum_days', $minDurationfil);
        }

        $data['package'] = $package->select('package_details.description', 'package_details.tags', 'media.image', 'package_details.title', 'packages.id', 'packages.slug', 'packages.faqs', 'packages.compare_price', 'packages.discount_price', 'packages.minimum_days', 'packages.maximum_days', 'packages.country', 'packages.state', 'packages.city', 'packages.trending', 'packages.season_package','packages.hotel_id')->groupby('packages.id')->paginate(5);
        $data['categories'] = categories::leftJoin('category_details', 'categories.id', '=', 'category_details.category_id')
            ->where('categories.reference_type', 'package')
            ->where('category_details.language_id', $data['language']->id)
            ->select('categories.id', 'categories.slug', 'category_details.*')
            ->get();
        $data['activities'] = Activities::leftJoin('activities_pivot', 'activities.id', '=', 'activities_pivot.activity_id')
            ->where('activities_pivot.language_id', $data['language']->id)
            ->select('activities.id', 'activities.slug', 'activities_pivot.*')
            ->get();
        $data['inclusions'] = inclusion::leftJoin('inclusion_pivot', 'inclusions.id', '=', 'inclusion_pivot.inc_exc_id')
            ->where('inclusion_pivot.language_id', $data['language']->id)
            ->where('inclusions.type', 0)
            ->select('inclusions.id', 'inclusion_pivot.*')
            ->get();
        $data['holidays'] = DB::table('packages')
            ->leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
            ->leftJoin('media', 'packages.id', '=', 'media.reference_id')
            ->where('packages.status', 1)
            ->where('media.reference_type', 'package')
            ->where('packages.trending', '1')
            ->where('package_details.language_id', $data['language']->id)
            ->select('package_details.*', 'media.image', 'packages.id', 'packages.compare_price', 'packages.discount_price', 'packages.slug')
            ->groupby('media.reference_id')
            ->get();
        $data['cities'] = City::leftJoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->where('city_details.language_id', $data['language']->id)
            ->select('city_details.title', 'cities.slug', 'cities.id')
            ->get();
        $data['reviews'] = HotelReviews::leftJoin('packages', 'packages.id', '=', 'hotel_reviews.package_id')
            ->leftJoin('users', 'users.id', '=', 'hotel_reviews.user_id')
            ->where('hotel_reviews.status', 1)->select('users.name', 'packages.title', 'hotel_reviews.comment', 'hotel_reviews.rating')->get();
        if (isset($_GET['search_form'])) {
            $data['search_form'] = $_GET['search_form'];
        }

        $data['citys'] = City::leftJoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->where('city_details.language_id', $data['language']->id)
            ->select('city_details.title', 'cities.slug', 'cities.id')
            ->get();
        $data['months'] = Package::groupBy('season_package')->get();
        $data['blogs'] = OrderController::FetchAndSaveData();
        return view('Frontend/collection/index', $data);
    }

    public function Category(Request $request)
    {
        $data['categories'] = ProductCategory::with('sub_category')->get();

        // dd($data['categories'],true);
        $data['products'] = Product::all();
        $data['languages'] = DefaultLanguage::AllLanguage();
        $data_languages = DefaultLanguage::SelectedLanguage();
        $language = DefaultLanguage::GetSegment(app()->getLocale());
        $data['currency'] = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        return view('Frontend/home/products', $data);
    }

    public function checkout(Request $request)
    {

       $cart = session()->get('cart');
      if(empty($cart)){
        return redirect('/');
      }
      $data['products'] = Product::all();
        return view('Frontend/home/checkout', $data);
    }  

    public function shoppingCart(Request $request)
    {
         $cart = session()->get('cart');
      if(empty($cart)){
        return redirect('/');
      }
        $data['products'] = Product::all();
        return view('Frontend/home/shopping_cart', $data);
    }


    public function ourProduct(Request $request)
    {
        dd(1); 
        $data['products'] = Product::all();
        $data['languages'] = DefaultLanguage::AllLanguage();
        $data_languages = DefaultLanguage::SelectedLanguage();
        $language = DefaultLanguage::GetSegment(app()->getLocale());
//        $data['currency'] = Currency::where('language_code', app()->getLocale())->get()->first();
        $data['currency'] = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        
        
        return view('Frontend/home/products', $data);
    }


        public function cart()
    {
        return view('cart');
    }
    public function AddToCart($id)
    {

        $product = Product::findOrFail($id);

          
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->product_name,
                "quantity" => 1,
                "price" => 300,// $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);


         return \Response::json(['cart'=>$cart], 200);
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

     public function removeCartItem(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }
    public function Collections(Request $request)
    {

        $slug = $request->segment(3);
        $data['faqs'] = [];
        $data['language'] = Language::where('language_code', app()->getLocale())->get()->first();
//        $data['currency'] = Currency::where('language_code', app()->getLocale())->get()->first();
        $data['currency'] = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        $package = Package::where('packages.status', 1);


//       Filteration
        if (isset($request->categories) && $request->categories != null) {
            $myArray = explode(',', $request->categories);
            $categories = categories::whereIn('categories.slug', $myArray)->get()->pluck('id');
            $package_id = DB::table('category_package_pivots')->whereIn('category_id', $categories)->get()->pluck('package_id');
            $package = $package->whereIn('packages.id', $package_id);
        } else {
            $categories = categories::where('categories.slug', $slug)->get()->pluck('id');
            $package_id = DB::table('category_package_pivots')->whereIn('category_id', $categories)->get()->pluck('package_id');
            $package = $package->whereIn('packages.id', $package_id);

        }

        $package = $package->leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
            ->leftJoin('media', 'packages.id', '=', 'media.reference_id')
            ->where('media.reference_type', 'package')
            ->where('package_details.language_id', $data['language']->id)
            ->select('package_details.title', 'package_details.description', 'package_details.tags', 'media.image', 'packages.id', 'packages.slug', 'packages.discount_price', 'packages.compare_price','packages.city',  'packages.minimum_days', 'packages.maximum_days','packages.hotel_id')
            ->groupby('packages.id')
            ->paginate(5);
        $data['package'] = $package;
        if (isset($data['single']->faqs)) {
            $data['faqs'] = faqs::leftJoin('faqs_details', function ($join) {
                $join->on('faqs.id', '=', 'faqs_details.faqs_id');
            })
                ->whereIn('faqs.id', json_decode($data['single']->faqs, true))
                ->where('faqs_details.language_id', $data['language']->id)
                ->select('faqs_details.*')
                ->get();
        }

        if (isset($data['single']->city) && $data['single']->city != "null") {
            $data['cityss'] = City::leftjoin('city_details', 'cities.id', '=', 'city_details.city_id')
                ->where('city_details.language_id', $data['language']->id)
                ->whereIn('city_details.city_id', json_decode($data['single']->city, true))->get();
        }

        $data['categories'] = categories::leftJoin('category_details', 'categories.id', '=', 'category_details.category_id')
            ->where('categories.reference_type', 'package')
            ->where('category_details.language_id', $data['language']->id)
            ->select('categories.id', 'categories.slug', 'category_details.*')
            ->get();
        $data['activities'] = Activities::leftJoin('activities_pivot', 'activities.id', '=', 'activities_pivot.activity_id')
            ->where('activities_pivot.language_id', $data['language']->id)
            ->select('activities.id', 'activities.slug', 'activities_pivot.*')
            ->get();
        $data['inclusions'] = inclusion::leftJoin('inclusion_pivot', 'inclusions.id', '=', 'inclusion_pivot.inc_exc_id')
            ->where('inclusion_pivot.language_id', $data['language']->id)
            ->where('inclusions.type', 0)
            ->select('inclusions.id', 'inclusion_pivot.*')
            ->get();
        $data['holidays'] = DB::table('packages')
            ->leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
            ->leftJoin('media', 'packages.id', '=', 'media.reference_id')
            ->where('packages.status', 1)
            ->where('media.reference_type', 'package')
            ->where('packages.trending', '1')
            ->where('package_details.language_id', $data['language']->id)
            ->select('package_details.*', 'media.image', 'packages.id', 'packages.compare_price', 'packages.discount_price', 'packages.slug')
            ->groupby('media.reference_id')
            ->get();
        $data['cities'] = City::leftJoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->where('city_details.language_id', $data['language']->id)
            ->select('city_details.title', 'cities.slug', 'cities.id')
            ->get();
        $data['reviews'] = HotelReviews::leftJoin('packages', 'packages.id', '=', 'hotel_reviews.package_id')
            ->leftJoin('users', 'users.id', '=', 'hotel_reviews.user_id')
            ->where('hotel_reviews.status', 1)->select('users.name', 'packages.title', 'hotel_reviews.comment', 'hotel_reviews.rating')->get();
        $city_package = CityPackagePivot::groupBy('city_id')->pluck('city_id')->toArray();
        $data['citys'] = City::leftJoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->whereIn('cities.id', $city_package)
            ->where('city_details.language_id', $data['language']->id)
            ->select('city_details.title', 'cities.slug', 'cities.id')
            ->get();
        $data['months'] = Package::groupBy('season_package')->get();
        $data['blogs'] = OrderController::FetchAndSaveData();
        $data['slug'] = $slug;
        return view('Frontend/collection/index', $data);
    }


    public function allCollection(Request $request)
    {
        $slug = $request->segment(3);
        $data['slug'] = $slug;
        $data['faqs'] = [];
        $data['language'] = Language::where('language_code', app()->getLocale())->get()->first();
//        $data['currency'] = Currency::where('language_code', app()->getLocale())->get()->first();
        $data['currency'] = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        $state = StatePivot::where('id', $slug)->where('language_id', $data['language']->id)->get()->first();
        $data['single'] = DB::table('packages')->leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
            ->leftJoin('media', 'packages.id', '=', 'media.reference_id')
            ->where('media.reference_type', 'package')
            ->where('packages.state', $state->id)
            ->where('package_details.language_id', $data['language']->id)->select('package_details.description', 'package_details.tags', 'media.image', 'package_details.title', 'packages.id', 'packages.slug', 'packages.faqs', 'packages.compare_price', 'packages.discount_price', 'packages.minimum_days', 'packages.maximum_days', 'packages.country', 'packages.state', 'packages.city', 'packages.trending', 'packages.season_package')->groupby('packages.id')->get()->first();
        if (isset($data['single']->city) && $data['single']->city != "null") {
            $data['cityss'] = City::leftjoin('city_details', 'cities.id', '=', 'city_details.city_id')
                ->where('city_details.language_id', $data['language']->id)
                ->whereIn('city_details.city_id', json_decode($data['single']->city, true))->get();
        }

        if (isset($data['single']->faqs)) {
            $data['faqs'] = faqs::leftJoin('faqs_details', function ($join) {
                $join->on('faqs.id', '=', 'faqs_details.faqs_id');
            })
                ->whereIn('faqs.id', json_decode($data['single']->faqs, true))
                ->where('faqs_details.language_id', $data['language']->id)
                ->select('faqs_details.*')
                ->get();
        }
        if (isset($data['single']->category_id)) {
            $data['similarPackage'] = Package::leftjoin('package_details', function ($join) {
                $join->on('packages.id', '=', 'package_details.package_id');
            })
                ->leftJoin('media', function ($join) {
                    $join->on('media.reference_id', '=', 'packages.id');
                })
                ->where('media.reference_type', 'package')
                ->where('packages.id', '!=', $data['single']->id)
                ->where('packages.category_id', $data['single']->category_id)
                ->where('package_details.language_id', $data['language']->id)
                ->select('package_details.*', 'packages.*', 'package_details.title', 'media.image')
                ->groupBy('packages.id')->get();
        }
        $data['categories'] = categories::leftJoin('category_details', 'categories.id', '=', 'category_details.category_id')
            ->where('categories.reference_type', 'package')
            ->where('category_details.language_id', $data['language']->id)
            ->select('categories.id', 'categories.slug', 'category_details.*')
            ->get();
        $data['package'] = DB::table('packages')
            ->where('packages.status', 1)
            ->leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
            ->leftJoin('media', 'packages.id', '=', 'media.reference_id')
            ->where('media.reference_type', 'package')
            ->where('packages.state', $state->id)
            ->where('package_details.language_id', $data['language']->id)
            ->select('package_details.description', 'package_details.tags', 'media.image', 'package_details.title', 'packages.id',
                'packages.slug', 'packages.faqs', 'packages.compare_price', 'packages.discount_price', 'packages.minimum_days', 'packages.maximum_days', 'packages.country', 'packages.state', 'packages.city', 'packages.trending', 'packages.season_package','packages.hotel_id')->groupby('packages.id')->paginate(5);
        $data['activities'] = Activities::leftJoin('activities_pivot', 'activities.id', '=', 'activities_pivot.activity_id')
            ->where('activities_pivot.language_id', $data['language']->id)
            ->select('activities.id', 'activities.slug', 'activities_pivot.*')
            ->get();
        $data['inclusions'] = inclusion::leftJoin('inclusion_pivot', 'inclusions.id', '=', 'inclusion_pivot.inc_exc_id')
            ->where('inclusion_pivot.language_id', $data['language']->id)
            ->where('inclusions.type', 0)
            ->select('inclusions.id', 'inclusion_pivot.*')
            ->get();
        $data['holidays'] = DB::table('packages')
            ->leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
            ->leftJoin('media', 'packages.id', '=', 'media.reference_id')
            ->where('media.reference_type', 'package')
            ->where('packages.status', 1)
            ->where('packages.trending', '1')
            ->where('package_details.language_id', $data['language']->id)
            ->select('package_details.*', 'media.image', 'packages.id', 'packages.compare_price', 'packages.discount_price', 'packages.slug')
            ->groupby('media.reference_id')
            ->get();

        $data['cities'] = City::leftJoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->where('city_details.language_id', $data['language']->id)
            ->select('city_details.title', 'cities.slug', 'cities.id')
            ->get();
        $data['reviews'] = HotelReviews::leftJoin('packages', 'packages.id', '=', 'hotel_reviews.package_id')
            ->leftJoin('users', 'users.id', '=', 'hotel_reviews.user_id')
            ->where('hotel_reviews.status', 1)->select('users.name', 'packages.title', 'hotel_reviews.comment', 'hotel_reviews.rating')->get();
        $data['citys'] = City::leftJoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->where('city_details.language_id', $data['language']->id)
            ->select('city_details.title', 'cities.slug', 'cities.id')
            ->get();
        $data['months'] = Package::groupBy('season_package')->get();
        $data['blogs'] = OrderController::FetchAndSaveData();
        return view('Frontend/collection/index', $data);
    }

    public function getCollection(Request $request)
    {
//        dd($request);
        $langauge = Language::where('language_code', app()->getLocale())->get()->first();
        $blogs = OrderController::FetchAndSaveData();
        $currency = Currency::where('language_code', app()->getLocale())->get()->first();
        $currency = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        $package = Package::where('packages.status', 1);
        if (isset($request->categories) && $request->categories != null) {
//            $myArray = explode(',', $request->category[0]);
            $categories = categories::whereIn('categories.slug', $request->categories)->get()->pluck('id');
            $package_id = DB::table('category_package_pivots')->whereIn('category_id', $categories)->get()->pluck('package_id');
            $package = $package->whereIn('packages.id', $package_id);
        }
        if (isset($request->duration) && $request->duration != null) {
//            $days = explode(',', $request->days[0]);
            $rangeArray = $request->duration; // Original range array
            $numbers = [];
            foreach ($rangeArray as $range) {
                [$start, $end] = explode('-', $range);
                $numbers = array_merge($numbers, range($start, $end));
            }
            foreach ($request->duration as $day) {
                $lol = explode('-', $day);
                $minDuration[] = $lol[0];
                $maxDuration[] = $lol[1];
            }
            $package->whereIn('packages.maximum_days', $numbers);
        }


        if (isset($request->price_range) && $request->price_range != null) {
//            $price = explode(',', $request->price_range);

            $lol = explode('-', $request->price_range[0]);
            $minRange = $lol[0];
            $maxRange = $lol[1];
            $package->whereBetween('packages.compare_price', [$minRange, $maxRange]);
        }


        if (isset($request->rating) && $request->rating != null) {
//            $ratingArray = explode(',', $request->rating_id[0]);
            $hotels = HotelPackage::whereIn('hotel_type', $request->rating)->get()->pluck('id');
            if (count($hotels) > 0) {
                foreach ($hotels as $hotel) {
                    $package = $package->whereJsonContains('hotel_id', (string)$hotel);
                }
            } else {
                $package = null;
            }
        }
        if (isset($request->activities) && $request->activities != null) {
//            $activityArray = explode(',', $request->activities[0]);
            $activitys = Activities::whereIn('slug', $request->activities)->get()->pluck('id');
            if (count($activitys) > 0) {
                foreach ($activitys as $activity) {
                    $package = $package->whereJsonContains('activities', (string)$activity);
                }
            } else {
                $package = null;
            }
        }
        if (isset($request->inclusion_id) && $request->inclusion_id[0] != 'all' && $request->inclusion_id[0] != null) {
            $inclusionsArray = explode(',', $request->inclusion_id[0]);
            $inclusions = inclusionPivot::whereIn('id', $inclusionsArray)->where('language_id', $langauge->id)->get()->pluck('inc_exc_id');
            if (count($inclusions) > 0) {
                foreach ($inclusions as $inclusion) {
                    $package = $package->whereJsonContains('inclusions', (string)$inclusion);
                }
            } else {
                $package = null;
            }
        }
        if (isset($request->cities) && $request->cities != null) {
//            $myArray = explode(',', $request->cities[0]);
            $cities = CityDetail::whereIn('city_id', $request->cities)->where('language_id', $langauge->id)->get()->pluck('city_id');
            if (count($cities) > 0) {
                foreach ($cities as $citie) {
//                    dd($citie);
                    $package = $package->whereJsonContains('city', (string)$citie);
                }
            } else {
                $package = null;
            }
        }

        if (isset($request->state) && $request->state != null) {
                    $package = $package->where('state', $request->state);

        }
        if (isset($package)) {
            $package->leftJoin('media', 'packages.id', '=', 'media.reference_id')->where('media.reference_type', 'package');
            $package->leftJoin('package_details', 'packages.id', '=', 'package_details.package_id')->where('package_details.language_id', $langauge->id);
            $package->select(
                'packages.id',
                'package_details.title',
                'packages.status',
                'packages.minimum_days',
                'packages.maximum_days',
                'packages.slug',
                'packages.category_id',
                'packages.compare_price',
                'package_details.language_id',
                'packages.select_package',
                'packages.discount_price',
                'packages.city',
                'packages.state',
                'packages.hotel_id',
                'package_details.tags',
                'media.image',
                'media.reference_id')->groupby('media.reference_id');
            if (isset($request->sort) && ($request->sort === 'price_low_to_high')) {
                $package->orderBy('packages.compare_price', 'asc');
            }
            if (isset($request->sort) && ($request->sort === 'price_high_to_low')) {
                $package->orderBy('packages.compare_price', 'desc');
            }
            if (isset($request->sort) && ($request->sort === 'duration_low_to_high')) {
                $package->orderBy('packages.minimum_days', 'asc');
            }
            if (isset($request->sort) && ($request->sort === 'duration_high_to_low')) {
                $package->orderBy('packages.maximum_days', 'desc');
            }
            if (isset($request->sort) && ($request->sort === 'popularity')) {
                $package->orderBy('packages.created_at', 'desc');
            }
            $package = $package->paginate(5);
        }


        return view('Frontend/snippets/package-view', compact('package', 'currency'));
    }


//    public function filteration($request)
//    {
//
//    }
    public function sendEmail(Request $request)
    {
        $data = Newsletter::where('email', $request->email)->get()->first();
        if ($data == null) {
            $data = ['email' => $request->email];
            Newsletter::create($data);
            return "true";
        } else {
            return "false";
        }

    }

    public function CommentPost(Request $request)
    {

        if (isset($request->ReferenceId) && $request->ReferenceType) {
            if ($request->file('image')) {
                $mainext = $request->file('image')->getClientOriginalExtension();
                $main_file = time() . rand(1000, 14000000000) . '.' . $mainext;
                $request->image->move(public_path('images/comment/' . $request->ReferenceType), $main_file);
            } else {
                $main_file = null;
            }

            $ReferenceId = base64_decode($request->ReferenceId);
            $data = [
                'reference_type' => $request->ReferenceType,
                'reference_id' => (int)$ReferenceId,
                'user_id' => Auth::user()->id,
                'comments' => $request->comment,
                'type' => 'comment',
                'image' => $main_file
            ];
            DB::table('reactions')->insert($data);
            return redirect()->back()->with('success', 'Category Created successfully');

        } else {
            return redirect()->back()->with('wrong', 'Unknown Error! Missing Parameter');

        }

    }

    public function LikePost(Request $request)
    {
        $data = [
            'reference_type' => $request->type,
            'reference_id' => $request->id,
            'user_id' => Auth::user()->id,
            'type' => $request->reaction,

        ];
        $wow = DB::table('reactions')->insert($data);
        if ($wow) {
            $like = DB::table('reactions')
                ->where('type', $request->reaction)
                ->where('reference_type', $request->type)
                ->where('reference_id', $request->id)->get();
            return count($like);
        }
    }

    public function DislikePost(Request $request)
    {
        DB::table('reactions')
            ->where('type', $request->reaction)
            ->where('user_id', auth()->user()->id)
            ->where('reference_type', $request->type)
            ->where('reference_id', $request->id)->delete();
        $like = DB::table('reactions')
            ->where('type', $request->reaction)
            ->where('reference_type', $request->type)
            ->where('reference_id', $request->id)->get();
        return count($like);

    }

    public function activity()
    {
        $activity = DB::table('reactions')
            ->where(['type' => 'comment', 'reference_type' => 'blog'])->where('reactions.user_id', auth()->user()->id)
            ->join('blogs', 'reactions.reference_id', '=', 'blogs.id')
            ->select('reactions.*', 'blogs.title', 'blogs.slug', 'blogs.image', 'blogs.id')
            ->get()->groupby('reactions.reference_id');

        $coupon = DB::table('reactions')
            ->where('type', 'comment')->where('reactions.user_id', auth()->user()->id)
            ->where('reactions.reference_type', 'coupon')
            ->join('media', 'reactions.reference_id', '=', 'media.reference_id')
            ->join('coupons', 'reactions.reference_id', '=', 'coupons.id')
            ->select('reactions.created_at', 'reactions.reference_id', 'coupons.title', 'coupons.slug', 'coupons.regular_price',
                'coupons.compare_price', 'coupons.id', 'media.image')
            ->get()->groupby('reactions.reference_id');


        $comments = Reaction::where('type', 'comment')->get();

        return view('Frontend/dashboard/activity/index', compact('activity', 'coupon', 'comments'));

    }

    public function wishList()
    {

        $reactions = DB::table('reactions')
            ->where(['type' => 'wishlist', 'reference_type' => 'coupon',
                'user_id' => auth()->user()->id])
            ->join('coupons', 'reactions.reference_id', '=', 'coupons.id')
            ->select('coupons.title', 'coupons.regular_price', 'coupons.compare_price', 'coupons.id', 'coupons.expiry_date')
            ->get();

        $media = media::get();

        return view('Frontend/dashboard/wishlist/index', compact('reactions', 'media'));

    }

    public function myProfile()
    {
        $data = User::where('id', Auth()->user()->id)->get();
        return view('Frontend/dashboard/profile/index', compact('data'));

    }

    public function updateprofile(Request $request, $id)
    {
        $users = User::where('id', $id)->get()->first();

        if ($request->file('image')) {

            $ext = $request->file('image')->getClientOriginalExtension();
            $main_file = time() . rand(1000, 14000000000) . '.' . $ext;
            $request->image->move(public_path('images/profile'), $main_file);
        } else {
            $main_file = $users->image;
        }

        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'image' => $main_file,

        ]);

        return redirect()->back()->with('success', 'Profile updated succesfully');

    }

    public function password()
    {
        return view('Frontend/dashboard/profile/password');
    }

    public function updatePassword(Request $request, $id)
    {
        $data = User::where('id', $id)->get()->first();
        $this->validate($request, [

            'password' => 'required',
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
            'confirm_password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
        ]);
        $hashedPassword = auth()->user()->password;
        if (Hash::check($request->password, $hashedPassword)) {
            if (Hash::check($request->new_password, $hashedPassword)) {
                return redirect()->back()->with('wrong', 'New Password & Current Password are same, please try again.');
            } else {
                if ($request->new_password == $request->confirm_password) {
                    $data->update([
                        'password' => Hash::make($request->new_password)
                    ]);
                    return redirect()->back()->with('success', 'Password Updated Successfully.');
                } else {
                    return redirect()->back()->with('wrong', 'New Password & Confirm Password  do not match, please try again.');
                }
            }
        } else {
            return redirect()->back()->with('wrong', 'You Entered a Wrong Current Password');
        }
    }

//Reviews
    public function Reviews(Request $request)
    {
        $data = [
            "user_id" => auth()->user()->id,
            "package_id" => $request->package_id,
            "rating" => $request->rating,
            "name" => $request->name,
            "email" => $request->email,
            'comment' => $request->comment,
        ];
        $hotel_review = HotelReviews::create($data);
        if ($request->rating > 1) {
            return redirect()->back()->with('success', 'Thanks! You rated this ' . $request->rating . ' stars');
        } else {
            return redirect()->back()->with('success', 'We will improve ourselves. You rated this ' . $request->rating . ' stars');
        }
    }


//Filter
    public function allFilter(Request $request)
    {

        $lang_id = Language::where('language_code', $request->lang_id)->get()->first();
        $packages = Package::where('packages.status', 1);
        if (isset($request->search_selling)) {

            $country = CountryDetail::where('title', 'LIKE', '%' . 'United Arab Emirates' . '%')->get()->first();
            if (isset($request->sell_for) != null) {

                if (count($request->sell_for) == 2 || count($request->sell_for) == 0) {
                    $packages = Package::where('packages.status', 1)->where('packages.country', '!=', null);
                } else {
                    if (in_array('international', $request->sell_for)) {
                        $packages = Package::where('packages.status', 1)->where('packages.country', '!=', $country->country_id);
                    }
                    if (in_array('United Arab Emirates', $request->sell_for)) {
                        $packages = Package::where('packages.status', 1)->where('packages.country', $country->country_id);
                    }
                }
                $packages = $packages->groupBy('state')->pluck('state')->toArray();
            } else {
                $packages = Package::where('packages.status', 1)->where('packages.country', '!=', $country->country_id)->groupBy('state')->pluck('state')->toArray();
            }

            $days_range = explode('-', $request->search_selling);
            $minDays = $days_range[0];
            $maxDays = $days_range[1];
            $package = [];
            $data['duration'] = $request->search_selling;
            foreach ($packages as $packag) {
                $packagss = Package::where('packages.status', 1)->where('state', $packag)->where('package_type', 1)->whereBetween('minimum_days', [$minDays, $maxDays])->orderBy('discount_price', 'asc')->get()->first();
                if ($packagss != null) {
                    $state = StatePivot::where('id', $packag)->get()->first();
                    $total = Package::where('packages.status', 1)->where('state', $packag)->get()->count();
                    $package_detail = PackageDetail::where('package_id', $packagss->id)->where('language_id', $lang_id->id)->get()->first();
                    $data_languages = DefaultLanguage::SelectedLanguage();
                    if ($package_detail == null) {
                        $package_detail = PackageDetail::where('package_id', $packagss->id)->where('language_id', $data_languages->id)->get()->first();
                    }
                    $media = media::where('reference_id', $packagss->id)->where('reference_type', 'package')->get()->first();
                    $package[] = [
                        'id' => $packagss->id,
                        'slug' => $state->id,
                        'compare_price' => $packagss->compare_price,
                        'discount_price' => $packagss->discount_price,
                        'minimum_days' => $packagss->minimum_days,
                        'maximum_days' => $packagss->maximum_days,
                        'state' => $packagss->state,
                        'season_package' => $packagss->season_package,
                        'media' => $media->image,
                        'title' => $state->title,
                        'description' => $package_detail->description,
                        'tags' => $package_detail->tags,
                        'count' => $total
                    ];
                }
            }
            $data['package'] = $package;
            $data['currency'] = Currency::where('language_code', $request->lang_id)->get()->first();
            return view('Frontend/snippets/search-selling', $data);
        }
        if (isset($request->search_best)) {

            $days_range = explode('-', $request->search_best);
            $minDays = $days_range[0];
            $maxDays = $days_range[1];
            $packages->leftJoin('package_details', function ($join) {
                $join->on('package_details.package_id', '=', 'packages.id');
            })
                ->leftJoin('media', function ($join) {
                    $join->on('packages.id', '=', 'media.reference_id');
                })
                ->where('packages.package_type', 0)
                ->where('media.reference_type', '=', 'package')
                ->where('package_details.language_id', $lang_id->id)
                ->whereBetween('minimum_days', [(int)$minDays, (int)$maxDays]);
//                ->where('packages.minimum_days', '>=', $minDays)->where('packages.maximum_days', '<=', $maxDays);
        }
        if (isset($request->search_price)) {
            $price_range = explode('-', $request->search_price);
            $minPrice = $price_range[0];
            $maxPrice = $price_range[1];
            $packages->leftJoin('package_details', function ($join) {
                $join->on('package_details.package_id', '=', 'packages.id');
            })
                ->leftJoin('media', function ($join) {
                    $join->on('packages.id', '=', 'media.reference_id');
                })
                ->where('media.reference_type', '=', 'package')
                ->where('package_details.language_id', $lang_id->id)
                ->whereBetween('packages.compare_price', [$minPrice, $maxPrice]);
        }
        if (isset($request->search_month)) {
            $month_range = explode('-', $request->search_month);
            $packages->leftJoin('package_details', function ($join) {
                $join->on('package_details.package_id', '=', 'packages.id');
            })
                ->leftJoin('media', function ($join) {
                    $join->on('packages.id', '=', 'media.reference_id');
                })
                ->where('media.reference_type', '=', 'package')
                ->where('package_details.language_id', $lang_id->id)
                ->whereIn('packages.season_package', $month_range);
        }

        $packages->select(
            'packages.id',
            'packages.slug',
            'packages.compare_price',
            'packages.discount_price',
            'package_details.title',
            'package_details.language_id',
            'packages.minimum_days',
            'packages.maximum_days',
            'packages.city',
            'packages.hotel_id',
            'package_details.description',
            'media.image',
            'media.reference_id',
            'packages.season_package'
        );


        $currency = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
//        $currency = Currency::where('language_code', $request->lang_id)->get()->first();
        if (isset($request->search_price)) {
            $priced_package = $packages->groupBy('media.reference_id')->get();
            return view('Frontend/snippets/search-price', compact('priced_package', 'currency'));
        }
        if (isset($request->search_month)) {
            $monthSeason = $packages->groupBy('media.reference_id')->get();
//            dd($monthSeason);
            return view('Frontend/snippets/search-month', compact('monthSeason'));
        }
        if (isset($request->search_best)) {
            $packages = $packages->groupBy('media.reference_id')->get();
            return view('Frontend/snippets/search-best', compact('packages', 'currency'));
        }
    }




    // public function allFilter(Request $request)
    // {

    //     $lang_id = Language::where('language_code', $request->lang_id)->get()->first();
    //     $packages = Package::where('packages.status', 1);
    //     if (isset($request->search_selling)) {

    //         $days_range = explode('-', $request->search_selling);
    //         $minDays = $days_range[0];
    //         $maxDays = $days_range[1];
    //         $packages = Package::groupBy('state')->pluck('state')->toArray();
    //         $package = [];
    //         foreach ($packages as $packag) {
    //             $packagss = Package::where('state', $packag)->where('package_type', 1)->whereBetween('minimum_days', [$minDays, $maxDays])->orderBy('discount_price', 'asc')->get()->first();
    //             if ($packagss != null) {
    //                 $state = StatePivot::where('id', $packag)->get()->first();
    //                 $total = Package::where('state', $packag)->get()->count();
    //                 $package_detail = PackageDetail::where('package_id', $packagss->id)->where('language_id', $lang_id->id)->get()->first();
    //                 $media = media::where('reference_id', $packagss->id)->where('reference_type', 'package')->get()->first();
    //                 $package[] = [
    //                     'id' => $packagss->id,
    //                     'slug' => $state->id,
    //                     'compare_price' => $packagss->compare_price,
    //                     'discount_price' => $packagss->discount_price,
    //                     'minimum_days' => $packagss->minimum_days,
    //                     'maximum_days' => $packagss->maximum_days,
    //                     'state' => $packagss->state,
    //                     'season_package' => $packagss->season_package,
    //                     'media' => $media->image,
    //                     'title' => $state->title,
    //                     'description' => $package_detail->description,
    //                     'tags' => $package_detail->tags,
    //                     'count' => $total
    //                 ];
    //             }
    //         }
    //         $data['package'] = $package;
    //         $data['currency'] = Currency::where('language_code', $request->lang_id)->get()->first();
    //         return view('Frontend/snippets/search-selling', $data);
    //     }
    //     if (isset($request->search_best)) {
    //         $days_range = explode('-', $request->search_best);
    //         $minDays = $days_range[0];
    //         $maxDays = $days_range[1];
    //         $packages->leftJoin('package_details', function ($join) {
    //             $join->on('package_details.package_id', '=', 'packages.id');
    //         })
    //             ->leftJoin('media', function ($join) {
    //                 $join->on('packages.id', '=', 'media.reference_id');
    //             })
    //             ->where('packages.package_type', 0)
    //             ->where('media.reference_type', '=', 'package')
    //             ->where('package_details.language_id', $lang_id->id)
    //             ->where('packages.minimum_days', '>=', $minDays)->where('packages.maximum_days', '<=', $maxDays);
    //     }
    //     if (isset($request->search_price)) {
    //         $price_range = explode('-', $request->search_price);
    //         $minPrice = $price_range[0];
    //         $maxPrice = $price_range[1];
    //         $packages->leftJoin('package_details', function ($join) {
    //             $join->on('package_details.package_id', '=', 'packages.id');
    //         })
    //             ->leftJoin('media', function ($join) {
    //                 $join->on('packages.id', '=', 'media.reference_id');
    //             })
    //             ->where('media.reference_type', '=', 'package')
    //             ->where('package_details.language_id', $lang_id->id)
    //             ->whereBetween('packages.discount_price', [$minPrice, $maxPrice]);
    //     }
    //     if (isset($request->search_month)) {
    //         $month_range = explode('-', $request->search_month);
    //         $packages->leftJoin('package_details', function ($join) {
    //             $join->on('package_details.package_id', '=', 'packages.id');
    //         })
    //             ->leftJoin('media', function ($join) {
    //                 $join->on('packages.id', '=', 'media.reference_id');
    //             })
    //             ->where('media.reference_type', '=', 'package')
    //             ->where('package_details.language_id', $lang_id->id)
    //             ->whereIn('packages.season_package', $month_range);
    //     }

    //     $packages->select(
    //         'packages.id',
    //         'packages.slug',
    //         'packages.discount_price',
    //         'package_details.title',
    //         'package_details.language_id',
    //         'packages.minimum_days',
    //         'packages.maximum_days',
    //         'package_details.description',
    //         'media.image',
    //         'media.reference_id',
    //         'packages.season_package'
    //     );

    //     $currency = Currency::where('language_code', $request->lang_id)->get()->first();
    //     if (isset($request->search_price)) {
    //         $packages = $packages->groupBy('media.reference_id')->get();
    //         return view('Frontend/snippets/search-price', compact('packages', 'currency'));
    //     }
    //     if (isset($request->search_month)) {
    //         $packages = $packages->groupBy('media.reference_id')->get();
    //         return view('Frontend/snippets/search-month', compact('packages'));
    //     }
    //     if (isset($request->search_best)) {
    //         $packages = $packages->groupBy('media.reference_id')->get();
    //         return view('Frontend/snippets/search-best', compact('packages', 'currency'));
    //     }
    // }

//Destination
    public function allDestination(Request $request)
    {

        $package = null;
        $lang = Language::where('language_code', app()->getLocale())->get()->first();
        $currency = Currency::where('language_code', app()->getLocale())->get()->first();
        $packages = Package::where('packages.status', 1);
        if (isset($request->sell_for) != null) {
            $country = CountryDetail::where('title', 'LIKE', '%' . 'United Arab Emirates' . '%')->get()->first();
            if (isset($country)) {
                if (count($request->sell_for) == 2 || count($request->sell_for) == 0) {
                    $packages = Package::where('packages.status', 1)->where('packages.country', '!=', null);
                } else {
                    if (in_array('international', $request->sell_for)) {
                        $packages = Package::where('packages.status', 1)->where('packages.country', '!=', $country->country_id);
                    }
                    if (in_array('United Arab Emirates', $request->sell_for)) {
                        $packages = Package::where('packages.status', 1)->where('packages.country', $country->country_id);
                    }
                }
            } else {
                $packages = Package::where('packages.status', 1)->where('packages.country', '!=', $country->country_id);
            }
        } else {
            $packages = Package::where('packages.status', 1)->where('packages.country', '!=', null);


        }
        $packages->leftJoin('package_details', function ($join) {
            $join->on('package_details.package_id', '=', 'packages.id');
        })
            ->leftJoin('media', function ($join) {
                $join->on('media.reference_id', '=', 'packages.id',);
            })
            ->where('package_details.language_id', $lang->id)
            ->where('media.reference_type', '=', 'package');

//        foreach ($packages as $packag) {
//            $packagss = Package::where('state', $packag)->where('package_type', 1)->orderBy('discount_price', 'asc')->get()->first();
//            if ($packagss != null) {
//                $state = StatePivot::where('id', $packag)->get()->first();
//                $total = Package::where('state', $packag)->get()->count();
//                $package_detail = PackageDetail::where('package_id', $packagss->id)->where('language_id', $lang->id)->get()->first();
//                $media = media::where('reference_id', $packagss->id)->where('reference_type', 'package')->get()->first();
//                $packages[] = [
//                    'id' => $packagss->id,
//                    'slug' => $state->id,
//                    'compare_price' => $packagss->compare_price,
//                    'discount_price' => $packagss->discount_price,
//                    'minimum_days' => $packagss->minimum_days,
//                    'maximum_days' => $packagss->maximum_days,
//                    'state' => $packagss->state,
//                    'season_package' => $packagss->season_package,
//                    'media' => $media->image,
//                    'title' => $state->title,
//                    'description' => $package_detail->description,
//                    'tags' => $package_detail->tags,
//                    'count' => $total
//                ];
//            }
//        }
//        $data['package'] = $packages;
//
        $packages->select(
            'packages.id',
            'packages.discount_price',
            'packages.compare_price',
            'packages.country',
            'package_details.title',
            'package_details.language_id',
            'packages.maximum_days',
            'package_details.description',
            'media.image',
            'media.reference_id',
            'packages.season_package',
            'packages.country'
        );
        $package = $packages->groupBy('media.reference_id', 'packages.id')->get();
        return view('Frontend/snippets/destination', compact('package'));
    }


    public function predictiveStates(Request $request)
    {
        $langauge = Language::where('language_code', app()->getLocale())->get()->first();

        // $cities = CityDetail::whereIn('city_id', $myArray)->where('language_id', $langauge->id)->get()->pluck('city_id');

        $property = CityDetail::leftjoin('cities', 'city_details.city_id', '=', 'cities.id')->where('city_details.title', 'LIKE', "%$request->input%")->where('city_details.language_id', $langauge->id)->where('cities.status',1)->pluck('city_details.title')->toArray();
        //   dd($property);
        return \Response::json($property, 200);
    }

    public function CurrencySwitcher(Request $request)
    {

        session()->forget('currency');

        session(['currency' => $request->segment(3)]);
//        $country = session('country');
        return redirect()->back();
    }






     public function getAllPageLinks($count,$href) {

    
    $output = '';
    if(!isset($_GET["page"])) $_GET["page"] = 1;
    if($this->perpage != 0)
      $pages  = ceil($count/$this->perpage);


    if($pages>1) {
      if($_GET["page"] == 1) 
        $output = $output . '<span class="item-pagination flex-c-m trans-0-4 disabled">&#8810;</span><span class="item-pagination flex-c-m trans-0-4 disabled">&#60;</span>';
      else  
        $output = $output . '<a class="item-pagination flex-c-m trans-0-4" onclick="getresult(\'' . $href . (1) . '\')" >&#8810;</a><a class="item-pagination flex-c-m trans-0-4" onclick="getresult(\'' . $href . ($_GET["page"]-1) .'\')" >&#60;</a>';
      
      
      if(($_GET["page"]-3)>0) {
        if($_GET["page"] == 1)
          $output = $output . '<span id=1 class="item-pagination flex-c-m trans-0-4 active-pagination">1</span>';
        else        
          $output = $output . '<a class="item-pagination flex-c-m trans-0-4" onclick="getresult(\'' . $href . '1\')" >1</a>';
      }
      if(($_GET["page"]-3)>1) {
          $output = $output . '<span class="dot">...</span>';
      }
      
      for($i=($_GET["page"]-2); $i<=($_GET["page"]+2); $i++)  {
        if($i<1) continue;
        if($i>$pages) break;
        if($_GET["page"] == $i)
          $output = $output . '<span id='.$i.' class="item-pagination flex-c-m trans-0-4 active-pagination">'.$i.'</span>';
        else        
          $output = $output . '<a class="item-pagination flex-c-m trans-0-4" onclick="getresult(\'' . $href . $i . '\')" >'.$i.'</a>';
      }
      
      if(($pages-($_GET["page"]+2))>1) {
        $output = $output . '<span class="dot">...</span>';
      }
      if(($pages-($_GET["page"]+2))>0) {
        if($_GET["page"] == $pages)
          $output = $output . '<span id=' . ($pages) .' class="item-pagination flex-c-m trans-0-4 active-pagination">' . ($pages) .'</span>';
        else        
          $output = $output . '<a class="item-pagination flex-c-m trans-0-4" onclick="getresult(\'' . $href .  ($pages) .'\')" >' . ($pages) .'</a>';
      }
      
      if($_GET["page"] < $pages)
        $output = $output . '<a  class="item-pagination flex-c-m trans-0-4" onclick="getresult(\'' . $href . ($_GET["page"]+1) . '\')" >></a><a  class="item-pagination flex-c-m trans-0-4" onclick="getresult(\'' . $href . ($pages) . '\')" >&#8811;</a>';
      else        
        $output = $output . '<span class="item-pagination flex-c-m trans-0-4 disabled">></span><span class="item-pagination flex-c-m trans-0-4 disabled">&#8811;</span>';
      
      
    }
    return $output;
  }
  public function getPrevNext($count,$href) {
    $output = '';
    if(!isset($_GET["page"])) $_GET["page"] = 1;
    if($this->perpage != 0)
      $pages  = ceil($count/$this->perpage);
    if($pages>1) {
      if($_GET["page"] == 1) 
        $output = $output . '<span class="item-pagination flex-c-m trans-0-4 disabled first">Prev</span>';
      else  
        $output = $output . '<a class="item-pagination flex-c-m trans-0-4 " onclick="getresult(\'' . $href . ($_GET["page"]-1) . '\')" >Prev</a>';     
      
      if($_GET["page"] < $pages)
        $output = $output . '<a  class="item-pagination flex-c-m trans-0-4" onclick="getresult(\'' . $href . ($_GET["page"]+1) . '\')" >Next</a>';
      else        
        $output = $output . '<span class="item-pagination flex-c-m trans-0-4 disabled">Next</span>';
      
      
    }
    return $output;
  }


public function getRecord(){
          
       
        $pagination_setting = $_GET["pagination_setting"];
        $catId = $_GET["catId"] ?? '';
        $SubCatId = $_GET["SubCatId"] ?? '';
                
        $page = 1;
        $page0= 12;
        if(isset($_GET["page"]) &&  !empty($_GET["page"])) {
        $page = $_GET["page"];
        }



        $start = ($page-1)*$page0;
        if($start < 0) $start = 0;


     
       $where = ' WHERE 1';
       $PageAdd='';
       if($catId!=''){
           $PageAdd.= 'catId='.$_GET["catId"];
           $where.= ' AND product_category_id = "'.$catId.'" ';
       }
       if($SubCatId!=''){
            $where.= ' AND product_sub_category_id ="'.$SubCatId.'" ';
            $PageAdd.= '&SubCatId='.$_GET["SubCatId"];
       }
        $paginationlink = url("/get-product?".$PageAdd."&page="); 

        $Query ="SELECT * from products".$where ;
        $result = DB::select($Query." limit " . $start . "," . $page0);


        $Query =" SELECT count(*) all_row from products".$where ;
        if(empty($_GET["rowcount"])) {

        $_GET["rowcount"] = ceil(DB::select($Query)[0]->all_row/12);

        }





        // dd( $this->db->last_query());

    
        if($pagination_setting == "prev-next") {
          $perpageresult = $this->getPrevNext($_GET["rowcount"], $paginationlink,$pagination_setting); 
        } else {
          $perpageresult = $this->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting); 
        }
       
       $output1 = $output2 = '';

 

        if(count($result)==0){

             $output1='
        <div class="col-12">
          <!-- Card -->
            <div class="card promoting-card">
              <div class="card-body">
                 <h4 style="color:green">Product Not Found</h4>
              </div>
          </div>
        <!-- Card -->
      </div>';
      }else{
      foreach($result as $k=>$v) {
       $output1.=$this->divReady($v);
       $output1.' <input type="hidden" id="rowcount" name="rowcount" value="' . $_GET["rowcount"] . '" />';
      }
    }
      if(!empty($perpageresult) ) {
      $output2 .= '<div id="pagination">' . $perpageresult . '</div>';
      }
      $data['result']= $output1;
      $data['pagination']= $output2;
      $data['count']= isset($_GET["rowcount"]) ? $_GET["rowcount"] : 0;
      echo json_encode($data);
}

public function divReady($value){
  $out='
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 product-flower">
                    <div class="product-image-flower">
                    <figure class="sale"><a href="#"><img src="'.asset('flower/img/slider1.png').'" class="img-responsive" alt="img-holiwood"></a></figure>
                    <div class="product-icon-flower">
                        <a href="'.url('product/'.$value->id).'"><i class="far fa-eye"></i></a>
                        <a href="javascript:void(0)" class="add-to-cart-button" data-product-id="'.$value->id.'"><i class="fas fa-shopping-basket" ></i></a>
                        <a href="#"><i class="far fa-heart"></i></a>
                    </div>
                    </div>
                    <div class="product-title-flower">
                    <h5><a href="#">'.$value->product_name.'</a></h5>
                    <p class="p-title">It is a long established fact that a reader will be distracted by the readable content of a<br class="hidden-sm hidden-xs"> page when looking at its layout.</p>
                    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <span class="rating">3 Reating(s) | Add Your Reating(s)</span>
                    </div>
                    <div class="prince">$207.2<s class="strike">$250.9</s></div>
                    <div class="add-cart">
                        <a href="javascript:void(0)" class="btn-add-cart add-to-cart-button" data-product-id="'.$value->id.'">Add to cart</a>
                        <a href="'.url('product/'.$value->id).'" class="list-icon icon-1"><i class="far fa-eye"></i></a>
                        <a href="#" class="list-icon icon-2"><i class="far fa-heart"></i></a>
                    </div>
                    </div>
                </div>';



  return $out;

}

public function createOrder(Request $request)
{
    $post = $request->all();
    $cart_content = session('cart');

     if(count($cart_content) && count($post)){
      // $this->db->trans_start();

        
            $datas = array(
              'date'                => date('Y-m-d'),
              'time'                => date('H:i'),
              'year'                => date('Y'),
              'first_name'          => $post['first_name'],
              'last_name'           => $post['last_name'],
              'name'                => $post['first_name'].' '.$post['last_name'],
              'phone_no'                => $post['phone_no'],
              'email'               => $post['email'],
              'city_name'               => $post['city'],
              'address'             => $post['address'],
              'massage'             => $post['message'],
              'items'               => $post['items'],
              'TotalAmount'         => $post['TotalAmount'],
              'created_date'        => date('Y-m-d H:i:s'),
              'Status'              => 1
            ); 
            $OrderId = Order::insertGetId( $datas);
        
            if($OrderId){
              foreach ($cart_content as $key => $value) {

                $item = array(
                  'OrderId' =>$OrderId,
                  'year'    => date('Y'),
                  'ItemId'  => $value['id'],
                  'ItemQty' => $value['quantity'],
                  'Status'  => 1
                );
               OrderDetail::insertGetId( $item);
               // $this->sentNotificationAdmin();
              }
        }
        // Remove Cart 
        session()->put('cart', []);
    }

      echo json_encode(['success'=>true,'msg'=>'Order has been Done!']);

}


}
