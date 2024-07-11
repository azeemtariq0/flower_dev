@extends('frontend.layouts.master')
@section('title')
    My Order - {{config('app.name')}}
@endsection
@section('content')

{{--<div class="container mt-3 mt-md-5">--}}
{{--    <h2 class="text-charcoal hidden-sm-down">Your Orders</h2>--}}
{{--    <div class="row">--}}
<div class="container-fluid md-shadow rounded-4">
    <div class="row">
        @include('frontend.dashboard.userSidebar')
        <div class="col-md-9">
            <div class="list-group mb-5">
                <h6 class="modal-title text-uppercase mb-5" id="exampleModalLabel">{{auth()->user()->name}}</h6>
                <h5 class="mb-5" style="color: #f89321;">Thanks for your order</h5>
                <p class="mb-0" style="color: #35558a;">Payment summary</p>
                <hr class="mt-2 mb-4"
                    style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                @foreach($orderdetail as $order)
                    <div class="modal-body text-start text-black p-4">
                        <div class="d-flex justify-content-between">
                            <p class="fw-bold mb-0">Pre Total</p>
                            <p class="text-muted mb-0">{{$order->currency_symbol}}{{$order->pre_total}}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="small mb-0">Shipment Charges</p>
                            <p class="small mb-0">{{$order->currency_symbol}}{{$order->shipment_charges}}</p>
                        </div>

                        <div class="d-flex justify-content-between pb-1">
                            <p class="small">Coupon Discount</p>
                            <p class="small">{{$order->currency_symbol}}{{$order->coupon_discount}}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="fw-bold">Total</p>
                            <p class="fw-bold" style="color: #f89321;">{{$order->currency_symbol}}{{$order->order_total}}</p>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                        <a href="{{url('my-order',$order->id)}}" class="btn btn-primary btn-lg mb-1" style="background-color: #f89321;">View Order</a>
{{--                        <button type="button" class="btn btn-primary btn-lg mb-1" style="background-color: #f89321;">--}}
{{--                            View Order--}}
{{--                        </button>--}}
                    </div>
{{--                <div class="list-group-item p-3 bg-snow" style="position: relative;">--}}

{{--                    <div class="row w-100 no-gutters">--}}
{{--                        <div class="col-6 col-md">--}}
{{--                            <h6 class="text-charcoal mb-0 w-100">Order NO.</h6>--}}
{{--                            <a href="" class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{$order->id}}</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 col-md">--}}
{{--                            <h6 class="text-charcoal mb-0 w-100">Date</h6>--}}
{{--                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{$order->created_at->format('Y-m-d')}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 col-md">--}}
{{--                            <h6 class="text-charcoal mb-0 w-100">Order Status</h6>--}}
{{--                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{$order->order_status}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 col-md">--}}
{{--                            <h6 class="text-charcoal mb-0 w-100">Grand Total</h6>--}}
{{--                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{$order->grand_total}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 col-md">--}}
{{--                            <h6 class="text-charcoal mb-0 w-100">Payement Status</h6>--}}
{{--                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{$order->payment_status}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-md-3">--}}
{{--                            <a href="{{url('my-order',$order->id)}}" class="btn btn-primary w-100">View Order</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="list-group-item p-3 bg-white">--}}
{{--                    <div class="row no-gutters">--}}
{{--                        <div class="col-12 col-md-9 pr-0 pr-md-3">--}}
{{--                            <div class="alert p-2 alert-success w-100 mb-0">--}}
{{--                                <h6 class="text-green mb-0"><b>Shipped</b></h6>--}}
{{--                                <p class="text-green hidden-sm-down mb-0">Est. delivery between {{$order->created_at}} – {{$order->updated_at}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-md-3">--}}
{{--                            <a href="" class="btn btn-secondary w-100 mb-2">Track Shipment</a>--}}
{{--                        </div>--}}
{{--                        <div class="row no-gutters mt-3">--}}
{{--                            <div class="col-3 col-md-1">--}}
{{--                                <img class="img-fluid pr-3" src="https://tanga2.imgix.net/https%3A%2F%2Fs3.amazonaws.com%2Ftanga-images%2Ffc79d08c12dc.jpeg?ixlib=rails-2.1.1&fit=crop&w=500&h=500&auto=format%2Ccompress&cs=srgb&s=c9a50d474788f2658d13b21aa62edd6c" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="col-9 col-md-8 pr-0 pr-md-3">--}}
{{--                                <h6 class="text-charcoal mb-2 mb-md-1">--}}
{{--                                    <a href="" class="text-charcoal">460</a>--}}
{{--                                </h6>--}}
{{--                                <ul class="list-unstyled text-pebble mb-2 small">--}}
{{--                                    <li class="">--}}
{{--                                        <b>Color:</b>{{$variations}}--}}
{{--                                    </li>--}}
{{--                                    <li class="">--}}
{{--                                        <b>Size:</b>{{$variations}}--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <h6 class="text-charcoal text-left mb-0 mb-md-2"><b>Pre Total = {{$order->pre_total}}</h6></b>--}}
{{--                                <h6 class="text-charcoal text-left mb-0 mb-md-2"><b>Shipment Charges = {{$order->shipment_charges}}</h6></b>--}}
{{--                                <h6 class="text-charcoal text-left mb-0 mb-md-2"><b>Coupon Discount = {{$order->coupon_discount}}</h6></b>--}}
{{--                                <h6 class="text-charcoal text-left mb-0 mb-md-2"><b>Order Total = {{$order->order_total}}</h6></b>--}}
{{--                            </div>--}}
{{--                            <div class="col-12 col-md-3 hidden-sm-down">--}}
{{--                                <a href="" class="btn btn-secondary w-100 mb-2">Buy It Again</a>--}}
{{--                                <a href="" class="btn btn-secondary w-100">Request a Return</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
