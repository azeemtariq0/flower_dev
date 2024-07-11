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

class ProductSubCategoryController extends Controller
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
            $data = ProductSubCategory::with('product_category')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                 $btn="";
              
                 if (auth()->user()->haspermissionTo('product-sub-category-edit') )
                    $btn .=htmlBtn('product-sub-categories.edit',$row->id);
                 if (auth()->user()->haspermissionTo('product-sub-category-delete') )
                     $btn .= htmDeleteBtn('product-sub-categories.destroy',$row->id);

               return $btn;
           })
            ->rawColumns(['action'])
            ->make(true);
        }

           $data['page_management'] = array(
            'page_title' => 'Product Sub Category',
            'slug' => 'General Setup',
            'title' => 'Manage Product Sub Categories',
            'add' => 'Add Product Category',
        );

        return view('management/product_sub_categories/index', compact('data'));
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
         $categories  = ProductCategory::all();
        $data['page_management'] = array(
            'page_title' => 'Product Sub Category',
            'slug' => 'General Setup',
            'title' => 'Add Product Sub Category',
            'add' => 'Add Product Sub Category',
        );

        return view('management/product_sub_categories/create', compact('data','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            ProductSubCategory::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        
         return redirect()->route('product-sub-categories.index')
        ->with('success','Product Sub Category created successfully');
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
            'page_title' => 'Product Sub Category',
            'slug' => 'General Setup',
            'title' => ' Add Product Sub Category',
            'add' => 'Add Product Category',
        );

         return view('management/product_sub_categories/create', compact('data'));
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
        $categories  = ProductCategory::all();
        $product_sub_category = ProductSubCategory::find($id);
        $data['page_management'] = array(
            'page_title' => ' Product Sub Category',
            'slug' => 'General Setup',
            'title' => 'Edit Product Sub Category',
            'add' => 'Edit Product Sub Category',
        );
        return view('management/product_sub_categories.create',compact('categories','product_sub_category', 'data'));
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
        $sub_category = ProductSubCategory::where('id',$id)->first();
         $sub_category->category_id = $request->product_category_id;
         $sub_category->name = $request->name;
         $sub_category->description = $request->description;
         $sub_category->update();
    
        return redirect()->route('product-sub-categories.index')
        ->with('success','Product Sub Category updated successfully');
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
        ProductSubCategory::where('id', $id)->delete();
        return redirect()->back()->with('success', "Product Sub Category Deleted Successfully");
    }
}
