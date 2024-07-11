 @extends('Frontend.layouts.master')
@section('content')





    <link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-about.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-res-about.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-faq.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-checkout.css')}}">

<main>
    <div class="banner" style="margin-top: 150px;">
        <div class="container">
            <figure id="banner-about" ><a href="#"><img src="{{ asset('flower/img/slide.png')}}" class="img-responsive" alt="img-holiwood" width="100%"></a></figure>
        <div class="title-banner">
            <h1>Checkout</h1>
            <p><a href="#" title="Home">Home</a><i class="fa fa-caret-right"></i>Checkout</p>
        </div>
        
        </div>
        
    </div>
<div class="container container-ver2 space-padding-tb-30">
                    <div class="row head-cart">
                        <div class="col-md-4 space-30">
                            <div class="item active center">
                                <p class="icon">01</p>
                                <h3>Shopping cart</h3>
                            </div>
                        </div>
                        <!-- End col-md-4 -->
                        <div class="col-md-4 space-30">
                            <div class="item active center">
                                <p class="icon">02</p>
                                <h3>Check out</h3>
                            </div>
                        </div>
                        <!-- End col-md-4 -->
                        <div class="col-md-4 space-30">
                            <div class="item center">
                                <p class="icon">03</p>
                                <h3>Order completed</h3>
                            </div>
                        </div>
                        <!-- End col-md-4 -->
                    </div>
                </div>
 <div class="cart-box-container check-out">

     <form class="form-horizontal" method="post" id="checkout_post">
                <div class="container container-ver2">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="title-brand">BILLING ADDRESS</h3>
                           <div>
                                <div class="form-group col-md-6">
                                    <label for="inputfname" class=" control-label">First Name <span class="color">*</span></label>                            
                                    <input type="text" required placeholder="Enter your first name..." id="inputfname" class="form-control" name="first_name">  
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputlname" class=" control-label">Last Name <span class="color">*</span></label>                            
                                    <input type="text"  required placeholder="Enter your last name..." id="inputlname" class="form-control" name="last_name">  
                                </div>
                            </div>
                              
                                <div>
                                    <div class="form-group col-md-6">
                                        <label for="inputemail" class=" control-label">Email<span class="color">*</span></label>                            
                                        <input type="text"required  placeholder="Enter your email..." id="inputemail" class="form-control" name="email">  
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputphone" class=" control-label">Phone<span class="color">*</span></label>                            
                                        <input type="text" required placeholder="Enter your phone..." id="inputphone" class="form-control" name="phone_no">  
                                    </div>
                                </div>
                                <div class="form-group hide">
                                    <label for="inputcountry1" class=" control-label">COUNTRY<span class="color">*</span></label>
                                    <select id="inputcountry1" name="inputcountry1" class=" form-control form-control">
                                        <option>COUNTRY 2</option>
                                        <option selected="selected">COUNTRY 1</option>
                                        <option>COUNTRY 3</option>
                                        <option>COUNTRY 4</option>
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="inputstreet" class=" control-label">Adress<span class="color">*</span></label>                            
                                    <input type="text" placeholder="Enter the apartment, floor, suite, etc..." id="inputapartment" required class="form-control" name="address"> 
                                </div>                        
                                <div class="form-group ">
                                    <label for="inputcountry" class=" control-label">Town/City<span class="color">*</span></label>                            
                                    <input type="text" placeholder="Enter your Town..." id="inputcountry" name="city" class="form-control space-20">
                                </div>
                                <div>
                                    <div class="form-group col-md-6 hide">
                                        <label for="inputfState" class=" control-label">COUNTY <span class="color">*</span></label>                            
                                        <input type="text" placeholder="Select your county..." id="inputfState" class="form-control">  
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputpostcode" class=" control-label">POSTCODE <span class="color">*</span></label>                            
                                        <input type="text" required placeholder="Enter your postcode..." id="inputpostcode" class="form-control">  
                                    </div>    
                                </div> 



                                  <div>
                                    <div class="form-group col-md-12">
                                        <label for="inputfState" class=" control-label">Message <span class="color">*</span></label>                            
                                        <textarea type="text" required placeholder="Message..." rows="2"  class="form-control" name="message"></textarea>   
                                    </div>
                                        
                                </div>


                               <!--  <label for="check-1" class="form-check space-50"><input type="checkbox" name="check1" id="check-1"><span class="checkmark"></span> Create an account?</label>
                                <label for="check-2" class="form-check space-20"><input type="checkbox" name="check2" id="check-2"><span class="checkmark"></span> Ship to a different address?</label> -->
                          
                            
                            
                        </div>
                        <!-- End col-md-8 -->
                        <div class="col-md-6 space-30">
                            <div class="box">
                                <h3 class="title-brand">YOUR ORDER</h3>
                                <div class="info-order">
                                    <div class="product-name">
                                        <ul>
                                            <li class="head">
                                                <span class="name">PRODUCTS NAME</span>
                                                <span class="qty"><b>QTY</b></span>
                                                <span class="total"><b>SUB TOTAL</b></span>
                                            </li>

                            @php $total_qty = $total_amount = 0; @endphp
                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                     @php 
                                     $total_qty +=$details['quantity'];
                                     $total_amount +=$details['quantity']*$details['price'];

                                      @endphp
                                            <li>
                                                <span class="name">{{ $details['name'] }}</span>
                                                <span class="qty">{{ $details['quantity'] }}</span>
                                                <span class="total">${{ $details['price'] }}</span>
                                            </li>
                                           
                                    @endforeach
                                @endif

                                    <input type="hidden" name="items" value="{{ $total_qty }}">
                                    <input type="hidden" name="TotalAmount" value="{{ $total_amount }}">
                                        </ul>
                                    </div>
                                    <!-- End product-name -->
                                    <ul class="product-order">
                                        <li>
                                            <span class="left">CART SUBTOTAL</span>
                                            <span class="right">$980.00</span>
                                        </li>
                                        <li>
                                            <span class="left">SHIPPING & HANDLING</span>
                                            <span class="right">Free Shipping</span>
                                        </li>
                                        <li>
                                            <span class="left">ORDER TOTAL</span>
                                            <span class="right brand">$980.00</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End info-order -->
                                <div class="payment-order box float-left">
                                <h3 class="title-brand">PAYMENT MENTHOD</h3>
                                <ul class="tabs">
                                    <li>
                                        <i class="icon"></i>
                                        <h4>Direct Bank Transfer</h4>
                                        <p>Make your payment directly info our bank account. Please use your order ID as the
                                        payment reference. You product won't be shipped untill payment confiimation. </p>
                                    </li>
                                    <li>
                                        <i class="icon"></i>
                                        <h4>Cheque Payment</h4>
                                        
                                    </li>
                                    <li>
                                        <i class="icon"></i>
                                        <h4>PayPal</h4>
                                    </li>
                                    <li>
                                        <i class="icon"></i>
                                        <h4>I've raed and accept the </h4><a href="#" title="Temr & conditions">Temr & conditions</a>
                                    </li>
                                </ul>
                                </div>
                                <button type="submit" class="link-v1 box lh-50 rt full"  title="PLACE ORDER">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                </div>

    </form>
                <!-- End container -->
            </div>
</main>
@endsection