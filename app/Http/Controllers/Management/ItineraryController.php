<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Helpers\DefaultLanguage;
use App\Models\Language;
use App\Models\Itinerary;
use App\Models\ItineraryDetail;
use App\Models\media;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function index()
    {
        $data['itinerary'] = Itinerary::latest()->get();
        $data['media'] = media::where('reference_type', 'itinerary')->get()->groupBy('reference_id');
        return view('management/itinerary/index', $data);
    }

    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        return view('management/itinerary/create', compact('language'));
    }

    public function store(Request $request)
    {
        $itinerary = [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'status' => $request->status,
        ];
        $itineraries = Itinerary::create($itinerary);
        $dataa = [
            'itinerary_id' => $itineraries->id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->itinary_tags
        ];
        $sliders = ItineraryDetail::create($dataa);

        if ($request->file('image')) {
            foreach ($request->file('image') as $image) {
                $mainext = $image->getClientOriginalExtension();
                $main_file = 'itinerary' . time() . rand(1000, 14000000000) . '.' . $mainext;
                $image->move(public_path('/images/media'), $main_file);
                $multi_image =
                    [
                        'reference_id' => $itineraries->id,
                        'reference_type' => 'itinerary',
                        'image' => $main_file,
                    ];
                $multi = media::create($multi_image);
            }
        } else {
            $multi = null;
        }
        return redirect()->route('itinerary.show', $itineraries->id)->with('success', 'Itinerary Created successfully');
    }

    public function show($id)
    {
        $itinerary = Itinerary::where('id', $id)->get()->first();
        $itineraries = ItineraryDetail::where('itinerary_id', $id)->get()->first();
        $language = Language::where('id', $itineraries->language_id)->get()->first();
        $media = media::where('reference_id', $id)->where('reference_type', 'itinerary')->get();
        return view('management/itinerary/edit', compact('language', 'itinerary', 'media', 'itineraries'));
    }

    public function update(Request $request, $id)
    {
        $media = media::where('reference_id', $id)->where('reference_type', 'itinerary')->delete();
        $itinerary = Itinerary::where('id', $id)->get()->first();
        $itineraries = ItineraryDetail::where('itinerary_id', $id)->get()->first();
        $itinerary->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'status' => $request->status,
        ]);
        $itineraries->update([
            'itinerary_id' => $itinerary->id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->itinary_tags,
        ]);

        if ($request->file('image')) {
            foreach ($request->file('image') as $image) {
                $mainext = $image->getClientOriginalExtension();
                $main_file = 'itinerary' . time() . rand(1000, 14000000000) . '.' . $mainext;
                $image->move(public_path('/images/media'), $main_file);
                $multi_image =
                    [
                        'reference_id' => $itinerary->id,
                        'reference_type' => 'itinerary',
                        'image' => $main_file,
                    ];
                $multi = media::create($multi_image);
            }
            if ($request->image_update != null) {
                foreach ($request->image_update as $image) {
                    $multi_image =
                        [
                            'reference_id' => $itinerary->id,
                            'reference_type' => 'itinerary',
                            'image' => $image,
                        ];
                    $multi = media::create($multi_image);
                }
            }
        } else {
            if ($request->image_update != null) {
                foreach ($request->image_update as $image) {
                    $multi_image =
                        [
                            'reference_id' => $itinerary->id,
                            'reference_type' => 'itinerary',
                            'image' => $image,
                        ];
                    $multi = media::create($multi_image);
                }
            }
        }
        return redirect()->back()->with('success', 'Itinerary Updated Successfully');
    }

    public function destroy($id)
    {
        $seos = Itinerary::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Itinerary Deleted Successfully');
    }
}
