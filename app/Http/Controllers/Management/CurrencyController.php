<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = Currency::latest()->get();
        return view('management.currency.index',compact('currency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $countries = Country::get();
        return view('management.currency.create',compact('countries'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $data = [
//            "status"=>$request->status,
//            "bydefault"=>$request->bydefault,
//            "currency_name"=>$request->currency_name,
//            "currency_code"=>$request->currency_code,
//            "currency_rate"=>$request->currency_rate,
//            "country_id"=>$request->country_id,
//        ];

        $currency = Currency::create($request->all());
        return redirect()->back()->with('success','currency has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Currency::where('id',$id)->get()->first();
        $countries = Country::get();
        return view('management/currency/edit',compact('language','countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = Currency::where('id',$id)->get()->first();

        $data->update([
            "status"=>$request->status,
            "currency_name"=>$request->currency_name,
            "currency_symbol"=>$request->currency_symbol,
            "currency_code"=>$request->currency_code,
            "currency_rate"=>$request->currency_rate,
            "language_code"=>$request->language_code,
            "country_id"=>$request->country_id,
        ]);
        return redirect()->back()->with('success','currency has been Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Currency::where('id',$id)->get()->first()->delete();
        return redirect()->back()->with('success','Data has been deleted Successfully');
    }
}
