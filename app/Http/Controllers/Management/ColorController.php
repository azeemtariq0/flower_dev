<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
// use App\Models\City;
// use App\Helpers\DefaultLanguage;
use App\Models\Color;
use Illuminate\Http\Request;
use DB;
use DataTables, Form;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $language = DefaultLanguage::SelectedLanguage();
        if ($request->ajax()) {
            $data = Color::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                 $btn="";
              
                 if (auth()->user()->haspermissionTo('color-edit') )
                    $btn .=htmlBtn('colors.edit',$row->id);
                 if (auth()->user()->haspermissionTo('color-delete') )
                     $btn .= htmDeleteBtn('colors.destroy',$row->id);

               return $btn;
           })
            ->rawColumns(['action'])
            ->make(true);
        }

           $data['page_management'] = array(
            'page_title' => 'Color',
            'slug' => 'General Setup',
            'title' => 'Manage Colors',
            'add' => 'Add Color',
        );

        return view('management/colors/index', compact('data'));
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $language = DefaultLanguage::SelectedLanguage();
        // $states = StatePivot::where('language_id', $language->id)->get();

        $data['page_management'] = array(
            'page_title' => 'Color',
            'slug' => 'General Setup',
            'title' => 'Add Color',
            'add' => 'Add Color',
        );

        return view('management/colors/create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            Color::create([
                'color_name' => $request->color_name,
                'color_code' => $request->color_code,
                'description' => $request->description,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => auth()->user()->id,
            ]);
        
         return redirect()->route('colors.index')
        ->with('success','Color created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        // $data['language'] = DefaultLanguage::SelectedLanguage();
        // $data['states'] = StatePivot::where('language_id', $data['language']->id)->get();
        // $data['city'] = City::where('states_id', $id)->groupBy('states_id')->get();
        // $data['city_details'] = CityDetail::where('states_id', $id)->where('language_id', $data['language']->id)->get();

        $data['page_management'] = array(
            'page_title' => 'Color',
            'slug' => 'General Setup',
            'title' => ' Add Color',
            'add' => 'Add Color',
        );

         return view('management/colors.create', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        $color = Color::find($id);
        $data['page_management'] = array(
            'page_title' => ' Color',
            'slug' => 'General Setup',
            'title' => 'Edit Color',
            'add' => 'Edit Color',
        );
        return view('management/colors.create',compact('color', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        $color = color::where('id',$id)->first();
         $color->color_name = $request->color_name;
         $color->color_code = $request->color_code;
         $color->description = $request->description;
         $color->updated_at =  date('Y-m-d H:i:s');
         $color->updated_by = auth()->user()->id;
         $color->update();
    
        return redirect()->route('colors.index')
        ->with('success','Color updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        Color::where('id', $id)->delete();
        return redirect()->back()->with('success', "Color Deleted Successfully");
    }
}
