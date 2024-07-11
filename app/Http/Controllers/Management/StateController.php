<?php

namespace App\Http\Controllers\Management;
use App\Http\Controllers\Controller;
use App\Helpers\DefaultLanguage;
use App\Models\State;
use App\Models\StatePivot;
use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $language = DefaultLanguage::SelectedLanguage();
        $state = State::leftJoin('countries', 'countries.id', '=', 'states.country_id')
            ->leftJoin('state_pivots', 'states.id', '=', 'state_pivots.state_id')
            ->where('state_pivots.language_id',$language->id)
            ->select('countries.title','states.id','states.status')
            ->groupBy('states.country_id')->orderBy('state_pivots.created_at', 'desc')->get();
        return view('management/states/index', compact('state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        $language = DefaultLanguage::SelectedLanguage();
        return view('management.states.create', compact('countries','language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'country_id' => $request->country_id,
            'status' => $request->status,
        ];
        $query = State::create($data);
        foreach ($request->title as $city) {
            StatePivot::create([
                'state_id' => $query->id,
                'title' => $city,
                'language_id' => $request->language_id,
            ]);
        }
        return redirect()->route('states.show', $query->id)->with('success','States Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['countries'] =Country::get();
        $data['language'] = DefaultLanguage::SelectedLanguage();
        $data['state'] = State::where('id', $id)->get()->first();
        $data['state_details'] = StatePivot::where('state_id',$id)->where('language_id',$data['language']->id)->get();
        return view('management.states.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $state = State::where('id', $id)->get()->first();
        $state_details = StatePivot::where('state_id', $id)->delete();
        $state->update([
            'country_id' => $request->country_id,
            'status' => $request->status,
        ]);
        foreach ($request->title as $states) {
            CityDetail::create([
                'state_id' => $id,
                'title' => $states,
                'language_id' => $request->language_id,
            ]);
        }
        return redirect()->back()->with('success', "State Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::where('id', $id)->delete();
        return redirect()->back()->with('success', "State Deleted Successfully");
    }
}
