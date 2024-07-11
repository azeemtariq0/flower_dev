<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\inclusion;
use App\Models\inclusionPivot;
use App\Models\Language;
use App\Helpers\DefaultLanguage;
use Illuminate\Http\Request;

class InclusionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = inclusion::leftJoin('inclusion_pivot', 'inclusion_pivot.inc_exc_id', 'inclusions.id')
            ->select('inclusions.id', 'inclusion_pivot.title', 'inclusion_pivot.language_id', 'inclusions.type')
            ->where('inclusion_pivot.language_id', DefaultLanguage::SelectedLanguage()->id)
            ->orderBy('inclusion_pivot.created_at', 'desc')->get();
        return view('management.inclusion.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        return view('management.inclusion.create', compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = inclusion::create([
            'type' => $request->type,
            'status' => $request->status
        ]);
        inclusionPivot::create([
            'inc_exc_id' => $query->id,
            'language_id' => $request->language_id,
            'title' => $request->title,
        ]);
        return redirect()->route('inclusion.show', $query->id)->with('success', 'Inclusion Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\inclusion $inclusion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data['inclusion'] = inclusion::where('id', $id)->get()->first();
        $data['inclusion_details'] = inclusionPivot::where('inc_exc_id', $id)->get()->first();
        $data['language'] = DefaultLanguage::SelectedLanguage();
        return view('management.inclusion.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\inclusion $inclusion
     * @return \Illuminate\Http\Response
     */
    public function edit(inclusion $inclusion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\inclusion $inclusion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inclusion = inclusion::where('id', $id)->get()->first();
        $inclusion_pivot = inclusionPivot::where('inc_exc_id', $id)->get()->first();
        $inclusion->update([
            'type' => $request->type,
            'status' => $request->status
        ]);
        $inclusion_pivot->update([
            'inc_exc_id' => $id,
            'language_id' => $request->language_id,
            'title' => $request->title,
        ]);
        return redirect()->back()->with('success', "inclusion Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\inclusion $inclusion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $inclusion = inclusion::where('id', $id)->delete();
        return redirect()->back()->with('success', "inclusion Deleted Successfully");
    }
}
