<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
// use App\Models\City;
// use App\Helpers\DefaultLanguage;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use DB;
use DataTables, Form;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
         if ($request->ajax()) {
            $data = Product::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
              ->editColumn('created_at', function($model){
            $formatDate = date('d-m-Y H:i:s',strtotime($model->created_at));
            return $formatDate;
        })
            ->addColumn('action', function($row){
                 $btn="";
                // if (auth()->user()->haspermissionTo('product-view') )
                //     $btn .= htmlBtn('products.show',$row->id,'warning','eye');
                 if (auth()->user()->haspermissionTo('product-edit') )
                    $btn .=htmlBtn('products.edit',$row->id);
                 if (auth()->user()->haspermissionTo('product-delete') )
                     $btn .= htmDeleteBtn('products.destroy',$row->id);

               return $btn;
           })
            ->rawColumns(['action'])
            ->make(true);
        }

           $data['page_management'] = array(
            'page_title' => 'Product',
            'slug' => 'General Setup',
            'title' => 'Manage Products',
            'add' => 'Add Product',
        );

        return view('management/products/index', compact('data'));
    }

     public function getSubCategory(Request $request)
    {
        $post = $request->all();
        $category = ProductSubCategory::where('category_id',$post['product_category_id'])->orderBy('name')->get();
        return response()->json($category);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $language = DefaultLanguage::SelectedLanguage();
         $categories  = ProductCategory::all();
         $data['page_management'] = array(
            'page_title' => 'Product',
            'slug' => 'General Setup',
            'title' => 'Manage Products',
            'add' => 'Add Product',
            'url' => 'Add Product',
        );

        return view('management/products/create', compact('categories','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $documentno = Product::count();
            $documentno=str_pad($documentno + 1, 5, 0, STR_PAD_LEFT);
           
            $productId = Product::insertGetId([
                'product_code' => $documentno,
                'product_name' => $request->product_name,
                'sell_price' => $request->sell_price,
                'product_category_id' => $request->product_category_id,
                'product_sub_category_id' => $request->product_sub_category_id,
                'description' => $request->description,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => auth()->user()->id,
            ]);

            if($request->hasFile('product_image'))
            {
                foreach($request->file('product_image')['name'] as $image)
                {
                    $destinationPath = 'products/';
                    $filename = $image->getClientOriginalName();
                    $image->move($destinationPath, $filename);
                    ProductDetail::create([
                        'image' =>  $filename,
                        'url' => $destinationPath,
                        'product_id' => $productId
                    ]);     

                }
            }

        
         return redirect()->route('products.index')
        ->with('success','Product created successfully');
       
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
            'page_title' => 'Product',
            'slug' => 'General Setup',
            'title' => 'Add Product',
            'add' => 'Add Product',
        );

        return view('management/products/create', compact('data'));
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
         $product  = Product::where('id',$id)->with('product_detail')->first();

         

         $data['page_management'] = array(
            'page_title' => 'Product',
            'slug' => 'General Setup',
            'title' => 'Edit Product',
            'add' => 'Edit Product',
        );

        return view('management/products/create', compact('product','categories','data'));
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
        $product = Product::where('id',$id)->first();
         $product->product_category_id = $request->product_category_id;
         $product->product_sub_category_id = $request->product_sub_category_id;
         $product->product_code = $request->product_code;
         $product->product_name = $request->product_name;
         $product->sell_price = $request->sell_price;
         $product->description = $request->description;
         $product->updated_at =  date('Y-m-d H:i:s');
         $product->updated_by = auth()->user()->id;
         $product->update();

        $i = 0;
        ProductDetail::where('product_id',$id)->delete();
        if(isset($_FILES['product_image'])){
        foreach($_FILES['product_image']['name'] as $index => $image){
                $image = $request->file('product_image');
                $destinationPath = 'products/';



                if(isset($image[$i])){
                        $filename = $image[$i]->getClientOriginalName();
                        $image[$i]->move($destinationPath, $filename);
                }else{
                    $filename= $request['old_product_image'][$index]??"";
                } 

                ProductDetail::create([
                                        'image' =>  $filename,
                                        'url' => $destinationPath,
                                        'product_id' =>  $id
                                    ]);   

            $i++; 
        }
    }



         // $product = ProductDetail::where('product_id',$id)->delete();
         // if($request->hasFile('product_image'))
         //    {
                  
         //        foreach($request->file('product_image') as $id => $image)
         //        {

         //            $destinationPath = 'products/';
         //            $filename = $image->getClientOriginalName();
         //            $image->move($destinationPath, $filename);
         //            ProductDetail::create([
         //                'image' =>  $filename,
         //                'url' => $destinationPath,
         //                'product_id' =>  $id
         //            ]);     

         //        }
         //    }
    
        return redirect()->route('products.index')
        ->with('success','Product updated successfully');
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
        $city = Product::where('id', $id)->delete();
        return redirect()->back()->with('success', "Product Deleted Successfully");
    }
}
