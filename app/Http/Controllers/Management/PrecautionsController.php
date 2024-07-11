<?php

namespace App\Http\Controllers\Management;

use App\Helpers\DefaultLanguage;
use App\Http\Controllers\Controller;
use App\Models\Holidays;
use App\Models\HolidayDetail;
use App\Models\Language;
use App\Models\media;
use Illuminate\Http\Request;

class PrecautionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precautions=Holidays::leftJoin('media', function ($join) {
            $join->on('holidays.id', '=', 'media.reference_id');
        })
            ->where('media.reference_type', '=', 'holidays')
            ->select('holidays.id', 'holidays.*','media.image')
            ->orderBy('holidays.created_at', 'desc')->get();
        return view('management/precautions/index',compact('precautions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        return view('management/precautions/create', compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        $data = [
            'title' => $request->title,
            'status' => $request->status,
        ];
        $precautions = Holidays::create($data);
        $precautionsDetail = [
            'holiday_id' => $precautions->id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
        ];
        $precautionsDetails = HolidayDetail::create($precautionsDetail);
        if ($request->file('image')) {
            $mainext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'precautions' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $request->image->move(public_path('images/media'), $main_file);
        } else {
            $main_file = null;
        }
        $multi_image =
            [
                'reference_id' => $precautions->id,
                'reference_type' => 'holidays',
                'image' => $main_file,
            ];
        $multi = media::create($multi_image);
        return redirect()->route('precautions.show',$precautions->id)->with('success', 'Precautions Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Holidays  $holidays
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $precautions = Holidays::where('id', $id)->get()->first();
        $precautionsDetail = HolidayDetail::where('holiday_id', $id)->get()->first();
        $language = Language::where('id', $precautionsDetail->language_id)->get()->first();
        $media = media::where('reference_id', $id)->where('reference_type', 'holidays')->get()->first();
        return view('management/precautions/edit', compact('language','precautions','precautionsDetail','media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Holidays  $holidays
     * @return \Illuminate\Http\Response
     */
    public function edit(Holidays $holidays)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Holidays  $holidays
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $precautions = Holidays::where('id', $id)->get()->first();
        $precautionsDetail = HolidayDetail::where('holiday_id', $id)->get()->first();
        $multi = media::where('reference_id', $id)->where('reference_type', 'holidays')->get()->first();
        $precautions->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);
        $precautionsDetail->update([
            'holiday_id' => $id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        if ($request->file('image')) {
            $mainext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'precautions' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $request->image->move(public_path('images/media'), $main_file);
        } else {
            $main_file = $multi->image;
        }

        if ($multi != null) {
            $multi->update([
                'image' => $main_file,
            ]);
        } else {
            $multi_image =
                [
                    'reference_id' => $id,
                    'reference_type' => 'holidays',
                    'image' => $main_file,
                ];

            media::create($multi_image);

        }
        return redirect()->back()->with('success', 'Precautions Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Holidays  $holidays
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $precautions = Holidays::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Precautions deleted successfully');
    }
}
