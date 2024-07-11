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


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css">


<!-- GG FONT -->
<link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

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



    <header class="navbar-fixed-top pos-header" id="header-v1">
 
        <div class="container">
            <div class="row">


                <div class="navbar-header mobile-menu">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse col-lg-6 col-md-6 col-sm-12 col-xs-12" id="myNavbar">
                    <form class="hidden-lg hidden-md form-group form-search-mobile">
                        <input type="text" name="search" placeholder="Search here..." class="form-control">
                        <button type="submit"><img src="{{ asset('flower/img/Search.png') }}" alt="search" class="img-responsive"></button>
                    </form>
                    <ul class="nav navbar-nav menu-main">
                        <li>
                            <figure id="btn-close-menu" class="hidden-lg hidden-md"><i class="far fa-times-circle"></i>
                            </figure>
                        </li>
                        <li class="dropdown menu-home">
                            <a href="{{ url('/') }}" id="home-menu">Home</a>
                            <ul class="menu-home-lv2 dropdown-menu hide">
                                <li class="li-home"><i
                                        class="fas fa-long-arrow-alt-right hidden-md hidden-sm hidden-xs"></i><a
                                        href="homev1.html">Home 1</a></li>
                                <li class="li-home"><i
                                        class="fas fa-long-arrow-alt-right hidden-md hidden-sm hidden-xs"></i><a
                                        href="homev2.html">Home 2</a></li>
                                <li class="li-home"><i
                                        class="fas fa-long-arrow-alt-right hidden-md hidden-sm hidden-xs"></i><a
                                        href="homev3.html">Home 3</a></li>

                            </ul>
                        </li>

                        <li class="wedding-menu"><a href="{{ url('/category/1') }}">Products</a>
                            <figure id="wedding-1" class="hidden-sm hidden-xs"></figure>
                        </li>

                        <li class="shop-menu dropdown hide"><a href="{{ url('/category/1') }} " class="dropdown-toggle" data-toggle="dropdown">Products
                                +</a>
                            <figure id="shop-1" class="hidden-sm hidden-xs"></figure>
                           <!--  <div class="dropdown-menu">
                                <div class="container container-menu">
                                    <ul class="row">
                                        <li class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <ul>
                                                <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12 menu-home-lv2">
                                                    <ul>
                                                        <li><a href="#">SHOP PAGE</a> </li>
                                                        <li class="li-home li-one"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="shop-right-sidebar.html">Right sidebar</a></li>
                                                        <li class="li-home"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="shop-left-sidebar.html">Left sidebar</a></li>
                                                        <li class="li-home"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="shop-full-screen.html">Full screen</a></li>
                                                        <li class="li-home"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="shop-full-width.html">Full width</a></li>
                                                        <li class="li-home"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="singel-detail.html">Singel detail</a></li>

                                                    </ul>
                                                </li>
                                                <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12 menu-home-lv2">
                                                    <ul>
                                                        <li><a href="#">CHECKING PAGE</a></li>
                                                        <li class="li-home li-one"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="shopping-cart.html">Shopping Cart</a></li>
                                                        <li class="li-home"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="checkout.html">Checkout</a></li>
                                                        <li class="li-home"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="order.html">Order</a></li>
                                                    </ul>
                                                </li>
                                                <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12 menu-home-lv2">
                                                    <ul>
                                                        <li><a href="#">OTHER PAGE</a></li>
                                                        <li class="li-home li-one"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="FAQ.html">FAQ</a></li>
                                                        <li class="li-home"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="login_register.html">Login/Register</a></li>
                                                        <li class="li-home"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="page404.html">Page404</a></li>
                                                        <li class="li-home"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="tracking.html">Tracking</a></li>
                                                        <li class="li-home"><i
                                                                class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                                                href="wishlist.html">Wishlist</a></li>
                                                    </ul>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="col-lg-4 col-md-4 hidden-sm hidden-xs li-banner">
                                            <a href="#"><img src="{{ asset('flower/img/340x240.png') }}" alt="img-holiwood"></a>
                                        </li>

                                    </ul>
                                </div>
                            </div> -->
                        </li>
                        <li class="wedding-menu"><a href={{ route('frontend.about') }}>About Us</a>
                            <figure id="wedding-1" class="hidden-sm hidden-xs"></figure>
                        </li>
                       <!--  <li class="blog-menu dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog</a>
                            <figure id="blog-1" class=" hidden-sm hidden-md hidden-xs"></figure>
                            <ul class="menu-home-lv2 dropdown-menu">
                                <li class="li-home"><i
                                        class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                        href="blog.html">Blog right sidebar</a></li>
                                <li class="li-home"><i
                                        class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                        href="blog-left-sidebar.html">Blog Left sidebar</a></li>
                                <li class="li-home"><i
                                        class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                        href="blog-no-sidebar.html">Blog no sidebar</a></li>
                                <li class="li-home"><i
                                        class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                        href="singel-post-left-sidebar.html">Singel post left sidebar</a></li>
                                <li class="li-home"><i
                                        class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                        href="singel-post-right-sidebar.html">Singel post right sidebar</a></li>
                                <li class="li-home"><i
                                        class="fas fa-long-arrow-alt-right hidden-sm hidden-md hidden-xs"></i><a
                                        href="singel-post-no-sidebar.html">Singel post no sidebar</a></li>
                            </ul>
                        </li> -->
                        <li class="contact-menu"><a href={{ route('frontend.contact') }}>Contact</a>
                            <figure id="contact-1" class="hidden-sm hidden-xs"></figure>
                        </li>
                        <li class="hidden-lg hidden-md"><a href="#"><i class="far fa-user"></i> My Account</a></li>
                        <li class="hidden-lg hidden-md hidden-sm phone-mobile"><strong>P:</strong>800 123 654 78</li>
                        <li class="hidden-lg hidden-md hidden-sm phone-mobile"><strong>E:</strong>Jenstore@gmail.com
                        </li>
                    </ul>
                </div>
                <ul class="logo col-lg-2 col-md-2 col-sm-7 col-xs-7">
                    <li><a href="#"><img src="{{ asset('flower/img/logo.png') }}" class="img-responsive" alt="img-holiwood"></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right icon-menu col-lg-4 col-md-4 col-sm-5 col-xs-5">
                    <li class="icon-user hidden-sm hidden-xs"><a href="#"><i class="far fa-user"></i></a></li>
                    <li class="dropdown cart-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ asset('flower/img/cart.png') }}" id="img-cart"
                                alt="img-holiwood"></a>
                        <div class="dropdown-menu">

                            <div class="cart-view">
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        
                            <div class="cart-1">
                                <div class="img-cart"><img src="{{ asset('flower/img/340x420.png') }}" class="img-responsive"
                                        alt="img-holiwood"></div>
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


                    <!--         <div class="cart-1">
                                <div class="img-cart"><img src="{{ asset('flower/img/340x420.png') }}" class="img-responsive"
                                        alt="img-holiwood"></div>
                                <div class="info-cart">
                                    <h1>Pink roses</h1>
                                    <span class="number">x1</span>
                                    <span class="prince-cart">$207.2</span>
                                </div>
                            </div>
                            <div class="cart-1">
                                <div class="img-cart"><img src="{{ asset('flower/img/340x420.png') }}" class="img-responsive"
                                        alt="img-holiwood"></div>
                                <div class="info-cart">
                                    <h1>Eleganr by BloomNation</h1>
                                    <span class="number">x1</span>
                                    <span class="prince-cart">$207.2</span>
                                </div>
                            </div>
                            <div class="cart-1">
                                <div class="img-cart"><img src="{{ asset('flower/img/340x420.png') }}" class="img-responsive"
                                        alt="img-holiwood"></div>
                                <div class="info-cart">
                                    <h1>Queen Rose - Yellow</h1>
                                    <span class="number">x1</span>
                                    <span class="prince-cart">$207.2</span>
                                </div>
                            </div> -->
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
                        <a href="#"><img src="{{ asset('flower/img/Search.png') }}" alt="img-holiwood"></a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
   



