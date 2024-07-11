<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\BannerImage;
use App\Models\media;
use Illuminate\Http\Request;

class BannerImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(403, 'Unauthorized action.');
//        return view('management.banner_image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->file('honeymoon_image')) {
            $image = $request->file('honeymoon_image');
            $mainext = $image->getClientOriginalExtension();
            $main_file = 'honeymoon_image' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $image->move(public_path('/images/media'), $main_file);
            $multi_image =
                [
                    'reference_id' => 1,
                    'reference_type' => 'honeymoon_image',
                    'image' => $main_file,
                ];
            $multi = media::create($multi_image);
        }
        if ($request->file('holiday_image')) {
            $image = $request->file('holiday_image');
            $mainext = $image->getClientOriginalExtension();
            $main_file = 'holiday_image' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $image->move(public_path('/images/media'), $main_file);
            $multi_image =
                [
                    'reference_id' => 1,
                    'reference_type' => 'holiday_image',
                    'image' => $main_file,
                ];
            $multi = media::create($multi_image);
        }
        return redirect()->route('banner.show', 1)->with('success', 'Banner Image Added Successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BannerImage $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $honeymoon_image = media::where('reference_id', 1)->where('reference_type', 'honeymoon_image')->get()->first();
        $holiday_image = media::where('reference_id', 1)->where('reference_type', 'holiday_image')->get()->first();
        return view('management.banner_image.show', compact('honeymoon_image', 'holiday_image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BannerImage $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerImage $bannerImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BannerImage $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $honeymoon_image = media::where('reference_id', $id)->where('reference_type', 'honeymoon_image')->get()->first();
        $holiday_image = media::where('reference_id', $id)->where('reference_type', 'holiday_image')->get()->first();
        if ($request->file('honeymoon_image')) {

            $image = $request->file('honeymoon_image');
            $mainext = $image->getClientOriginalExtension();
            $main_file = 'honeymoon_image' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $image->move(public_path('/images/media'), $main_file);
        } else {
            $main_file = $honeymoon_image->image;
        }
        if ($honeymoon_image != null) {
            $honeymoon_image->update([
                'image' => $main_file,
            ]);
        }
        if ($request->file('holiday_image')) {
            $image = $request->file('holiday_image');
            $mainext = $image->getClientOriginalExtension();
            $main_file = 'holiday_image' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $image->move(public_path('/images/media'), $main_file);
        } else {
            $main_file = $holiday_image->image;
        }
        if ($holiday_image != null) {
            $holiday_image->update([
                'image' => $main_file,
            ]);
        }
        return redirect()->back()->with('success', 'Banner Image Updated Successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BannerImage $bannerImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerImage $bannerImage)
    {
        //
    }
}
