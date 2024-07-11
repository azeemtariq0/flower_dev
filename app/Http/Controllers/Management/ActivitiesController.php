<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Language;
use App\Models\faqs;
use App\Models\ActivitiesPivot;
use App\Helpers\DefaultLanguage;
use App\Models\media;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['activity'] = Activities::leftJoin('activities_pivot', 'activities_pivot.activity_id', 'activities.id')
            ->leftJoin('media', 'activities.id', '=', 'media.reference_id')
            ->where('media.reference_type', '=', 'activity')
            ->where('activities_pivot.language_id', DefaultLanguage::SelectedLanguage()->id)
            ->select('activities.id', 'activities.status', 'activities_pivot.title', 'activities_pivot.language_id', 'media.image')
            ->orderBy('activities_pivot.created_at', 'desc')->get();
        return view('management.activities.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        $faqs = faqs::leftJoin('faqs_details', 'faqs_details.faqs_id', 'faqs.id')
            ->where('faqs.faqs_reference', 2)
            ->where('faqs_details.language_id', $language->id)
            ->select('faqs.title', 'faqs.id')->groupBy('faqs.id')->get();
        return view('management.activities.create', compact('language', 'faqs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $query = Activities::create([
            'title' => $request->title,
            'status' => $request->status,
            'faqs' => json_encode($request->faqs),
        ]);
        ActivitiesPivot::create([
            'activity_id' => $query->id,
            'title' => $request->title,
            'language_id' => $request->language_id,
        ]);
        if ($request->file('image')) {

            $image = $request->file('image');
            $mainext = $image->getClientOriginalExtension();
            $main_file = 'activity' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $image->move(public_path('/images/media'), $main_file);
            $multi_image =
                [
                    'reference_id' => $query->id,
                    'reference_type' => 'activity',
                    'image' => $main_file,
                ];
            $multi = media::create($multi_image);
        } else {
            $multi = null;
        }
        return redirect()->route('activities.show', $query->id)->with('success', 'Activities Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Activities $activities
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data['language'] = DefaultLanguage::SelectedLanguage();
        $data['activity'] = Activities::where('id', $id)->get()->first();
        $data['activity_details'] = ActivitiesPivot::where('activity_id', $id)->get()->first();
        $data['media'] = media::where('reference_id', $id)->where('reference_type', 'activity')->get()->first();
        $data['faqs'] = faqs::leftJoin('faqs_details', 'faqs_details.faqs_id', 'faqs.id')
            ->where('faqs.faqs_reference', 2)
            ->where('faqs_details.language_id', $data['language']->id)
            ->select('faqs.title', 'faqs.id')->groupBy('faqs.id')->get();
        return view('management.activities.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Activities $activities
     * @return \Illuminate\Http\Response
     */
    public function edit(Activities $activities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activities $activities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $activity = Activities::where('id', $id)->get()->first();
        $activity_pivot = ActivitiesPivot::where('activity_id', $id);
        $multi = media::where('reference_id', $id)->where('reference_type', 'activity')->get()->first();
        if ($request->file('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'activity' . time() . rand(1000, 14000000000) . '.' . $ext;
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
                    'reference_type' => 'activity',
                    'image' => $main_file,
                ];
            media::create($multi_image);
        }
        if ($request->title != null) {
            $activity->update([
                'title' => $request->title,
                'status' => $request->status,
                'faqs' => json_encode($request->faqs),
            ]);
            $query = $activity_pivot->update([
                'title' => $request->title,
            ]);
        }
        return redirect()->back()->with('success', "Activity Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Activities $activities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Activities::where('id', $id)->delete();
        return redirect()->back()->with('success', "Activity Deleted Successfully");
    }
}
