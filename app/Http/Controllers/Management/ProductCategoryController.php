<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
// use App\Models\City;
// use App\Helpers\DefaultLanguage;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use DB;
use DataTables, Form;

class ProductCategoryController extends Controller
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
            $data = ProductCategory::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                 $btn="";
              
                 if (auth()->user()->haspermissionTo('product-category-edit') )
                    $btn .=htmlBtn('product-categories.edit',$row->id);
                 if (auth()->user()->haspermissionTo('product-category-delete') )
                     $btn .= htmDeleteBtn('product-categories.destroy',$row->id);

               return $btn;
           })
            ->rawColumns(['action'])
            ->make(true);
        }

           $data['page_management'] = array(
            'page_title' => 'Product Category',
            'slug' => 'General Setup',
            'title' => 'Manage Product Categories',
            'add' => 'Add Product Category',
        );

        return view('management/product_categories/index', compact('data'));
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
            'page_title' => 'Product Category',
            'slug' => 'General Setup',
            'title' => 'Add Product Category',
            'add' => 'Add Product Category',
        );

        return view('management/product_categories/create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            ProductCategory::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        
         return redirect()->route('product-categories.index')
        ->with('success','Product Category created successfully');
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
            'page_title' => 'Product Category',
            'slug' => 'General Setup',
            'title' => ' Add Product Category',
            'add' => 'Add Product Category',
        );

         return view('management/product_categories/create', compact('data'));
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
        $product_category = ProductCategory::find($id);
        $data['page_management'] = array(
            'page_title' => ' Product Category',
            'slug' => 'General Setup',
            'title' => 'Edit Product Category',
            'add' => 'Edit Product Category',
        );
        return view('management/product_categories.create',compact('product_category', 'data'));
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
        $product_category = ProductCategory::where('id',$id)->first();
         $product_category->name = $request->name;
         $product_category->description = $request->description;
         $product_category->update();
    
        return redirect()->route('product-categories.index')
        ->with('success','Product Category updated successfully');
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
        ProductCategory::where('id', $id)->delete();
        return redirect()->back()->with('success', "Product Category Deleted Successfully");
    }
}
