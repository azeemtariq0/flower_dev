<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\faqs;
use App\Helpers\DefaultLanguage;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\media;
use Illuminate\Http\Request;
use DB;
use DataTables, Form;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $arrlist=['orders'=>'Received Order','order-confirm'=>'Confirm Orders','order-dispatch'=>'Dispatch Order','order-delivered'=>'Delivered Order'];
        $route = \Request::segment(2);

        if ($request->ajax()) {
            $data = Order::where('status',$request->status)->get();
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                 $btn="";

                 if (auth()->user()->haspermissionTo('order-view') ){
                    $btn.="<button class='btn btn-warning btn-xs' type='button' onclick='orderDetail(".$row->id.")'><i class='fa fa-eye'></i></button>";
                 }
                  
                 $btn.="<a target='_blank' href='".url('admin/print-view/'.$row->id)."'><button class='btn btn-success btn-xs' type='button'><i class='fa fa-print'></i></button></a>";

                 // if (auth()->user()->haspermissionTo('order-edit') )
                 //    $btn .=htmlBtn('order.edit',$row->id);
                 // if (auth()->user()->haspermissionTo('order-delete') )
                 //     $btn .= htmDeleteBtn('order.destroy',$row->id);

               return $btn;
           })
            ->rawColumns(['action'])
            ->make(true);
        }

        

           $data['page_management'] = array(
            'page_title' => $arrlist[$route],
            'slug' => 'General Setup',
            'title' => 'Receive Orders',
            'add' => 'Add Product Category',
        );
        $status=['orders'=>1,'order-confirm'=>2,'order-dispatch'=>3,'order-delivered'=>4];

        return view('management/orders/index', compact('data','status'));
    }


    public function getOrderDetail(Request $request){

       $data  = OrderDetail::with('product')->where('orderId', $request->id)->get()->toArray();
       echo json_encode(['success'=>true,'data'=>$data]);

    }



    public function printView(Request $request,$id){
       $data  = Order::with('order_detail','order_detail.product')->where('id', $request->id)->first();
       return view('management.orders.print', compact('data'));
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
            ->where('faqs.faqs_reference', 0)
            ->where('faqs_details.language_id', $language->id)
            ->select('faqs.title', 'faqs.id')->groupBy('faqs.id')->get();
        return view('management.theme.create', compact('language', 'faqs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $theme = DestinationTheme::create([
            'title' => $request->title,
            'status' => $request->status,
            'faqs' => $request->faqs != null ? json_encode($request->faqs) : null,

        ]);
        ThemeDetail::create([
            'themes_id' => $theme->id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        if ($request->file('image')) {

            $image = $request->file('image');
            $mainext = $image->getClientOriginalExtension();
            $main_file = 'theme' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $image->move(public_path('/images/media'), $main_file);
            $multi_image =
                [
                    'reference_id' => $theme->id,
                    'reference_type' => 'theme',
                    'image' => $main_file,
                ];
            $multi = media::create($multi_image);
        } else {
            $multi = null;
        }
        return redirect()->route('theme.show', $theme->id)->with('success', 'Destination Theme Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\DestinationTheme $destinationTheme
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['language'] = DefaultLanguage::SelectedLanguage();
        $data['theme'] = DestinationTheme::where('id', $id)->get()->first();
        $data['theme_details'] = ThemeDetail::where('themes_id', $id)->get()->first();
        $data['faqs'] = faqs::leftJoin('faqs_details', 'faqs_details.faqs_id', 'faqs.id')
            ->where('faqs.faqs_reference', 0)
            ->where('faqs_details.language_id', $data['language']->id)
            ->select('faqs.title', 'faqs.id')->groupBy('faqs.id')->get();
        $data['media'] = media::where('reference_id', $id)->where('reference_type', 'theme')->get()->first();
        return view('management.theme.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\DestinationTheme $destinationTheme
     * @return \Illuminate\Http\Response
     */
    public function edit(DestinationTheme $destinationTheme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DestinationTheme $destinationTheme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $theme = DestinationTheme::where('id', $id)->get()->first();
        $theme_detail = ThemeDetail::where('themes_id', $id)->get()->first();
        $multi = media::where('reference_id', $id)->where('reference_type', 'theme')->get()->first();
        if ($request->file('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'theme' . time() . rand(1000, 14000000000) . '.' . $ext;
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
                    'reference_type' => 'theme',
                    'image' => $main_file,
                ];
            media::create($multi_image);
        }
        if ($request->title != null) {
            $theme->update([
                'title' => $request->title,
                'status' => $request->status,
                'faqs' => $request->faqs != null ? json_encode($request->faqs) : null,
            ]);
            $theme_detail->update([
                'themes_id' => $theme->id,
                'language_id' => $request->language_id,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }
        return redirect()->back()->with('success', "Destination Theme Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\DestinationTheme $destinationTheme
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestinationTheme $destinationTheme, $id)
    {
        $theme = DestinationTheme::where('id', $id)->delete();
        return redirect()->back()->with('success', "Destination Theme Deleted Successfully");
    }
}
