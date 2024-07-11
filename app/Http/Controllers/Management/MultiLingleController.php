<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\Country;
use App\Models\BlogsTestimonial;
use App\Models\BlogTestimonialPivot;
use App\Models\CountryDetail;
use App\Models\HighlightsDetail;
use App\Models\faqs;
use App\Models\Menu;
use App\Models\MenuPivot;
use App\Models\City;
use App\Models\CityDetail;
use App\Models\State;
use App\Models\StatePivot;
use App\Models\faqs_details;
use App\Models\Highlights;
use App\Models\HolidayDetail;
use App\Models\Holidays;
use App\Models\HotelDetail;
use App\Models\HotelPackage;
use App\Models\InclusionsExclusions;
use App\Models\Itinerary;
use App\Models\ItineraryDetail;
use App\Models\media;
use App\Models\Package;
use App\Models\PackageDetail;
use App\Models\seo;
use App\Models\blog;
use App\Models\BlogDetail;
use App\Models\DestinationTheme;
use App\Models\ThemeDetail;
use App\Models\Testimonial;
use App\Models\TestimonialDetail;
use App\Models\CategoryDetail;
use App\Models\Language;
use App\Helpers\DefaultLanguage;
use App\Models\Activities;
use App\Models\ActivitiesPivot;
use App\Models\inclusion;
use App\Models\inclusionPivot;
use App\Models\MultiLingle;
use Illuminate\Http\Request;

class MultiLingleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['multi_data'] = null;
        $data['translated'] = null;
        $data['language'] = Language::where('bydefault', null)->where('status', 1)->get();
        if ($request->multi_criteria == "categories") {
            $data['translated'] = categories::Leftjoin('category_details', 'categories.id', '=', 'category_details.category_id')
                ->where('category_details.language_id', $request->language_id)
                ->pluck('categories.id')->toArray();
            $data['multi_data'] = categories::Leftjoin('category_details', 'categories.id', '=', 'category_details.category_id')
                ->where('category_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('categories.id', 'category_details.language_id', 'category_details.title', 'category_details.description')->get();
        } else if ($request->multi_criteria == "hotel") {
            $data['translated'] = HotelPackage::Leftjoin('hotel_details', 'hotel_packages.id', '=', 'hotel_details.hotel_id')
                ->where('hotel_details.language_id', $request->language_id)
                ->pluck('hotel_packages.id')->toArray();
            $data['multi_data'] = HotelPackage::Leftjoin('hotel_details', 'hotel_packages.id', '=', 'hotel_details.hotel_id')
                ->where('hotel_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('hotel_packages.id', 'hotel_details.language_id', 'hotel_details.tags', 'hotel_details.title', 'hotel_details.description', 'hotel_details.address')->get();
        } else if ($request->multi_criteria == "package") {
            $data['translated'] = Package::Leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
                ->where('package_details.language_id', $request->language_id)
                ->pluck('packages.id')->toArray();
            $data['multi_data'] = Package::Leftjoin('package_details', 'packages.id', '=', 'package_details.package_id')
                ->where('package_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('packages.id', 'package_details.language_id', 'package_details.tags', 'package_details.title', 'package_details.description')->get();
        } else if ($request->multi_criteria == "itinerary") {
            $data['translated'] = Itinerary::Leftjoin('itinerary_details', 'itineraries.id', '=', 'itinerary_details.itinerary_id')
                ->where('itinerary_details.language_id', $request->language_id)
                ->pluck('itineraries.id')->toArray();
            $data['multi_data'] = Itinerary::Leftjoin('itinerary_details', 'itineraries.id', '=', 'itinerary_details.itinerary_id')
                ->where('itinerary_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('itineraries.id', 'itinerary_details.language_id', 'itinerary_details.title', 'itinerary_details.description')->get();
        } else if ($request->multi_criteria == "faqs") {
            $data['translated'] = faqs::Leftjoin('faqs_details', 'faqs.id', '=', 'faqs_details.faqs_id')
                ->where('faqs_details.language_id', $request->language_id)
                ->pluck('faqs.id')->toArray();

            $data['multi_data'] = faqs::Leftjoin('faqs_details', 'faqs.id', '=', 'faqs_details.faqs_id')
                ->where('faqs_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('faqs.id', 'faqs.title')->groupBy('id', 'title')->get();
        } else if ($request->multi_criteria == "highlights") {
            $data['translated'] = Highlights::Leftjoin('highlights_details', 'highlights.id', '=', 'highlights_details.highlight_id')
                ->where('highlights_details.language_id', $request->language_id)
                ->pluck('highlights.id')->toArray();

            $data['multi_data'] = Highlights::Leftjoin('highlights_details', 'highlights.id', '=', 'highlights_details.highlight_id')
                ->where('highlights_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('highlights.id', 'highlights.title')->groupBy('highlights.id', 'highlights.title')->get();
        } else if ($request->multi_criteria == "inclusion_exclusion") {
            $data['translated'] = inclusion::Leftjoin('inclusion_pivot', 'inclusions.id', '=', 'inclusion_pivot.inc_exc_id')
                ->where('inclusion_pivot.language_id', $request->language_id)
                ->pluck('inclusions.id')->toArray();
            $data['multi_data'] = inclusion::Leftjoin('inclusion_pivot', 'inclusions.id', '=', 'inclusion_pivot.inc_exc_id')
                ->where('inclusion_pivot.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('inclusions.id', 'inclusion_pivot.language_id', 'inclusion_pivot.title')->get();
        } else if ($request->multi_criteria == "activities") {
            $data['translated'] = Activities::Leftjoin('activities_pivot', 'activities.id', '=', 'activities_pivot.activity_id')
                ->where('activities_pivot.language_id', $request->language_id)
                ->pluck('activities.id')->toArray();
            $data['multi_data'] = Activities::Leftjoin('activities_pivot', 'activities.id', '=', 'activities_pivot.activity_id')
                ->where('activities_pivot.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('activities.id', 'activities_pivot.language_id', 'activities_pivot.title')->get();
        } else if ($request->multi_criteria == "precautions") {
            $data['translated'] = Holidays::Leftjoin('holiday_details', 'holidays.id', '=', 'holiday_details.holiday_id')
                ->where('holiday_details.language_id', $request->language_id)
                ->pluck('holidays.id')->toArray();
            $data['multi_data'] = Holidays::Leftjoin('holiday_details', 'holidays.id', '=', 'holiday_details.holiday_id')
                ->where('holiday_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('holidays.id', 'holiday_details.language_id', 'holiday_details.title')->get();
        } else if ($request->multi_criteria == "theme") {
            $data['translated'] = DestinationTheme::Leftjoin('theme_details', 'destination_themes.id', '=', 'theme_details.themes_id')
                ->where('theme_details.language_id', $request->language_id)
                ->pluck('destination_themes.id')->toArray();
            $data['multi_data'] = DestinationTheme::Leftjoin('theme_details', 'destination_themes.id', '=', 'theme_details.themes_id')
                ->where('theme_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('destination_themes.id', 'theme_details.language_id', 'theme_details.title')->get();
        } else if ($request->multi_criteria == "country") {
            $data['translated'] = Country::Leftjoin('country_details', 'countries.id', '=', 'country_details.country_id')
                ->where('country_details.language_id', $request->language_id)
                ->pluck('countries.id')->toArray();
            $data['multi_data'] = Country::Leftjoin('country_details', 'countries.id', '=', 'country_details.country_id')
                ->where('country_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('countries.id', 'country_details.language_id', 'country_details.title')->get();
        } else if ($request->multi_criteria == "state") {
            $data['translated'] = State::Leftjoin('state_pivots', 'states.id', '=', 'state_pivots.state_id')
                ->where('state_pivots.language_id', $request->language_id)
                ->pluck('states.id')->toArray();
            $data['multi_data'] = State::Leftjoin('state_pivots', 'states.id', '=', 'state_pivots.state_id')
                ->leftJoin('countries', 'countries.id', '=', 'states.country_id')
                ->where('state_pivots.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('states.id', 'state_pivots.language_id', 'countries.title')->groupBy('states.country_id')->get();
        } else if ($request->multi_criteria == "city") {
            $data['translated'] = City::Leftjoin('city_details', 'cities.id', '=', 'city_details.city_id')
                ->where('city_details.language_id', $request->language_id)
                ->pluck('cities.states_id')->toArray();
            $data['multi_data'] = City::Leftjoin('city_details', 'cities.id', '=', 'city_details.city_id')
                ->leftJoin('state_pivots', 'state_pivots.id', '=', 'cities.states_id')
                ->where('city_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('cities.states_id as id', 'city_details.language_id', 'state_pivots.title')->groupBy('cities.states_id')->get();
        } else if ($request->multi_criteria == "menu") {
            $data['translated'] = Menu::Leftjoin('menu_pivots', 'menus.id', '=', 'menu_pivots.menu_id')
                ->where('menu_pivots.language_id', $request->language_id)
                ->pluck('menu_pivots.menu_id')->toArray();
            $data['multi_data'] = Menu::Leftjoin('menu_pivots', 'menus.id', '=', 'menu_pivots.menu_id')
                ->where('menu_pivots.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('menus.id', 'menu_pivots.language_id', 'menus.title')->groupBy('menus.id')->get();
        } else if ($request->multi_criteria == "page") {
            $data['translated'] = blog::Leftjoin('blog_details', 'blogs.id', '=', 'blog_details.blog_id')
                ->where('blog_details.language_id', $request->language_id)
                ->pluck('blogs.id')->toArray();
            $data['multi_data'] = blog::Leftjoin('blog_details', 'blogs.id', '=', 'blog_details.blog_id')
                ->where('blog_details.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('blogs.id', 'blog_details.language_id', 'blog_details.title')->groupBy('blogs.id')->get();
        } else if ($request->multi_criteria == "blogs_testimonial") {
            $data['translated'] = BlogsTestimonial::Leftjoin('blog_testimonial_pivots', 'blogs_testimonials.id', '=', 'blog_testimonial_pivots.blog_testimonial_id')
                ->where('blog_testimonial_pivots.language_id', $request->language_id)
                ->pluck('blogs_testimonials.id')->toArray();
            $data['multi_data'] = BlogsTestimonial::Leftjoin('blog_testimonial_pivots', 'blogs_testimonials.id', '=', 'blog_testimonial_pivots.blog_testimonial_id')
                ->where('blog_testimonial_pivots.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('blogs_testimonials.id', 'blog_testimonial_pivots.language_id', 'blogs_testimonials.title')->groupBy('blogs_testimonials.id')->get();
        } else {
            $data['language'] = Language::where('bydefault', null)->where('status', 1)->get();
        }

        return view('management.multilingle.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\MultiLingle $multiLingle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data['multi_data'] = null;
        $data['language'] = null;
        $data['language'] = Language::where('id', $request->language_id)->get()->first();
        $data['package'] = Package::where('id', $id)->get()->first();
        $data['package_detail'] = PackageDetail::where('package_id', $id)->get()->first();

        if ($request->multi_criteria == "categories") {
            $data['multi_data'] = MultiLingleController::getCategory($id, $request->language_id);
            return view('management.multilingle.category_edit', $data);
        } else if ($request->multi_criteria == "hotel") {
            $data['multi_data'] = MultiLingleController::getHotel($id, $request->language_id);
            return view('management.multilingle.hotel_edit', $data);
        } else if ($request->multi_criteria == "itinerary") {
            $data['multi_data'] = MultiLingleController::getitinerary($id, $request->language_id);
            return view('management.multilingle.itinerary_edit', $data);
        } else if ($request->multi_criteria == "activities") {
            $data['multi_data'] = MultiLingleController::getActivity($id, $request->language_id);
            return view('management.multilingle.activity_edit', $data);
        } else if ($request->multi_criteria == "faqs") {
            $data['faqs'] = faqs::where('id', $id)->get()->first();
            $data['multi_data'] = MultiLingleController::getFAQS($id, $request->language_id);
            return view('management.multilingle.faqs_edit', $data);
        } else if ($request->multi_criteria == "highlights") {
            $data['highlight'] = Highlights::where('id', $id)->get()->first();
            $data['multi_data'] = MultiLingleController::getHighlights($id, $request->language_id);
            return view('management.multilingle.highlight_edit', $data);
        } else if ($request->multi_criteria == "inclusion_exclusion") {
            $data['multi_data'] = MultiLingleController::getInclusionExclusion($id, $request->language_id);
            return view('management.multilingle.inclusion_edit', $data);
        } else if ($request->multi_criteria == "precautions") {
            $data['multi_data'] = MultiLingleController::getHoliday($id, $request->language_id);
            return view('management.multilingle.holiday_edit', $data);
        } else if ($request->multi_criteria == "theme") {
            $data['multi_data'] = MultiLingleController::getTheme($id, $request->language_id);
            return view('management.multilingle.theme_edit', $data);
        } else if ($request->multi_criteria == "country") {
            $data['multi_data'] = MultiLingleController::getCountry($id, $request->language_id);
            return view('management.multilingle.country_edit', $data);
        } else if ($request->multi_criteria == "state") {
            $data['state'] = State::where('id', $id)->get()->first();
            $data['countries'] = Country::leftJoin('country_details', 'country_details.country_id', '=', 'countries.id')
                ->where('country_details.language_id', $request->language_id)->select('countries.id', 'country_details.title')->get();
            $data['multi_data'] = MultiLingleController::getState($id, $request->language_id);
            return view('management.multilingle.state_edit', $data);
        } else if ($request->multi_criteria == "city") {
            $data['states'] = State::leftJoin('state_pivots', 'state_pivots.state_id', '=', 'states.id')
                ->where('state_pivots.language_id', DefaultLanguage::SelectedLanguage()->id)->select('state_pivots.id', 'state_pivots.title')->get();
            $data['city'] = City::leftJoin('city_details', 'city_details.city_id', '=', 'cities.id')
                ->where('cities.states_id', $id)->select('cities.states_id', 'city_details.title', 'city_details.id')->first();
            $data['multi_data'] = MultiLingleController::getCity($id, $request->language_id);
            return view('management.multilingle.city_edit', $data);
        } else if ($request->multi_criteria == "menu") {
            $data['menu'] = Menu::leftJoin('menu_pivots', 'menu_pivots.menu_id', '=', 'menus.id')
                ->where('menus.id', $id)->select('menus.id', 'menu_pivots.title')->first();
            $data['multi_data'] = MultiLingleController::getMenu($id, $request->language_id);
            return view('management.multilingle.menu_edit', $data);
        } else if ($request->multi_criteria == "page") {
            $data['multi_data'] = MultiLingleController::getPages($id, $request->language_id);
            return view('management.multilingle.blog_edit', $data);
        } else if ($request->multi_criteria == "blogs_testimonial") {
            $data['multi_data'] = MultiLingleController::getBlogTestimonial($id, $request->language_id);
            return view('management.multilingle.blog_testimonial', $data);
        } else if ($request->multi_criteria == "package") {
            $data['cate'] = categories::leftJoin('category_details', 'categories.id', '=', 'category_details.category_id')
                ->where('categories.reference_type', 'package')
                ->select('categories.id', 'category_details.title')
                ->get();
            $data['multi_data'] = MultiLingleController::getPackage($id, $request->language_id);
            $data['hotel'] = HotelPackage::get();
            $data['countries'] = Country::leftjoin('country_details', 'country_details.country_id', '=', 'countries.id')
                ->where('country_details.language_id', $request->language_id)->select('countries.id', 'country_details.title')->get();
            $data['activities'] = Activities::leftJoin('activities_pivot', 'activities_pivot.activity_id', 'activities.id')
                ->select('activities.id', 'activities_pivot.title', 'activities_pivot.language_id')
                ->where('activities_pivot.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->where('activities.id', $id)
                ->get()->first();

            return view('management.multilingle.package_edit', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MultiLingle $multiLingle
     * @return \Illuminate\Http\Response
     */
    public function edit(MultiLingle $multiLingle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MultiLingle $multiLingle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->multi_criteria == "categories") {
            $data = CategoryDetail::where('category_id', $id)->where('language_id', $request->language_id)->delete();
            CategoryDetail::create([
                'title' => $request->title,
                'category_id' => $id,
                'language_id' => $request->language_id,
                'description' => $request->description,
            ]);
        } else if ($request->multi_criteria == "hotel") {
            $data = HotelDetail::where('hotel_id', $id)->where('language_id', $request->language_id)->delete();
            HotelDetail::create([
                'hotel_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->title,
                'description' => $request->description,
                'address' => $request->address,
                'tags' => $request->tags,
            ]);
        } else if ($request->multi_criteria == "itinerary") {
            $data = ItineraryDetail::where('itinerary_id', $id)->where('language_id', $request->language_id)->delete();
            ItineraryDetail::create([
                'itinerary_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->title,
                'description' => $request->description,
                'tags' => $request->tags,
            ]);
        } else if ($request->multi_criteria == "activities") {
            $data = ActivitiesPivot::where('activity_id', $id)->where('language_id', $request->language_id)->delete();
            ActivitiesPivot::create([
                'activity_id' => $id,
                'title' => $request->title,
                'language_id' => $request->language_id,
            ]);
        } else if ($request->multi_criteria == "faqs") {
            $data = faqs_details::where('faqs_id', $id)->where('language_id', $request->language_id)->delete();
            $var = $request['faqs_question'];
            $i = 0;
            foreach ($var as $faqs) {
                $a = $request->faqs_answer;
                faqs_details::create([
                    'faqs_id' => $id,
                    'title' => $request->title,
                    'language_id' => $request->language_id,
                    'faqs_question' => $faqs,
                    'faqs_answer' => $request->faqs_answer[$i],
                ]);
                $i++;
            }
        } else if ($request->multi_criteria == "inclusion_exclusion") {
            $data = inclusionPivot::where('inc_exc_id', $id)->where('language_id', $request->language_id)->delete();
            inclusionPivot::create([
                'inc_exc_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->inclusion_name,
            ]);
        } else if ($request->multi_criteria == "precautions") {
            $data = HolidayDetail::where('holiday_id', $id)->where('language_id', $request->language_id)->delete();
            HolidayDetail::create([
                'holiday_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        } else if ($request->multi_criteria == "theme") {
            $data = ThemeDetail::where('themes_id', $id)->where('language_id', $request->language_id)->delete();
            ThemeDetail::create([
                'themes_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        } else if ($request->multi_criteria == "country") {
            $data = CountryDetail::where('country_id', $id)->where('language_id', $request->language_id)->delete();
            CountryDetail::create([
                'country_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->title,
            ]);
        } else if ($request->multi_criteria == "state") {
            $data = StatePivot::where('state_id', $id)->where('language_id', $request->language_id)->delete();
            foreach ($request->title as $state) {
                StatePivot::create([
                    'state_id' => $id,
                    'title' => $state,
                    'language_id' => $request->language_id,
                ]);
            }
        } else if ($request->multi_criteria == "highlights") {
            $data = HighlightsDetail::where('highlight_id', $id)->where('language_id', $request->language_id)->delete();
            foreach ($request->highlights as $highlight) {
                HighlightsDetail::create([
                    'highlight_id' => $id,
                    'title' => $request->title,
                    'highlights' => $highlight,
                    'language_id' => $request->language_id,
                ]);
            }
        } else if ($request->multi_criteria == "city") {
            $data = CityDetail::where('city_id', $id)->where('language_id', $request->language_id)->delete();
            $i = 0;
            foreach ($request->title as $city) {
                CityDetail::create([
                    'city_id' => $request->city_id[$i],
                    'states_id' => $request->states_id,
                    'title' => $city,
                    'language_id' => $request->language_id,
                ]);
                $i++;
            }
        } else if ($request->multi_criteria == "package") {
            $data = PackageDetail::where('package_id', $id)->where('language_id', $request->language_id)->delete();
            PackageDetail::create([
                'package_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->title,
                'description' => $request->description,
                'tags' => $request->tags,
            ]);
        } else if ($request->multi_criteria == "menu") {
            $data = MenuPivot::where('menu_id', $id)->where('language_id', $request->language_id)->delete();
            MenuPivot::create([
                'menu_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->title,
            ]);
        } else if ($request->multi_criteria == "blogs_testimonial") {
            BlogTestimonialPivot::where('blog_testimonial_id', $id)->where('language_id', $request->language_id)->delete();
            BlogTestimonialPivot::create([
                'blog_testimonial_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->title,
                'description' => $request->description,
                'tags' => $request->tags,
                'trip_to' => $request->trip_to,
                'user_name' => $request->user_name,
                'user_city' => $request->user_city,
                'date' => $request->date,
            ]);
        } else if ($request->multi_criteria == "page") {
            $data = BlogDetail::where('blog_id', $id)->where('language_id', $request->language_id)->delete();
            BlogDetail::create([
                'blog_id' => $id,
                'language_id' => $request->language_id,
                'title' => $request->title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);
        }
        return redirect()->back()->with('success', 'Language Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MultiLingle $multiLingle
     * @return \Illuminate\Http\Response
     */
    public function destroy(MultiLingle $multiLingle)
    {
        //
    }

    public function getMenu($id, $lang_id)
    {
        $already = MenuPivot::where('menu_id', $id)->where('language_id', $lang_id)->first();
        $data = Menu::Leftjoin('menu_pivots', 'menus.id', '=', 'menu_pivots.menu_id');
        if ($already != null) {
            $data = $data->where('menus.id', $id)->where('menu_pivots.language_id', $lang_id);
        } else {
            $data = $data->where('menus.id', $id)->where('menu_pivots.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('menus.id', 'menu_pivots.language_id', 'menu_pivots.title')->get()->first();
        return $data;
    }

    public function getBlogTestimonial($id, $lang_id)
    {
        $already = BlogTestimonialPivot::where('blog_testimonial_id', $id)->where('language_id', $lang_id)->first();
        $data = BlogsTestimonial::Leftjoin('blog_testimonial_pivots', 'blogs_testimonials.id', '=', 'blog_testimonial_pivots.blog_testimonial_id');
        if ($already != null) {
            $data = $data->where('blogs_testimonials.id', $id)->where('blog_testimonial_pivots.language_id', $lang_id);
        } else {
            $data = $data->where('blogs_testimonials.id', $id)->where('blog_testimonial_pivots.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('blogs_testimonials.id', 'blog_testimonial_pivots.language_id', 'blog_testimonial_pivots.title', 'blog_testimonial_pivots.description', 'blog_testimonial_pivots.tags', 'blog_testimonial_pivots.trip_to', 'blog_testimonial_pivots.user_name', 'blog_testimonial_pivots.user_city', 'blog_testimonial_pivots.date')->get()->first();
        return $data;
    }

    public function getCategory($id, $lang_id)
    {
        $already = CategoryDetail::where('category_id', $id)->where('language_id', $lang_id)->first();
        $data = categories::Leftjoin('category_details', 'categories.id', '=', 'category_details.category_id');
        if ($already != null) {
            $data = $data->where('categories.id', $id)->where('category_details.language_id', $lang_id);
        } else {
            $data = $data->where('categories.id', $id)->where('category_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('categories.id', 'category_details.language_id', 'category_details.title', 'category_details.description')->get()->first();
        return $data;
    }

    public function getCountry($id, $lang_id)
    {
        $already = CountryDetail::where('country_id', $id)->where('language_id', $lang_id)->first();
        $data = Country::Leftjoin('country_details', 'countries.id', '=', 'country_details.country_id');
        if ($already != null) {
            $data = $data->where('countries.id', $id)->where('country_details.language_id', $lang_id);
        } else {
            $data = $data->where('countries.id', $id)->where('country_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('countries.id', 'country_details.language_id', 'country_details.title',)->get()->first();
        return $data;
    }

    public function getState($id, $lang_id)
    {
        $already = StatePivot::where('state_id', $id)->where('language_id', $lang_id)->first();
        $data = State::Leftjoin('state_pivots', 'states.id', '=', 'state_pivots.state_id');
        if ($already != null) {
            $data = $data->where('states.id', $id)->where('state_pivots.language_id', $lang_id);
        } else {
            $data = $data->where('states.id', $id)->where('state_pivots.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('states.id', 'state_pivots.language_id', 'state_pivots.title', 'states.country_id')->get();
        return $data;
    }

    public function getCity($id, $lang_id)
    {
        $already = CityDetail::where('states_id', $id)->where('language_id', $lang_id)->first();
        $data = City::Leftjoin('city_details', 'cities.id', '=', 'city_details.city_id');
        if ($already != null) {
            $data = $data->where('cities.states_id', $id)->where('city_details.language_id', $lang_id);
        } else {
            $data = $data->where('cities.states_id', $id)->where('city_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('cities.id', 'city_details.states_id', 'city_details.language_id', 'city_details.title')->get();
        return $data;
    }

    public function getHoliday($id, $lang_id)
    {
        $already = HolidayDetail::where('holiday_id', $id)->where('language_id', $lang_id)->first();
        $data = Holidays::Leftjoin('holiday_details', 'holidays.id', '=', 'holiday_details.holiday_id');
        if ($already != null) {
            $data = $data->where('holidays.id', $id)->where('holiday_details.language_id', $lang_id);
        } else {
            $data = $data->where('holidays.id', $id)->where('holiday_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('holidays.id', 'holiday_details.language_id', 'holiday_details.title', 'holiday_details.description')->get()->first();
        return $data;
    }

    public function getActivity($id, $lang_id)
    {
        $already = ActivitiesPivot::where('activity_id', $id)->where('language_id', $lang_id)->first();
        $data = Activities::Leftjoin('activities_pivot', 'activities.id', '=', 'activities_pivot.activity_id');
        if ($already != null) {
            $data = $data->where('activities.id', $id)->where('activities_pivot.language_id', $lang_id);
        } else {
            $data = $data->where('activities.id', $id)->where('activities_pivot.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('activities.id', 'activities_pivot.language_id', 'activities_pivot.title')->get()->first();
        return $data;
    }

    public function getFAQS($id, $lang_id)
    {
        $already = faqs_details::where('faqs_id', $id)->where('language_id', $lang_id)->first();
        $data = faqs::Leftjoin('faqs_details', 'faqs.id', '=', 'faqs_details.faqs_id');
        if ($already != null) {
            $data = $data->where('faqs.id', $id)->where('faqs_details.language_id', $lang_id);
        } else {
            $data = $data->where('faqs.id', $id)->where('faqs_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('faqs.id', 'faqs_details.language_id', 'faqs_details.title', 'faqs_details.faqs_question', 'faqs_details.faqs_answer')->get();
        return $data;
    }

    public function getHighlights($id, $lang_id)
    {
        $already = HighlightsDetail::where('highlight_id', $id)->where('language_id', $lang_id)->first();
        $data = Highlights::Leftjoin('highlights_details', 'highlights.id', '=', 'highlights_details.highlight_id');
        if ($already != null) {
            $data = $data->where('highlights.id', $id)->where('highlights_details.language_id', $lang_id);
        } else {
            $data = $data->where('highlights.id', $id)->where('highlights_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('highlights.id', 'highlights_details.language_id', 'highlights_details.title', 'highlights_details.highlights')->get();
        return $data;
    }

    public function getInclusionExclusion($id, $lang_id)
    {
        $already = inclusionPivot::where('inc_exc_id', $id)->where('language_id', $lang_id)->first();
        $data = inclusion::Leftjoin('inclusion_pivot', 'inclusions.id', '=', 'inclusion_pivot.inc_exc_id');
        if ($already != null) {
            $data = $data->where('inclusions.id', $id)->where('inclusion_pivot.language_id', $lang_id);
        } else {
            $data = $data->where('inclusions.id', $id)->where('inclusion_pivot.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('inclusions.id', 'inclusion_pivot.language_id', 'inclusion_pivot.title')->get()->first();
        return $data;
    }

    public function getHotel($id, $lang_id)
    {
        $already = HotelDetail::where('hotel_id', $id)->where('language_id', $lang_id)->first();
        $data = HotelPackage::Leftjoin('hotel_details', 'hotel_packages.id', '=', 'hotel_details.hotel_id');
        if ($already != null) {
            $data = $data->where('hotel_packages.id', $id)->where('hotel_details.language_id', $lang_id);
        } else {
            $data = $data->where('hotel_packages.id', $id)->where('hotel_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('hotel_packages.id', 'hotel_details.language_id', 'hotel_details.tags', 'hotel_details.title', 'hotel_details.description', 'hotel_details.address')->get()->first();
        return $data;
    }

    public function getTheme($id, $lang_id)
    {
        $already = ThemeDetail::where('themes_id', $id)->where('language_id', $lang_id)->first();
        $data = DestinationTheme::Leftjoin('theme_details', 'destination_themes.id', '=', 'theme_details.themes_id');
        if ($already != null) {
            $data = $data->where('destination_themes.id', $id)->where('theme_details.language_id', $lang_id);
        } else {
            $data = $data->where('destination_themes.id', $id)->where('theme_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('destination_themes.id', 'theme_details.language_id', 'theme_details.title', 'theme_details.description')->get()->first();
        return $data;
    }

    public function getPackage($id, $lang_id)
    {
        $already = PackageDetail::where('package_id', $id)->where('language_id', $lang_id)->first();
        $data = Package::Leftjoin('package_details', 'packages.id', '=', 'package_details.package_id');
        if ($already != null) {
            $data = $data->where('packages.id', $id)->where('package_details.language_id', $lang_id);
        } else {
            $data = $data->where('packages.id', $id)->where('package_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('packages.id', 'packages.category_id', 'packages.hotel_id', 'package_details.language_id', 'package_details.tags', 'package_details.title', 'package_details.description')->get()->first();
        return $data;
    }

    public function getitinerary($id, $lang_id)
    {
        $already = ItineraryDetail::where('itinerary_id', $id)->where('language_id', $lang_id)->first();
        $data = Itinerary::Leftjoin('itinerary_details', 'itineraries.id', '=', 'itinerary_details.itinerary_id');
        if ($already != null) {
            $data = $data->where('itineraries.id', $id)->where('itinerary_details.language_id', $lang_id);
        } else {
            $data = $data->where('itineraries.id', $id)->where('itinerary_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('itineraries.id', 'itinerary_details.itinerary_id', 'itinerary_details.language_id', 'itinerary_details.title', 'itinerary_details.description', 'itinerary_details.tags')->get()->first();
        return $data;
    }

    public function getPages($id, $lang_id)
    {
        $already = BlogDetail::where('blog_id', $id)->where('language_id', $lang_id)->first();
        $data = blog::Leftjoin('blog_details', 'blogs.id', '=', 'blog_details.blog_id');
        if ($already != null) {
            $data = $data->where('blogs.id', $id)->where('blog_details.language_id', $lang_id);
        } else {
            $data = $data->where('blogs.id', $id)->where('blog_details.language_id', DefaultLanguage::SelectedLanguage()->id);
        }
        $data = $data->select('blogs.id', 'blog_details.language_id', 'blog_details.title', 'blog_details.short_description', 'blog_details.long_description')->get()->first();
        return $data;
    }
}
