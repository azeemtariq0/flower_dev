<?php

namespace App\Http\Controllers\Management;

use App\Helpers\DefaultLanguage;
use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\HotelDetail;
use App\Models\HotelPackage;
use App\Models\Language;
use App\Models\media;
use App\Models\city;
use App\Models\cityPivot;
use App\Models\country;
use Illuminate\Http\Request;

class HotelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['hotelPackage'] = HotelPackage::leftJoin('media', function ($join) {
            $join->on('hotel_packages.id', '=', 'media.reference_id');
        })
            ->leftJoin('hotel_details', function ($join) {
                $join->on('hotel_packages.id', '=', 'hotel_details.hotel_id');
            })
            ->where('hotel_details.language_id', DefaultLanguage::SelectedLanguage()->id)
            ->where('reference_type', 'hotel')
            ->select('hotel_packages.id', 'hotel_packages.title', 'hotel_packages.status', 'media.image')
            ->orderBy('hotel_packages.created_at', 'desc')->get();
        return view('management.hotel.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        return view('management.hotel.create', compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotelPackage = [
            'user_id' => Auth()->user()->id,
            'title' => $request->title,
            'hotel_type' => $request->hotel_type,
            'status' => $request->status,
        ];
        $hotel = HotelPackage::create($hotelPackage);
        $dataa = [
            'hotel_id' => $hotel->id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'tags' => $request->hotel_tags,
        ];
        $sliders = HotelDetail::create($dataa);

        if ($request->file('image')) {
            $mainext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'hotel' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $request->file('image')->move(public_path('/images/media'), $main_file);
            $multi_image =
                [
                    'reference_id' => $hotel->id,
                    'reference_type' => 'hotel',
                    'image' => $main_file,
                ];
            $multi = media::create($multi_image);
        } else {
            $multi = null;
        }
        return redirect()->route('hotel.show', $hotel->id)->with('success', 'HotelPackage Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\HotelPackage $hotelPackage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotelPackage = HotelPackage::where('id', $id)->get()->first();
        $hotelDetail = HotelDetail::where('hotel_id', $id)->get()->first();
        $language = Language::where('id', $hotelDetail->language_id)->get()->first();
        $media = media::where('reference_id', $id)->where('reference_type', 'hotel')->get()->first();
        return view('management/hotel/edit', compact('language', 'hotelPackage', 'media', 'hotelDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\HotelPackage $hotelPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(HotelPackage $hotelPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HotelPackage $hotelPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $media = media::where('reference_id', $id)->where('reference_type', 'hotel')->get()->first();
        $hotelPackage = HotelPackage::where('id', $id)->get()->first();
        $hotelDetail = HotelDetail::where('hotel_id', $id)->get()->first();
        $hotelPackage->update([
            'user_id' => Auth()->user()->id,
            'title' => $request->title,
            'hotel_type' => $request->hotel_type,
            'status' => $request->status,
        ]);
        $hotelDetail->update([
            'hotel_id' => $hotelPackage->id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'tags' => $request->tags,
        ]);
        if ($request->file('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'hotel' . time() . rand(1000, 14000000000) . '.' . $ext;
            $request->image->move(public_path('images/media'), $main_file);
        } else {
            $main_file = $media->image;
        }

        if ($media != null) {
            $media->update([
                'image' => $main_file,
            ]);
        } else {
            $multi_image =
                [
                    'reference_id' => $id,
                    'reference_type' => 'hotel',
                    'image' => $main_file,
                ];

            media::create($multi_image);

        }
        return redirect()->back()->with('success', 'HotelPackage Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\HotelPackage $hotelPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seos = HotelPackage::where('id', $id)->delete();
        return redirect()->back()->with('success', 'HotelPackage Deleted Successfully');
    }
}
