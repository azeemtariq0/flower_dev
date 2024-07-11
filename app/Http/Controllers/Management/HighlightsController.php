<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Highlights;
use App\Models\Language;
use App\Models\HighlightsDetail;
use App\Helpers\DefaultLanguage;
use Illuminate\Http\Request;

class HighlightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['higlights'] = Highlights::leftJoin('highlights_details', 'highlights_details.highlight_id', 'highlights.id')
            ->where('highlights_details.language_id', DefaultLanguage::SelectedLanguage()->id)
            ->select('highlights.id', 'highlights.status', 'highlights.title', 'highlights.status', 'highlights_details.language_id')
            ->groupBY('highlights.id')->orderBy('highlights.created_at', 'desc')->get();
        return view('management.highlights.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        return view('management.highlights.create', compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $query = Highlights::create([
            'title' => $request->title,
            'status' => $request->status
        ]);
        foreach ($request->highlights as $highlight) {
            HighlightsDetail::create([
                'highlight_id' => $query->id,
                'title' => $request->title,
                'highlights' => $highlight,
                'language_id' => $request->language_id,
            ]);
        }
        return redirect()->route('highlights.show', $query->id)->with('success', 'Highlights Added Successfully');
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
        $data['highlight'] = Highlights::where('id', $id)->get()->first();
        $data['highlight_details'] = HighlightsDetail::where('highlight_id', $id)->where('language_id', $data['language']->id)->get();
        return view('management.highlights.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Highlights $activities
     * @return \Illuminate\Http\Response
     */
    public function edit(Highlights $activities)
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
        $highlights = Highlights::where('id', $id)->get()->first();
        $activity_pivot = HighlightsDetail::where('highlight_id',$id)->delete();
        $highlights->update([
            'title' => $request->title,
            'status' => $request->status
        ]);
        foreach ($request->highlights as $highlight) {
            HighlightsDetail::create([
                'highlight_id' => $id,
                'title' => $request->title,
                'highlights' => $highlight,
                'language_id' => $request->language_id,
            ]);
        }
        return redirect()->back()->with('success', "Highlights Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Highlights $highlights
     * @return \Illuminate\Http\Response
     */
    public function destroy(Highlights $highlights, $id)
    {
        $highlights = Highlights::where('id', $id)->delete();
        return redirect()->back()->with('success', "Highlights Deleted Successfully");
    }
}
