<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $language = Language::latest()->get();
        return view('management/language/index', compact('language'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management/language/create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'language_name' => 'required',
                'language_code' => 'required',
                'status' => 'required',
            ]);

        $language = [

            'language_name' => $request->language_name,
            'language_code' => $request->language_code,
            'status' => $request->status,

        ];

        $language = Language::create($language);
        return redirect()->route('language.show', $language->id)->with('success', 'Language has been created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::where('id', $id)->get()->first();

        return view('management/language/edit', compact('language'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Language::where('id', $id)->get()->first();


        $data->update([
            'language_name' => $request->language_name,
            'language_code' => $request->language_code,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Language has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Language::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Language has been deleted successfully');
    }
}
