<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountryDetail;
use App\Helpers\DefaultLanguage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::latest()->get();
        return view('management/country/index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        return view('management.country.create', compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = Country::create([
            'title' => $request->title,
            'status' => $request->status
        ]);
        CountryDetail::create([
            'country_id' => $country->id,
            'title' => $request->title,
            'language_id' => $request->language_id,
        ]);
        return redirect()->route('countries.show',$country->id)->with('success', "Country Added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\countrySelected  $countrySelected
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['language'] = DefaultLanguage::SelectedLanguage();
        $data['country'] = Country::where('id', $id)->get()->first();
        $data['country_details'] = CountryDetail::where('country_id', $id)->where('language_id',$data['language']->id)->get()->first();
        return view('management.country.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\countrySelected  $countrySelected
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $country = Country::where('id', $id)->get()->first();
        $country_details = CountryDetail::where('country_id', $id)->get()->first();
        $country->update([
            'title' => $request->title,
            'status' => $request->status
        ]);
        $country_details->update([
            'country_id' => $id,
            'title' => $request->title,
            'language_id' => $request->language_id,
        ]);
        return redirect()->back()->with('success', "Country Updated Successfully");
    }
    public function destroy($id)
    {
        $country = Country::where('id', $id)->delete();
        return redirect()->back()->with('success', "Country Deleted Successfully");
    }

}
