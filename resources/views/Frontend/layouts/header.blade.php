<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <title>Yasmin Flower</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?php header('Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="icon" href="{{ asset('flower/img/favicon.png') }}" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-homev1.css') }}">
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">


<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-flower.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-res-flower.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-res-v1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-fix-nav.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-about.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-res-about.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-contact.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-res-contact.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-form-search-mobile.css') }}">
<!-- scroll -->
<link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-product-detail.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('flower/css/style-res-product-detail.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('flower/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('flower/slick/slick-theme.css')}}">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css">


<!-- GG FONT -->
<link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700" rel="stylesheet">
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous"> --}}

    <style>
        .nav-logo {
            width: 15rem;
        }

        .footer-icon {
            width: 10rem;
            height: 6rem;

        }

        .alert,
        .alert button {
            font-size: 14px;

        }

        .alert button.close {
            background: transparent;
            border: none;
            position: absolute;
            top: 50%;
            right: 1%;
            font-size: 25px;
            transform: translateY(-60%);
        }

        .d-flex {
            display: flex;
        }

        .justify-content-evenly {
            justify-content: space-evenly;
        }

        .d-inline-block {
            display: inline-block;
        }
        @media screen and (max-width: 700px) {
            .hidden{
                visibility: unset;
                top: 0;
            }
        }

        header{
            padding: 0px !important;
            /*background-color: #f3f3f3;*/
            background-color: #ffe0e0;
        }


    </style>
</head>
<body>

    <header style="top:0px;height: 30px;width:100%;background:#8D1D3D !important;font-size:1.3rem;color:rgba(255, 255, 255, 0.863);display:flex;justify-content:center; align-items:center;position:fixed;z-index:99999 !important;">
        🌸 Welcome to Yasmin Flowers! Enjoy free shipping on all orders over $50! 🌸
    </header>

    <header class="navbar-fixed-top pos-header" style="top:30px" id="header-v1">
 
        <div class="container" style="width:100%;margin:0 !important;">
            <div class="row d-flex " style="align-items:center;justify-content:space-between;">


                <div class="navbar-header mobile-menu">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <ul class="logo" style="padding:10px 0 !important;">
                    <li><a href="#" style="display: inline"><img  style="margin: 0 !important;" src="{{ asset('flower/img/logo.png') }}" class="img-responsive" alt="img-holiwood"></a></li>
                </ul>
                <div class="collapse navbar-collapse col-lg-6 col-md-6 col-sm-12 col-xs-12" id="myNavbar">
                    <form class="hidden-lg hidden-md form-group form-search-mobile">
                        <input type="text" name="search" placeholder="Search here..." class="form-control">
                        <button type="submit"><img src="{{ asset('flower/img/Search.png') }}" alt="search" class="img-responsive"></button>
                    </form>
                    <ul class="nav navbar-nav menu-main" style="padding-top:0 !important;">
                        <li>
                            <figure id="btn-close-menu" class="hidden-lg hidden-md"><i class="far fa-times-circle"></i>
                            </figure>
                        </li>
                        <li class=" menu-home">
                            <a href="{{ url('/') }}" id="home-menu">Home</a>
                        </li>

                        <li class="menu-category"><a href="{{ url('/category/1') }}">Products</a>
                        </li>

                     
                        <li class="menu-aboutus"><a href="{{ route('frontend.about') }}">About Us</a>
                        </li>

                        <li class="menu-aboutus"><a href="{{ route('frontend.contact') }}">Contact Us</a>
                        </li>
                    </ul>
                </div>
              
                <style>
                    .icon-menu::before{
                        display: none
                    }
                </style>
                <ul class="nav navbar-nav navbar-right icon-menu col-lg-4 col-md-4 col-sm-5 col-xs-5 d-flex" style="padding-top:0 !important;justify-content:end;">
                    <li class="icon-user hidden-sm hidden-xs"><a href="#"><i class="fa-regular fa-user " style="padding:0 !important;font-size:2rem;color:black"></i></a></li>
                    <li class="dropdown cart-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa-regular fa-shopping-bag " style="font-size:2rem;color:black"></i></a>
                        <div class="dropdown-menu">

                            <div class="cart-view">
                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        
                            <div class="cart-1">
                                <div class="img-cart"><i class="fa-regular fa-shopping-bag " style="font-size:2rem;color:black"></i></div>
                                <div class="info-cart">
                                    <h1>{{ $details['name'] }}  </h1>
                                    <span class="number">x{{ $details['quantity'] }}</span>
                                    <span class="prince-cart">${{ $details['price'] }} </span>

                                </div>
                                <i class="far fa-times-circle pull-right text-danger remove-from-cart"  data-id="11" title="Delete" ></i>
                            </div>


                        @endforeach
                        @endif

                        </div>
                            <div class="total hide">
                                <span>Total:</span>
                                <span>$621.6</span>
                            </div>
                            <div id="div-cart-menu">
                                <a href="{{ url('/shopping-cart') }}">ADD TO CART</a>
                                <a href="{{ url('/checkout') }}" class="check">CHECK VIEW</a>
                            </div>
                        </div>
                    </li>
                    <li id="input-search" class="hidden-sm hidden-xs">
                        <a href="#"><i class="fa-regular fa-magnifying-glass " style="font-size:1.9rem;color:black"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
   



