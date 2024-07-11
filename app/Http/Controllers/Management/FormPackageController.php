<?php

namespace App\Http\Controllers\Management;
use App\Http\Controllers\Controller;
use App\Helpers\DefaultLanguage;
use App\Models\FormPackage;
use Illuminate\Http\Request;

class FormPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=FormPackage::latest()->get();
        return view('management.form_package.index',compact('data'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormPackage  $formPackage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=FormPackage::find($id);
        return view('management.form_package.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormPackage  $formPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(FormPackage $formPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormPackage  $formPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormPackage $formPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormPackage  $formPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FormPackage::find($id)->delete();
        return redirect()->back()->with('success', 'Booking Form Delete successfully');
    }
}
