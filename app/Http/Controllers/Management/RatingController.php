<?php

namespace App\Http\Controllers\Management;

use App\Models\HotelReviews;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $reviews = HotelReviews::leftjoin('packages', 'packages.id', '=', 'hotel_reviews.package_id')
            ->select('packages.title', 'hotel_reviews.*')
            ->orderBy('hotel_reviews.created_at', 'desc')->get();
        return view('management.reviews.index', compact('reviews'));
    }

    public function show($id)
    {
        $data = HotelReviews::leftjoin('packages', 'packages.id', '=', 'hotel_reviews.package_id')
            ->where('hotel_reviews.id', $id)
            ->select('packages.title', 'hotel_reviews.*')
            ->get()->first();
        return view('management/reviews/show', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $reviews = HotelReviews::where('id', $id)->get()->first();
        $reviews->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Approved Reviews successfully');
    }
}
