<!DOCTYPE html>
<?php $code = 'en'; ?>

<html lang="{{$code ?? $_GET['lang']}}">

<head>
    <title>Dopamine Travel</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?php header('Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.7/dist/fancybox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('travel/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('travel/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('travel/css/main.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
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
    </style>

</head>

<body>
<?php
if (isset($code)) {
    $lange = $code;
} else {
    $lange = $_GET['lang'];
}
dd(code);
$menus = App\Helpers\Menus::SelectedMenu($lange);
?>
<header class="header hidden menu_for_mobile">
    <a href="{{url('/')}}" class="logo"><img src="{{ asset('travel/images/logo.png') }}"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        @if(isset($menus))
            @foreach($menus as $menu)
                <li><a href="{{url('tour',$menu->slug)}}?lang={{$lange}}">{{$menu->title}}</a>
                </li>
            @endforeach
        @endif
        {{--        <li><a href="{{url('tour','honeymoon-places')}}?lang={{$code ?? $_GET['lang']}}">Honeymoon Packages</a></li>--}}
        {{--        <li><a href="{{url('tour','family-places')}}?lang={{$code ?? $_GET['lang']}}">Family Packages</a></li>--}}
        {{--        <li><a href="{{url('tour','holiday-packages')}}?lang={{$code ?? $_GET['lang']}}">Holiday Packages</a></li>--}}
        {{--        <li><a href="{{url('tour','holiday-deals')}}?lang={{$code ?? $_GET['lang']}}">Holiday Deals</a></li>--}}
        {{--        <li><a href="{{url('tour','luxury-holidays')}}?lang={{$code ?? $_GET['lang']}}">Luxury Holidays</a></li>--}}
        {{--        <li><a href="{{url('tour/honeymoon-places')}}?lang={{$code ?? $_GET['lang']}}">Plan My Holiday</a></li>--}}
        <li><a href="tel:+971529081659"><img src="{{ asset('travel/images/phone.png') }}">
                {{$translate =App\Helpers\Menus::Translator(119,$code)}} </a></li>
        <li><a href="#"><img src="{{ asset('travel/images/user.png') }}"> {{$translate =App\Helpers\Menus::Translator(44,$code)}}</a></li>
        <li><a href="{{ url('https://client.edwomtech.com/dopaminetravel_wp/') }}"><img
                        src="{{ asset('travel/images/blog.png') }}">{{$translate =App\Helpers\Menus::Translator(45,$code)}}</a></li>
        <li><a href="#"><img src="{{ asset('travel/images/offers.png') }}"> Offers</a></li>
        @guest
            <li class="d-flex justify-content-evenly"><a class="d-inline-block" href="{{ url('login') }}">LOGIN</a>
                <a class="d-inline-block" href="{{ url('register') }}">REGISTER</a></li>
        @endguest
        @auth
            @if (Auth::user()->hasRole('User'))
                <li><a href="{{ url('my-profile') }}"><i class="fa fa-user-circle-o mx-1" aria-hidden="true"></i> My
                        Account</a></li>
            @else
                <li><a href="{{ url('admin/home') }}"><i class="mx-1 fa fa-user-circle-o" aria-hidden="true"></i> My
                        Account</a></li>
            @endif
        @endauth
    </ul>
</header>
<header class="header">
    <div class="container-fluid">
        <div class="row header_top">
            <div class="col-sm-3">
                <a href="{{url('/')}}"><img src="{{ asset('travel/images/logo.png') }}"></a>
            </div>
            <div class="col-sm-9 text-right">
                <ul class="nav">
                    <li><a href="tel:+971529081659"><img src="{{ asset('travel/images/phone.png') }}">
                            {{$translate =App\Helpers\Menus::Translator(119,$code)}} </a></li>
                    <li><a href="#"><img src="{{ asset('travel/images/user.png') }}"> {{$translate =App\Helpers\Menus::Translator(44,$code)}}</a></li>
                    <li><a href="{{ url('https://client.edwomtech.com/dopaminetravel_wp/') }}"><img
                                    src="{{ asset('travel/images/blog.png') }}">{{$translate =App\Helpers\Menus::Translator(45,$code)}}</a></li>
                    <li><a href="#"><img src="{{ asset('travel/images/offers.png') }}"> {{$translate =App\Helpers\Menus::Translator(46,$code)}}</a></li>
                    @guest
                        <li><a href="{{ url('login') }}">LOGIN</a></li>
                        <li><a href="{{ url('register') }}">REGISTER</a></li>
                    @endguest
                    @auth
                        @if (Auth::user()->hasRole('User'))
                            <li><a href="{{ url('my-profile') }}"><i class="fa fa-user-circle-o mx-1"
                                                                     aria-hidden="true"></i>{{$translate =App\Helpers\Menus::Translator(47,$code)}}</a></li>
                        @else
                            {{--                            redirect()->url('admin/home');--}}
                            <li><a href="{{ url('admin/home') }}"><i class="mx-1 fa fa-user-circle-o"
                                                                     aria-hidden="true"></i>{{$translate =App\Helpers\Menus::Translator(47,$code)}}</a></li>
                        @endif
                    @endauth
                                        @php
                                            $languages = App\Helpers\DefaultLanguage::AllLanguage();
                                        @endphp
                    <style>
                        .styled-list {
                            padding: 4px 14px;
                            background-color: transparent;
                            border: 1px solid #fe5246;
                            color: #fe5246 !important;
                            font-size: 14px;
                            line-height: 16px;
                            display: inline-block;
                            text-decoration: none;
                            text-transform: capitalize;
                            cursor: pointer;
                            font-weight: 700;
                            -webkit-appearance: none;
                            outline: none;
                            text-align: center
                        }
                    </style>
                    <li>
                        <div>
                            <select class="styled-list" aria-label="Default select example"
                                    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">

                                <option disabled selected>Select Language</option>
                                @foreach ($languages as $lang)
                                    <option {{ $lang->language_code == $lange ? 'Selected' : '' }}
                                            value="https://eliteblue.net/travel/v3/public/{{ $lang->language_code }}">
                                        {{ $lang->language_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row header_bottom">
            <div class="col-sm-6 text-left">
                <ul class="menu nav">
                    <h1></h1>
                    @if(isset($menus))
                        @foreach($menus as $menu)
                            <li><a href="{{url('tour',$menu->slug)}}?lang={{$lange}}">{{$menu->title}}</a>
                            </li>
                        @endforeach
                        @endif
                        {{--                    <li><a href="{{url('tour','honeymoon-places')}}?lang={{$code ?? $_GET['lang']}}">Honeymoon--}}
                        {{--                            Packages</a>--}}
                        {{--                        <!--                     <li><a href="">Honeymoon Packages</a> -->--}}
                        {{--                        --}}{{--                         <ul>--}}
                        {{--                        --}}{{--                            <li><a href="#">Dropdown</a></li>--}}
                        {{--                        --}}{{--                            <li><a href="#">Dropdown</a></li>--}}
                        {{--                        --}}{{--                            <li><a href="#">Dropdown</a></li>--}}
                        {{--                        --}}{{--                        </ul>--}}
                        {{--                    </li>--}}
                        {{--                    <li><a href="{{url('tour','family-places')}}?lang={{$code ?? $_GET['lang']}}">Family Packages</a>--}}
                        {{--                    </li>--}}
                        {{--                    <li><a href="{{url('tour','holiday-packages')}}?lang={{$code ?? $_GET['lang']}}">Holiday--}}
                        {{--                            Packages</a></li>--}}
                        {{--                    <li><a href="{{url('tour','holiday-deals')}}?lang={{$code ?? $_GET['lang']}}">Holiday Deals</a></li>--}}
                        {{--                    <li><a href="{{url('tour','luxury-holidays')}}?lang={{$code ?? $_GET['lang']}}">Luxury Holidays</a>--}}
                        {{--                    </li>--}}
                </ul>
            </div>
            <div class="col-sm-6 text-right">
                <ul class="menu nav menu_right">
                    <!--                     <li><a href="">Hotels</a></li>
                                        <li><a href="">Destination Guides</a></li> -->
                {{--                    {{url('en/collection?category=holiday-themes   ')}}--}}
                <!--                     <li><a href="">Holiday Themes</a></li> -->
                </ul>
            </div>
        </div>
    </div>
</header>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script> -->
<script type="text/javascript">
    var form = jQuery("#contact");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            alert('submit');
            $(document).ready(function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }});

                $.ajax({
                    url: "{{url('help-planning')}}",
                    type: "POST",
                    data: $('#contact').serialize(),
                    dataType: "json",
                    success: function(response){
                        $('#contact').trigger('reset');
                        aler('Form Submit Successfully');
                        $("#contact").hide();
                    }
                });
            });
        }
    });
    jQuery(document).ready(function () {

        jQuery("#contact").hide();


        jQuery("#contact").hide().delay(5000).queue(function (n) {
            jQuery(this).show();
            n();
        });
    });
    // var picker = new Pikaday({ field: document.getElementById('datepicker') });
</script>



