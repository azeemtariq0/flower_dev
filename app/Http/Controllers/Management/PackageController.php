<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\StatePivot;
use App\Models\categories;
use App\Models\Country;
use App\Models\CityPackagePivot;
use App\Models\City;
use App\Models\ActivitiesPackagePivot;
use App\Models\category_package_pivot;
use App\Models\DestinationTheme;
use App\Models\FaqsPivot;
use App\Models\HotelPivot;
use App\Models\InclusionPackagePivot;
use App\Models\ExclusionPackagePivot;
use App\Models\ItineraryPivot;
use App\Models\cityPivot;
use App\Models\faqs;
use App\Models\Highlights;
use App\Models\HotelPackage;
use App\Models\Gallery;
use App\Models\GalleryPivot;
use App\Models\Itinerary;
use App\Models\ItineraryDetail;
use App\Models\Language;
use App\Models\media;
use App\Models\HiglightsPivot;
use App\Models\Package;
use App\Models\PackageDetail;
use App\Helpers\DefaultLanguage;
use App\Models\Activities;
use App\Models\ActivitiesPivot;
use App\Models\inclusionPivot;
use App\Models\ThemePivot;
use App\Models\seo;
use App\Models\SeasonPackage;
use DB;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['package'] = Package::latest()->get();
        $data['media'] = media::where('reference_type', 'package')->get()->groupBy('reference_id');
        return view('management.package.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        $cate = categories::leftJoin('category_details', 'categories.id', '=', 'category_details.category_id')
            ->where('categories.reference_type', 'package')
            ->where('category_details.language_id', $language->id)
            ->select('categories.id', 'category_details.title')
            ->get();
        $countries = Country::get();
        $hotel = HotelPackage::get();
        $inclusions = inclusionPivot::leftJoin('inclusions', 'inclusion_pivot.inc_exc_id', 'inclusions.id')
            ->where('inclusion_pivot.language_id', $language->id)
            ->where('inclusions.type', 0)
            ->select('inclusion_pivot.*', 'inclusions.id')
            ->get();
        $exclusions = inclusionPivot::leftJoin('inclusions', 'inclusion_pivot.inc_exc_id', 'inclusions.id')
            ->where('inclusion_pivot.language_id', $language->id)
            ->where('inclusions.type', 1)
            ->select('inclusion_pivot.*', 'inclusions.id')
            ->get();
        $activities = Activities::leftJoin('activities_pivot', 'activities_pivot.activity_id', 'activities.id')
            ->where('activities_pivot.language_id', $language->id)
            ->select('activities_pivot.*', 'activities.id')
            ->get();
        $highlight = Highlights::leftJoin('highlights_details', 'highlights_details.highlight_id', 'highlights.id')
            ->where('highlights_details.language_id', $language->id)
            ->select('highlights.title', 'highlights.id')
            ->groupBy('highlights.id')->get();
        $itineraries = Itinerary::leftJoin('itinerary_details', 'itineraries.id', 'itinerary_details.itinerary_id')
            ->where('itinerary_details.language_id', $language->id)
            ->select('itinerary_details.*', 'itineraries.id')
            ->get();
        $faqs = faqs::leftJoin('faqs_details', 'faqs_details.faqs_id', 'faqs.id')
            ->where('faqs.faqs_reference', 1)
            ->where('faqs_details.language_id', $language->id)
            ->select('faqs.title', 'faqs.id')->groupBy('faqs.id')->get();
        $themes = DestinationTheme::leftJoin('theme_details', 'theme_details.themes_id', 'destination_themes.id')
            ->where('theme_details.language_id', $language->id)
            ->select('theme_details.*', 'destination_themes.id')->get();
        return view('management.package.create', compact('themes', 'hotel', 'countries', 'language', 'cate', 'inclusions', 'exclusions', 'activities', 'faqs', 'itineraries', 'highlight'));
    }

    public function fetchState(Request $request)
    {
        $language = DefaultLanguage::SelectedLanguage();
        $data['states'] = State::leftjoin('state_pivots', 'states.id', '=', 'state_pivots.state_id')->where("states.country_id", $request->country_id)
            ->where("state_pivots.language_id", $language->id)->get(["state_pivots.title", "state_pivots.id"]);
        return response()->json($data);
    }

    public function getState(Request $request)
    {
        $language = DefaultLanguage::SelectedLanguage();
        $data['states'] = State::leftjoin('state_pivots', 'states.id', '=', 'state_pivots.state_id')
            ->where('state_pivots.id', $request->sid)
            ->where("state_pivots.language_id", $language->id)->get(["state_pivots.title", "state_pivots.id"]);
        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $language = DefaultLanguage::SelectedLanguage();
        $data['cities'] = City::leftjoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->where("cities.states_id", $request->state_id)
            ->where("city_details.language_id", $language->id)
            ->get(["city_details.title", "cities.id"]);
        return response()->json($data);
    }

    public function getCity(Request $request)
    {
        $string = $request->cid;
        $array = json_decode(str_replace("'", '"', $string));
        $language = DefaultLanguage::SelectedLanguage();
        $data['cities'] = City::leftjoin('city_details', 'cities.id', '=', 'city_details.city_id')
            ->whereIn("cities.id", $array)
            ->where("city_details.language_id", $language->id)
            ->get(["city_details.title", "cities.id"]);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        $data = [
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id != null ? json_encode($request->category_id) : null,
            'hotel_id' => $request->hotel_id != null ? json_encode($request->hotel_id) : null,
            'theme_id' => $request->theme_id != null ? json_encode($request->theme_id) : null,
            'title' => $request->title,
            'inclusions' => $request->inclusions != null ? json_encode($request->inclusions) : null,
            'exclusions' => $request->exclusions != null ? json_encode($request->exclusions) : null,
            'activities' => $request->activities != null ? json_encode($request->activities) : null,
            'highlights' => $request->highlights != null ? json_encode($request->highlights) : null,
            'faqs' => $request->faqs != null ? json_encode($request->faqs) : null,
            'itineraries' => $request->itineraries != null ? json_encode($request->itineraries) : null,
            'status' => $request->status,
            'select_package' => $request->select_package,
            'compare_price' => $request->compare_price,
            'discount_price' => $request->discount_price,
            'minimum_days' => $request->minimum_days,
            'maximum_days' => $request->maximum_days,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city != null ? json_encode($request->city) : null,
            'trending' => $request->trending,
            'package_type' => $request->package_type,
            'season_package' => $request->season_package != null ? json_encode($request->season_package) : null,
            'season_price' => $request->season_price != null ? json_encode($request->season_price) : null,
        ];
        $package = Package::create($data);
        $value = [
            'package_id' => $package->id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
        ];
        $packagedetail = PackageDetail::create($value);
        if ($request->file('image')) {
            $i = 0;
            foreach ($request->file('image') as $image) {
                $mainext = $image->getClientOriginalExtension();
                $main_file = 'package' . time() . rand(1000, 14000000000) . '.' . $mainext;
                $image->move(public_path('/images/media'), $main_file);
                $multi_image =
                    [
                        'reference_id' => $package->id,
                        'reference_type' => 'package',
                        'caption' => $request->caption[$i],
                        'image' => $main_file,
                    ];
                $multi = media::create($multi_image);
                $i++;
            }
        } else {
            $multi = null;
        }
        if ($request->file('package_pdf')) {
            foreach ($request->file('package_pdf') as $pdf) {
                $mainext = $pdf->getClientOriginalExtension();
                $main_file = time() . rand(1000, 14000000000) . '.' . $mainext;
                $pdf->move(public_path('/images/media'), $main_file);
                $multi_image =
                    [
                        'reference_id' => $package->id,
                        'reference_type' => 'package_pdf',
                        'image' => $main_file,
                    ];
                $multi = media::create($multi_image);
            }
        } else {
            $multi = null;
        }
        $seo = [
            'reference_id' => $package->id,
            'language_id' => $request->language_id,
            'reference_type' => 'package',
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];
        seo::create($seo);
        PackageController::categoryData($request, $package->id);
        PackageController::cityData($request, $package->id);
        PackageController::hotelData($request, $package->id);
        PackageController::themeData($request, $package->id);
        PackageController::inclusionData($request, $package->id);
        PackageController::exclusionData($request, $package->id);
        PackageController::activitiesData($request, $package->id);
        PackageController::faqsData($request, $package->id);
        PackageController::itineraryData($request, $package->id);
        PackageController::highlightsData($request, $package->id);
        PackageController::galleryData($request, $package->id);
        PackageController::MonthsData($request, $package->id);
        return redirect()->route('package.show', $package->id)->with('success', 'Package Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = DefaultLanguage::SelectedLanguage();
        $data['cate'] = categories::leftJoin('category_details', 'categories.id', '=', 'category_details.category_id')
            ->where('categories.reference_type', 'package')
            ->where('category_details.language_id', $language->id)
            ->select('categories.id', 'category_details.title')
            ->get();
        $data['package'] = Package::where('id', $id)->get()->first();
        $data['hotel'] = HotelPackage::where('status',1);
        if($data['package']->hotel_id != null ) {
            $data['hotel'] = $data['hotel']->orderByRaw(DB::raw("FIELD(hotel_packages.id, " . implode(',', json_decode($data['package']->hotel_id)) . ")"));
        }
        $data['hotel'] = $data['hotel']->get();
        $data['countries'] = Country::get();

//        dd($data['package']);
        $data['package_detail'] = PackageDetail::where('package_id', $id)->get()->first();
        $data['gallery'] = Gallery::where('package_id', $id)->where('language_id', $language->id)->get();
        $data['inclusions'] = inclusionPivot::leftJoin('inclusions', 'inclusion_pivot.inc_exc_id', 'inclusions.id')
            ->where('inclusion_pivot.language_id', $language->id)
            ->where('inclusions.type', 0)
            ->select('inclusion_pivot.*', 'inclusions.id')
            ->orderByRaw(DB::raw("FIELD(inclusions.id, ".implode(',', json_decode($data['package']->inclusions)) . ") ASC"))
            ->get();
        $data['exclusions'] = inclusionPivot::leftJoin('inclusions', 'inclusion_pivot.inc_exc_id', 'inclusions.id')
            ->where('inclusion_pivot.language_id', $language->id)
            ->where('inclusions.type', 1)
           ->select('inclusion_pivot.*', 'inclusions.id')
            ->orderByRaw(DB::raw("FIELD(inclusions.id, ".implode(',', json_decode($data['package']->exclusions)) . ")"))

            ->get();
        $data['highlight'] = Highlights::leftJoin('highlights_details', 'highlights_details.highlight_id', 'highlights.id')
            ->where('highlights_details.language_id', $language->id)
            ->select('highlights.title', 'highlights.id');
        if($data['package']->highlights != null ){
        $data['highlight'] = $data['highlight']->orderByRaw(DB::raw("FIELD(highlights.id, ".implode(',', json_decode($data['package']->highlights)) . ")"));
}
        $data['highlight'] = $data['highlight']->groupBy('highlights.id')->get();
        $data['activities'] = Activities::leftJoin('activities_pivot', 'activities_pivot.activity_id', 'activities.id')
            ->where('activities_pivot.language_id', $language->id)
            ->select('activities_pivot.*', 'activities.id');
             if($data['package']->activities != null ) {
                 $data['activities'] = $data['activities']->orderByRaw(DB::raw("FIELD(activities.id, " . implode(',', json_decode($data['package']->activities)) . ")"));
            }
        $data['activities'] = $data['activities']->get();
        $data['faqs'] = faqs::leftJoin('faqs_details', 'faqs_details.faqs_id', 'faqs.id')
            ->where('faqs.faqs_reference', 1)
            ->where('faqs_details.language_id', $language->id)
            ->select('faqs.*');
              if($data['package']->faqs != null ) {
                  $data['faqs'] = $data['faqs']->orderByRaw(DB::raw("FIELD(faqs.id, " . implode(',', json_decode($data['package']->faqs)) . ")"));
              }
        $data['faqs'] = $data['faqs']->groupBy('faqs.id')->get();


        $data['itineraries'] = Itinerary::leftJoin('itinerary_details', 'itineraries.id', 'itinerary_details.itinerary_id')
            ->where('itinerary_details.language_id', $language->id)
            ->select('itinerary_details.*', 'itineraries.id');
             if($data['package']->itineraries != null ) {
                 $data['itineraries'] = $data['itineraries']->orderByRaw(DB::raw("FIELD(itineraries.id, " . implode(',', json_decode($data['package']->itineraries)) . ")"));
             }
        $data['itineraries'] = $data['itineraries']->get();

        $data['language'] = Language::where('id', $data['package_detail']->language_id)->get()->first();
        $data['media'] = media::where('reference_id', $id)->where('reference_type', 'package')->get();
        $data['package_pdf'] = media::where('reference_id', $id)->where('reference_type', 'package_pdf')->get();
        $data['seasonPackage'] = SeasonPackage::where('package_id', $id)->where('language_id', $language->id)->get();
        $data['seo'] = seo::where('reference_id', $id)->where('reference_type', 'package')->get()->first();
        $data['themes'] = DestinationTheme::leftJoin('theme_details', 'theme_details.themes_id', 'destination_themes.id')
            ->where('theme_details.language_id', $language->id)
            ->select('theme_details.*', 'destination_themes.id');
            if($data['package']->theme_id != null ) {
                $data['themes'] = $data['themes']->orderByRaw(DB::raw("FIELD(destination_themes.id, " . implode(',', json_decode($data['package']->theme_id)) . ")"));
            }


        $data['themes'] = $data['themes']->get();
        return view('management/package/edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $package = Package::where('id', $id)->get()->first();
        $package_detail = PackageDetail::where('package_id', $id)->get()->first();
        $seo = seo::where('reference_id', $id)->where('reference_type', 'package')->get()->first();
        CityPackagePivot::where('package_id', $id)->delete();
        category_package_pivot::where('package_id', $id)->delete();
        HiglightsPivot::where('package_id', $id)->delete();
        Gallery::where('package_id', $id)->delete();
        HotelPivot::where('package_id', $id)->delete();
        ThemePivot::where('package_id', $id)->delete();
        InclusionPackagePivot::where('package_id', $id)->delete();
        ExclusionPackagePivot::where('package_id', $id)->delete();
        ActivitiesPackagePivot::where('package_id', $id)->delete();
        SeasonPackage::where('package_id', $id)->delete();
        media::where('reference_id', $id)->where('reference_type', 'package')->delete();
        media::where('reference_id', $id)->where('reference_type', 'package_pdf')->delete();
        $package->update([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id != null ? json_encode($request->category_id) : null,
            'hotel_id' => $request->hotel_id != null ? json_encode($request->hotel_id) : null,
            'theme_id' => $request->theme_id != null ? json_encode($request->theme_id) : null,
            'title' => $request->title,
            'inclusions' => $request->inclusions != null ? json_encode($request->inclusions) : null,
            'exclusions' => $request->exclusions != null ? json_encode($request->exclusions) : null,
            'activities' => $request->activities != null ? json_encode($request->activities) : null,
            'highlights' => $request->highlights != null ? json_encode($request->highlights) : null,
            'faqs' => $request->faqs != null ? json_encode($request->faqs) : null,
            'itineraries' => $request->itineraries != null ? json_encode($request->itineraries) : null,
            'status' => $request->status,
            'select_package' => $request->select_package,
            'compare_price' => $request->compare_price,
            'discount_price' => $request->discount_price,
            'minimum_days' => $request->minimum_days,
            'maximum_days' => $request->maximum_days,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city != null ? json_encode($request->city) : null,
            'trending' => $request->trending,
            'package_type' => $request->package_type,
            'season_package' => $request->season_package != null ? json_encode($request->season_package) : null,
            'season_price' => $request->season_price != null ? json_encode($request->season_price) : null,
        ]);
        $package_detail->update([
            'package_id' => $id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
        ]);
        if ($request->file('image')) {
            $i = 0;
            foreach ($request->file('image') as $image) {
                $mainext = $image->getClientOriginalExtension();
                $main_file = 'package' . time() . rand(1000, 14000000000) . '.' . $mainext;
                $image->move(public_path('/images/media'), $main_file);
                $multi_image =
                    [
                        'reference_id' => $package->id,
                        'reference_type' => 'package',
                        'caption' => $request->caption[$i],
                        'image' => $main_file,
                    ];
                $multi = media::create($multi_image);
                $i++;
            }
            if ($request->image_update != null) {
                $i = 0;
                foreach ($request->image_update as $image) {
                    $multi_image =
                        [
                            'reference_id' => $package->id,
                            'reference_type' => 'package',
                            'caption' => $request->caption[$i],
                            'image' => $image,
                        ];
                    $multi = media::create($multi_image);
                    $i++;
                }
            }
        } else {
            if ($request->image_update != null) {
                $i = 0;
                foreach ($request->image_update as $image) {
                    $multi_image =
                        [
                            'reference_id' => $package->id,
                            'reference_type' => 'package',
                            'caption' => $request->caption[$i],
                            'image' => $image,
                        ];
                    $multi = media::create($multi_image);
                    $i++;
                }
            }
        }

        if ($request->file('package_pdf')) {
            foreach ($request->file('package_pdf') as $pdf) {
                $mainext = $pdf->getClientOriginalExtension();
                $main_file = time() . rand(1000, 14000000000) . '.' . $mainext;
                $pdf->move(public_path('/images/media'), $main_file);
                $multi_image =
                    [
                        'reference_id' => $package->id,
                        'reference_type' => 'package_pdf',
                        'image' => $main_file,
                    ];
                $multi = media::create($multi_image);
            }
        } else {
            if ($request->uplaod_pdf) {
                foreach ($request->uplaod_pdf as $upload) {
                    $multi_image =
                        [
                            'reference_id' => $package->id,
                            'reference_type' => 'package_pdf',
                            'image' => $upload,
                        ];
                    $multi = media::create($multi_image);
                }
            }
        }
        $seo->update([
            'reference_id' => $package->id,
            'language_id' => $request->language_id,
            'reference_type' => 'package',
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);
        PackageController::categoryData($request, $package->id);
        PackageController::cityData($request, $id);
        PackageController::hotelData($request, $id);
        PackageController::themeData($request, $id);
        PackageController::inclusionData($request, $id);
        PackageController::exclusionData($request, $id);
        PackageController::activitiesData($request, $id);
        PackageController::faqsData($request, $id);
        PackageController::itineraryData($request, $id);
        PackageController::highlightsData($request, $id);
        PackageController::galleryData($request, $id);
        PackageController::MonthsData($request, $package->id);
        return redirect()->back()->with('success', 'Package Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = media::where('reference_id', $id)->where('reference_type', 'package')->delete();
        $package = Package::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Package Delete successfully');
    }

    public function MonthsData(Request $request, $id)
    {
        if (isset($request->season_package)) {
            $language = DefaultLanguage::SelectedLanguage();
            $i = 0;
            foreach ($request->season_package as $months) {
                $monthspackage = [
                    'package_id' => $id,
                    'months' => $months,
                    'price' => $request->season_price[$i],
                    'language_id' => $language->id,
                ];
                SeasonPackage::create($monthspackage);
                $i++;
            }
        }
    }

    public function categoryData(Request $request, $id)
    {
        if (isset($request->category_id)) {
            foreach ($request->category_id as $value) {
                $categorypackage = [
                    'package_id' => $id,
                    'category_id' => $value,
                ];
                category_package_pivot::create($categorypackage);
            }
        }
    }

    public function cityData(Request $request, $id)
    {
        if (isset($request->city)) {
            foreach ($request->city as $value) {
                $city = [
                    'package_id' => $id,
                    'city_id' => $value,
                ];
                CityPackagePivot::create($city);
            }
        }
    }

    public function hotelData(Request $request, $id)
    {
        if (isset($request->hotel_id)) {
            foreach ($request->hotel_id as $value) {
                $hotel = [
                    'package_id' => $id,
                    'hotel_id' => $value,
                ];
                HotelPivot::create($hotel);
            }
        }
    }

    public function themeData(Request $request, $id)
    {
        if (isset($request->theme_id)) {
            foreach ($request->theme_id as $value) {
                $theme = [
                    'package_id' => $id,
                    'theme_id' => $value,
                ];
                ThemePivot::create($theme);
            }
        }
    }

    public function inclusionData(Request $request, $id)
    {
        if (isset($request->inclusions)) {
            foreach ($request->inclusions as $key=> $value) {
                $inclusions = [
                    'package_id' => $id,
                    'inclusion_id' => $value,
                    'reorder' => $key+1,
                ];
                InclusionPackagePivot::create($inclusions);
            }
        }
    }

    public function exclusionData(Request $request, $id)
    {
        if (isset($request->exclusions)) {
            foreach ($request->exclusions as $value) {
                $exclusions = [
                    'package_id' => $id,
                    'exclusion_id' => $value,
                ];
                ExclusionPackagePivot::create($exclusions);
            }
        }
    }

    public function activitiesData(Request $request, $id)
    {
        if (isset($request->activities)) {
            foreach ($request->activities as $value) {
                $activities = [
                    'package_id' => $id,
                    'activities_id' => $value,
                ];
                ActivitiesPackagePivot::create($activities);
            }
        }
    }

    public function faqsData(Request $request, $id)
    {

        if (isset($request->faqs)) {
            FaqsPivot::where('package_id', $id)->delete();

            foreach ($request->faqs as $value) {
                $faqs = [
                    'package_id' => $id,
                    'faqs_id' => $value,
                ];
                FaqsPivot::create($faqs);
            }
        }
    }

    public function itineraryData(Request $request, $id)
    {
        if (isset($request->itineraries)) {
            foreach ($request->itineraries as $value) {
                $itineraries = [
                    'package_id' => $id,
                    'itinerary_id' => $value,
                ];
                ItineraryPivot::create($itineraries);
            }
        }
    }

    public function highlightsData(Request $request, $id)
    {
        if (isset($request->highlights)) {
            foreach ($request->highlights as $value) {
                $highlights = [
                    'package_id' => $id,
                    'higlight_id' => $value,
                ];
                HiglightsPivot::create($highlights);
            }
        }
    }

    public function galleryData(Request $request, $id)
    {
        if (isset($request->video_link)) {
            foreach ($request->video_link as $link) {
                $gallery = [
                    'package_id' => $id,
                    'language_id' => $request->language_id,
                    'video_link' => $link,
                ];
                Gallery::create($gallery);
            }
        }
    }
}






