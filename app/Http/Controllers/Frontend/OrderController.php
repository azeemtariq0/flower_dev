<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\LafastaAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
    API DATA
    SINGLE ORDER
    $singleresponse = Http::get('https://c7b12ce95b28d22f1f2e65725769f406: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@truffleers.myshopify.com/admin/api/2022-10/orders/5071859581089.json');
    $singleOrder = json_decode($singleresponse);
    MULTIPLE ORDER
    $response = Http::get('https://c7b12ce95b28d22f1f2e65725769f406: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@truffleers.myshopify.com/admin/api/2022-10/orders.json');
    $orders = json_decode($response);
    $orders = $orders->orders;
     */

    static function FetchAndSaveData()
    {
        $order = Http::get('https://pmediaweb.com/dev/dopaminetravel_wp/wp-json/my-api/v1/posts');
//        $order = Http::get('https://pmediaweb.com/dev/dopaminetravel_wp/wp-json/wp/v2/posts?per_page=6');
//      dd(json_decode($order));
        $orders = json_decode($order);
        return $orders;
    }


    public function index()
    {
        $data['DataCollection'] = [];
        $data['order'] = Order::orderBy('id', 'DESC')->paginate(10);
        foreach ($data['order'] as $orders) {
            $order = Http::get('https://c7b12ce95b28d22f1f2e65725769f406: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@truffleers.myshopify.com/admin/api/2022-10/orders/' . $orders->order_id . '.json');
            if ($order->status() == 200) {
                $order = json_decode($order);

                $orderapi = $order->order;

                $data['DataCollection'][] = [
                    'order_number' => $orderapi->order_number,
                    'order_id' => $orderapi->id,
                    'shipment_id' => $orders->shipment_id,
                    'total_price' => $orderapi->total_price,
                    'currency' => $orderapi->currency,
                    'financial_status' => $orderapi->financial_status,
                    'total_item' => count($orderapi->line_items),
                    'delivery' => $orderapi->shipping_lines[0] ? $orderapi->shipping_lines[0]->code : '',
                    'order_date' => $orderapi->created_at,
                    'customer' => $orderapi->customer->first_name . ' ' . $orderapi->customer->last_name,
                ];
            }
        }
        return view('management.order.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['BaseOrder'] = Order::where('order_id',$id)->get()->first();

        $order = Http::get('https://c7b12ce95b28d22f1f2e65725769f406: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@truffleers.myshopify.com/admin/api/2022-10/orders/'.$id.'.json');

        $order = json_decode($order);
//        dd($order);
//        dd($order);
        $data['order'] = $order->order;
//        dd($data['order']);
        return view('management.order.show',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }


//    public function ShipmentSent(Request $request)
//    {
//        $id = $request->order_id;
//
//
//        //****** Lafasta Access Token*******
//        $apiURL = 'https://c.lafasta.sa.com/API/Login/GetAccessToken';
//        $postInput = [
//            'UserName' => 'test_account_9',
//            'Password' => '123456789#',
//        ];
//        $headers = [
//            'X-header' => 'value'
//        ];
//        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
//        $statusCode = $response->status();
//        if($statusCode != 200){
//            return back()->with('error','Something went wrong try again in while');
//        }
//        $responseBody = json_decode($response->getBody(), true);
//
//        LafastaAccess::create($responseBody['resultData']);
//        // ******-Lafasta Access Token-*******
//
//
//
//        $order = Http::get('https://c7b12ce95b28d22f1f2e65725769f406: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@truffleers.myshopify.com/admin/api/2022-10/orders/'.$id.'.json');
//        $order = json_decode($order);
//        $order =$order->order;
//
//
//
//        $apiURLForShip = 'https://c.lafasta.sa.com/API/V3/Store/Shipment';
//        $postInputForShip = [
//            'SandboxMode' => true,
//            'CustomerName' => $order->shipping_address->first_name.' '.$order->shipping_address->last_name,
//            'CustomerPhoneNumber' => str_replace(' ', '', $order->shipping_address->phone),
////            'PreferredReceiptTime' => '2018/10/24 18:00',
////            'PreferredDeliveryTime' => '2018/10/24 23:00',
//            'NotesFromStore' => '"Please give the buyer a call before delivery',
////            'CustomerName' => 1,
//            'PaymentMethodId'=> 1,
//            'ShipmentContentValueSAR' => $order->total_price,
//            'ShipmentContentTypeId' => 1,
////            'AddedServicesIds' => [13],
//            'CustomerLocation' => [
//                'Desciption'=>
//                    $order->shipping_address->address1
//                    .' ,'.
//                    $order->shipping_address->address2
//                    .' ,'.
//                    $order->shipping_address->province
//                    .' ,'.
//                    $order->shipping_address->zip
//                    .' ,'.
//                    $order->shipping_address->city
//                    .' ,'.
//                    $order->shipping_address->country,
//                'Longitude'=> $order->shipping_address->longitude,
//                'Latitude'=> $order->shipping_address->latitude,
//                'GoogleMapsFullLink'=> "https://www.google.com/maps/place/",
//                'CountryId'=>  1,
////                'CityAsString'=> "مكه ",
//            ],
//            'ExternalStoreShipmentIdRef'=>'OrderIdTesting'.$order->order_number,
//            'API_Call_Source'=>'Laravel',
//            'Currency'=>'SAR'
//        ];
//        $headersForShip = [
//            'Authorization' =>'Bearer '. $responseBody['resultData']['access_token'],
//            'Content-Type'=>'application/json'
//        ];
//        $response = Http::withHeaders($headersForShip)->post($apiURLForShip, $postInputForShip);
//        $statusCode = $response->status();
//        $response = json_decode($response);
//        if($response->isSuccess == true){
//            Order::where('order_id',$id)->get()->first()->update(
//            [
//                'shipment_id'=>$response->resultData->id,
//            ]
//        );
//            return redirect()->back()->with('success',$response->messageEn);
//        }else{
//            return redirect()->back()->with('wrong',$response->messageEn);
//        }
////        dd($response->resultData->id);
//
//
//    }





    public function ShipmentSent(Request $request)
    {
        $id = $request->order_id;


        //****** Lafasta Access Token*******
        $apiURL = 'https://c.lafasta.sa.com/API/Login/GetAccessToken';
        $postInput = [
            'UserName' => 'test_account_9',
            'Password' => '123456789#',
        ];
        $headers = [
            'X-header' => 'value'
        ];
        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
        $statusCode = $response->status();
        if($statusCode != 200){
            return back()->with('error','Something went wrong try again in while');
        }
        $responseBody = json_decode($response->getBody(), true);

        LafastaAccess::create($responseBody['resultData']);
        // ******-Lafasta Access Token-*******



        $order = Http::get('https://c7b12ce95b28d22f1f2e65725769f406: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@truffleers.myshopify.com/admin/api/2022-10/orders/'.$id.'.json');
        $order = json_decode($order);
        $order =$order->order;
//dd($responseBody['resultData']['access_token']);
//dd($responseBody['resultData']);



//        $apiURLForShip = 'https://c.lafasta.sa.com/API/V3/Store/Shipment';
        $apiURLForShip = 'https://c.lafasta.sa.com/API/V4/Shipment';
        $postInputForShip = [


            "Shipper"=>[
                "Address"=>[
                    "Line1"=> $order->shipping_address->address1,
                    "Line2"=>  $order->shipping_address->address2,
                    "Line3"=> "Ashuhada District, Gurnada, 13241",
//                    "City"=> "1",
                    "Country"=> "SA",
                    "Longitude"=> $order->shipping_address->longitude,
                    "Latitude"=> $order->shipping_address->latitude,
                ],
                "Contact"=>[
                    "Name"=> $order->shipping_address->first_name.' '.$order->shipping_address->last_name,
                    "NationalId"=> "1234567899",
                    "PhoneNumber"=>"0546281000",
                    "CompanyName"=> "ْX Trades",
                    "CompanyPhoneNumber"=> str_replace(' ', '', $order->shipping_address->phone),
                ],
            ],


            'SandboxMode' => true,
            'CustomerName' => $order->shipping_address->first_name.' '.$order->shipping_address->last_name,
            'CustomerPhoneNumber' => str_replace(' ', '', $order->shipping_address->phone),
//            'PreferredReceiptTime' => '2018/10/24 18:00',
//            'PreferredDeliveryTime' => '2018/10/24 23:00',
            'NotesFromStore' => '"Please give the buyer a call before delivery',
//            'CustomerName' => 1,
            'PaymentMethodId'=> 1,
            'ShipmentContentValueSAR' => $order->total_price,
            'ShipmentContentTypeId' => 1,
//            'AddedServicesIds' => [13],
            'CustomerLocation' => [
                'Desciption'=>
                    $order->shipping_address->address1
                    .' ,'.
                    $order->shipping_address->address2
                    .' ,'.
                    $order->shipping_address->province
                    .' ,'.
                    $order->shipping_address->zip
                    .' ,'.
                    $order->shipping_address->city
                    .' ,'.
                    $order->shipping_address->country,
                'Longitude'=> $order->shipping_address->longitude,
                'Latitude'=> $order->shipping_address->latitude,
                'GoogleMapsFullLink'=> "https://www.google.com/maps/place/",
                'CountryId'=>  1,
//                'CityAsString'=> "مكه ",
            ],
            'ExternalStoreShipmentIdRef'=>'OrderIdTesting'.$order->order_number,
            'API_Call_Source'=>'Laravel',
            'Currency'=>'SAR'
        ];
        $headersForShip = [
            'Authorization' =>'Bearer '. $responseBody['resultData']['access_token'],
            'Content-Type'=>'application/json'
        ];
        $response = Http::withHeaders($headersForShip)->post($apiURLForShip, $postInputForShip);
        $statusCode = $response->status();
        $response = json_decode($response);
        if($response->isSuccess == true){
            Order::where('order_id',$id)->get()->first()->update(
                [
                    'shipment_id'=>$response->resultData->id,
                ]
            );
            return redirect()->back()->with('success',$response->messageEn);
        }else{
            return redirect()->back()->with('wrong',$response->messageEn);
        }
//        dd($response->resultData->id);


    }

}
