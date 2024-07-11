@extends('frontend.layouts.master')
@section('title')
    Order Detail - {{config('app.name')}}
@endsection
@section('content')
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #cd9cf2;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to top left, rgba(205, 156, 242, 1), rgba(246, 243, 255, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to top left, rgba(205, 156, 242, 1), rgba(246, 243, 255, 1))
        }
    </style>
    <div class="container-fluid md-shadow rounded-4">
        <div class="row">
            @include('frontend.dashboard.userSidebar')
                        <div class="col-lg-10 col-xl-9">
                            <div class="card" style="border-radius: 10px;">
                                <div class="card-header px-4 py-5">
                                    <h5 class="text-muted mb-0">Thanks for your Order, <span style="color: #f89321;">{{auth()->user()->name}}</span>!</h5>
                                </div>
                                <div class="card-body p-4">
                                    <?php
                                    $i=0;
                                    ?>
                                    @foreach($products as $row)
                                    <div class="card shadow-0 border mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                @if($row->image!= null)
                                                <div class="col-md-2">
                                                    <img src="{{asset('images/media'.'/'.$row->image)}}"
                                                         class="img-fluid" alt="Phone">
                                                </div>
                                                @else

                                                @endif
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0">{{$row->title}}</p>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">{{$row->currency_symbol}}{{$row->discounted_price}}</p>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">Capacity: 64GB</p>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">Qty: {{$quantity[$i]}}</p>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">{{$row->currency_symbol}}{{$row->discounted_price * $quantity[$i]}}</p>
                                                </div>
                                            </div>
                                            <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-md-2">
                                                    <p class="text-muted mb-0 small">Track Order</p>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="progress" style="height: 6px; border-radius: 16px;">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: 65%; border-radius: 16px; background-color: #f89321;" aria-valuenow="65"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex justify-content-around mb-1">
                                                        <p class="text-muted mt-1 mb-0 small ms-xl-5">Out for delivary</p>
                                                        <p class="text-muted mt-1 mb-0 small ms-xl-5">Delivered</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                    ?>
                                    @endforeach
                                    <div class="d-flex justify-content-between pt-2">
                                        <p class="fw-bold mb-0">Order Details</p>
                                        <p class="text-muted mb-0"><span class="fw-bold me-4">Pre Total</span>{{$order->currency_symbol}} {{$order->pre_total}}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="text-muted mb-0">Invoice Date : {{$order->created_at->format('Y-m-d')}}</p>
                                        <p class="text-muted mb-0"><span class="fw-bold me-4">Shippin Charges</span>{{$order->currency_symbol}} {{$order->shipment_charges}}</p>
                                    </div>

                                    <div class="d-flex justify-content-between mb-5">
                                        <p class="text-muted mb-0">Order Number : {{$order->id}}</p>
                                        <p class="text-muted mb-0"><span class="fw-bold me-4">Coupon Discount</span>{{$order->currency_symbol}} {{$order->coupon_discount}}</p>
                                    </div>
                                </div>
                                <div class="card-footer border-0 px-4 py-5"
                                     style="background-color: #f89321; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                    <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                                        : <span class="h2 mb-0 ms-2">{{$order->currency_symbol}} {{$order->order_total}}</span></h5>
                                </div>
                            </div>
        </div>
    </div>
@endsection
