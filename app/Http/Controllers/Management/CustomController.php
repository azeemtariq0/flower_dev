<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Custom;
use App\Models\CustomPivot;
use App\Helpers\DefaultLanguage;
use App\Models\Language;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['language'] = Language::where('bydefault', null)->where('status',1)->get();
        $language = DefaultLanguage::SelectedLanguage();
        $data['custom'] = Custom::where('language_id', $language->id)->latest()->get();
        return view('management.custom.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        return view('management.custom.create', compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request->title,
            'language_id' => $request->language_id,
        ];
        $custom = Custom::create($data);
        $customdata = [
            'title' => $request->title,
            'custom_id' => $custom->id,
            'language_id' => $request->language_id,
        ];
        $customPivot = CustomPivot::create($customdata);
        return redirect()->route('custom.show', $custom->id)->with('success', 'Custom Title Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Custom $custom
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = DefaultLanguage::SelectedLanguage();
        $custom = Custom::where('id', $id)->get()->first();
        return view('management.custom.edit', compact('custom', 'language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Custom $custom
     * @return \Illuminate\Http\Response
     */
    public function edit(Custom $custom)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Custom $custom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $custom = Custom::where('id', $id)->get()->first();
        $customPivot = CustomPivot::where('custom_id', $id)->get()->first();
        $custom->update([
            'title' => $request->title,
            'language_id' => $request->language_id,
        ]);
        $customPivot->update([
            'title' => $request->title,
            'custom_id' => $custom->id,
            'language_id' => $request->language_id,
        ]);
        return redirect()->back()->with('success', "Custom Title Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Custom $custom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $custom = Custom::where('id', $id)->delete();
        return redirect()->back()->with('success', "Custom Title Deleted Successfully");
    }

    public function allCustom()
    {
        $data['translated'] = null;
        $language_id = $_GET['language_id'];
        $data['language'] = Language::where('bydefault', null)->get();
        $data['translated'] = Custom::Leftjoin('custom_pivots', 'customs.id', '=', 'custom_pivots.custom_id')
            ->where('custom_pivots.language_id', (int)$language_id)
            ->pluck('customs.id')->toArray();
        $data['multi_data'] = Custom::Leftjoin('custom_pivots', 'customs.id', '=', 'custom_pivots.custom_id')
            ->where('custom_pivots.language_id', DefaultLanguage::SelectedLanguage()->id)
            ->select('customs.id', 'custom_pivots.language_id', 'custom_pivots.title')->get();
        return view('management.custom.allcustom', $data);
    }

    public function getCustom(Request $request, $id)
    {
        $language = Language::where('id', $request->language_id)->get()->first();
        $translated = Custom::Leftjoin('custom_pivots', 'customs.id', '=', 'custom_pivots.custom_id')
            ->where('custom_pivots.language_id', $request->language_id)
            ->pluck('customs.id')->toArray();
        $custom = Custom::Leftjoin('custom_pivots', 'customs.id', '=', 'custom_pivots.custom_id')
            ->where('customs.id', $id)
            ->where('custom_pivots.language_id', $request->language_id)
            ->select('customs.id', 'custom_pivots.language_id', 'custom_pivots.title')->get()->first();
        if ($custom == null) {
            $custom = Custom::Leftjoin('custom_pivots', 'customs.id', '=', 'custom_pivots.custom_id')
                ->where('customs.id', $id)
                ->where('custom_pivots.language_id', DefaultLanguage::SelectedLanguage()->id)
                ->select('customs.id', 'custom_pivots.language_id', 'custom_pivots.title')->get()->first();
        }
        return view('management.custom.editCustom', compact('custom', 'language', 'translated'));
    }

    public function updateCustom(Request $request, $id)
    {
        $customdata = [
            'title' => $request->title,
            'custom_id' => $id,
            'language_id' => $request->language_id,
        ];
        $customPivot = CustomPivot::create($customdata);
        return redirect()->back()->with('success', "Custom Title Created Successfully");
    }
}
