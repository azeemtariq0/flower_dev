@extends('Frontend.layouts.master')
@section('content')
<style>
    div#inclusions li a {
        font-size: 14px;
        font-weight: 900;
        padding: 15px 24px !important;
        /* background: #efefef !important; */
        border-radius: 0;
        border: 0;
        color: #3e3e3e !important;
        /* border-bottom: 2px solid #E6542D; */
        margin: 0;
    }

    .z-n1 {
        z-index: 1;
    }

    .z-n9 {
        z-index: 99999;
    }

    .slide_text_pkg {
        position: unset !important;
    }

    .ps-0 {
        padding-inline-start: 0px !important;
    }

    .justify-content-end {
        justify-content: end;
    }

    .star i {
        color: #ccc !important;
        transition: all .1s ease;
    }

    .star.hover i {
        color: #FFCC36 !important;
    }

    .star.selected i {
        color: #FF912C !important;
    }

    .magical_slider img {
        width: 100%;
        max-height: 462px;
        object-fit: cover;
    }

    .enquire {
        color: #ffff;
        background-color: #fb8f1d;
        padding-left: 4px;
        font-size: 14px;
        border: #fb8f1d;
    }

    .enquiry {
        margin-right: 4px;
    }

    /*.panel-body{*/
    /*    display: none;*/
    /*}*/
    .showaccordion {
        display: block;
    }

    .txt {
        color: #000000 !important;
    }

    /* .container {
                        width: 80%;
                        max-width: 600px;
                        margin: 50px auto;
                    } */

    button.accordion {
        width: 100%;
        background-color: whitesmoke;
        border: none;
        outline: none;
        text-align: left;
        padding: 15px 20px;
        font-size: 18px;
        color: #333;
        cursor: pointer;
        transition: background-color 0.2s linear;
    }

    button.accordion:after {
        font-family: FontAwesome;
        content: "\f150";
        font-family: "fontawesome";
        font-size: 18px;
        float: right;
    }

    button.accordion.is-open:after {
        content: "\f151";
    }

    button.accordion:hover,
    button.accordion.is-open {
        background-color: #ddd;
    }

    .accordion-content {
        background-color: white;
        border-left: 1px solid whitesmoke;
        border-right: 1px solid whitesmoke;
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-in-out;
    }

    .m-0 {
        margin: 0px;
    }

    .star .fa {
        font-size: calc(2vw + 1rem)
    }

    .read-more-target {
        overflow: hidden;
        height: 12.5em;
        /* Adjust the height to control the number of visible lines */
        /* line-height: 1.25em; Adjust the line height for proper spacing */
    }

    .show-content {
        height: auto;
    }

    .expert_form {
        z-index: -1;
    }

    .bg-white {
        background: white;
    }

    #removeDateIconp {
        margin-top: auto;
        margin-bottom: auto;
        padding-right: 7px;
    }

    .expert_form .submit {
        display: flex !important;
    }

    .d-flex {
        display: flex;
    }

    .d-imp-flex {
        display: flex !important;
    }

    .tab p input {
        padding: 10px !important;
        width: 100% !important;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
        border: none !important;
        background: transparent !important;
    }
</style>
<style>
    .checkbox-row label {
        font-weight: normal;
    }

    .how-it-img {
        margin-top: 10px;
    }

    .popup {
        display: none;
        /* Hide the modal by default */
        position: fixed;
        /* Position it on top of the content */
        z-index: 1;
        /* Make sure it's on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Make it full width */
        height: 100%;
        /* Make it full height */
        overflow: auto;
        overflow-x: hidden;
        /* Enable scrolling if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Add a semi-transparent background */
        align-items: center;
        justify-content: center;
        position: absolute;
        position: fixed;
        z-index: 99999;
    }

    .popup-content {
        background-color: #fefefe;
        /* margin: 15% auto; */
        /* Center the modal vertically and horizontally */
        /* padding: 20px; */
        border: 1px solid #888;
        min-width: 760px;
        width: 760px;
        display: flex;
        height: 95vh;
        overflow-y: auto;
        /* margin-top: 10%; */
    }

    .quotesclose-div {
        width: 790px;
        height: 50px;
        position: absolute;
        /* background: black; */
        display: flex;
        justify-content: end;

    }

    .quotesclose-div img {
        width: 30px;
    }

    .quotesclose:hover,
    .quotesclose:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .location_heading {
        font-family: Lato, sans-serif !important;
        color: #009688;
        display: flex;
        justify-content: center;
        font-weight: 700 !important;
        /* font-size: 31px; */
        margin: 0px;


    }


    .svg {
        width: 50px;
        height: 50px;
    }

    .popup-clearfix {
        background-color: #f2f2f2;
        height: auto;
        width: 41%;
        padding-inline: 10px !important;
        padding-block: 20px;
    }

    .round-bullets {
        border: 1px solid #20a397;
        top: -3px;
    }

    .textes ul li {
        /* line-height: 29px; */
        font-family: Lato, sans-serif !important;
        margin-inline: 10px;
        margin-block: 15px;
        list-style: none;
        /* font-weight: 600; */
        display: flex;
    }

    .round-bullets {
        color: #009688;
        border: 2px solid #20a397;
        /* top: -3px !important; */
        /* border-radius: 67px !important; */
        /* padding: 6px 10px; */
        height: 30px;
        width: 30px;
        border-radius: 100% !important;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .textes ul {
        padding: 0;
    }

    .textes ul li p {
        width: 90%;
        margin: 0;
        padding-left: 10px;
    }

    .card-text {
        font-family: Lato, sans-serif !important;
    }

    .number {

        font-family: Lato, sans-serif !important;
        display: flex;
        font-size: 24px;
        padding-top: 12px;
        padding-bottom: 24px;
        text-align: center;
    }

    .bb {
        border-bottom: 1px solid #d4d4d4;
    }

    .box3 {
        text-align: center;
        display: flex;
        justify-content: space-between;
    }


    h4.card-text {
        margin: 0px;
    }

    .call-detail {
        margin-top: 45px;
        justify-content: center;
        display: flex;
        margin-left: 5px !important;
    }

    span.call-us {
        margin-left: 19px;
    }

    .form-popup {
        width: 59%;
    }

    .yesnobtn {
        justify-content: space-between;
    }

    .yesnobtn>div label {
        background: transparent;
        border: none;
        padding: 12px;
        color: #009688;
    }

    .yesnobtn p b {
        padding: 10px;
    }

    .yesnobtn-2 {
        justify-content: space-between;
    }

    .yesnobtn-2>div label {
        background: transparent;
        border: none;
        padding: 12px;
        color: #009688;
    }

    .yesnobtn-2 p b {
        padding: 10px;
    }

    .tabpkg {
        display: none;
    }

    .accordion .card-body. {
        padding-bottom: 15px;
    }

    .panel-heading .accordion-toggle:before {
        top: 20px !important;
    }

    .select-rating {
        color: #ffb100;
    }

    .text-muted {
        color: gray !important;
    }

    /* p {
                justify-content: center;
                display: flex;
            } */
</style>

<body class="detailed_page">
    <!-- <input type="text" id="datepicker"> -->
    <div class="container-inner detail_post">
        <div class="row bread_crumb">
            <div class="col-sm-7">
                <a href="#">Home &gt; </a>
                <a href="#">Honeymoon Packages&gt;</a>
                <a href="#">{{$single_package->title ?? ''}}&gt;</a>
                {{ $single_package->maximum_days - 1  ?? ''}} nights {{$single_package->maximum_days ?? ''}}
                days {{$single_package->title ?? ''}}
            </div>
            <div class="col-sm-5 text-right pull-right">
                <span class="text-right"><span>{{$single_package->title ?? ''}} </span> <br>Rated 4.1/5 (based on 8431 reviews)</span>
            </div>
        </div>
        <div class="row magical_row">
            <div class="col-sm-7">
                <strong>{{$single_package->title ?? ''}}</strong>
                <span class="seprator">|</span> <span class="orange">{{$single_package->maximum_days ?? ''}} Days & {{ $single_package->maximum_days - 1  ?? ''}} Nights</span>
                <span class="customizable">{{$translate =App\Helpers\Menus::Translator(133)}}</span>


            </div>
            <div class="col-sm-5 pull-right text-right">
                <a href="tel:1800-123-5555"><img src="{{asset('images/phone.png')}}"> Call Us for details <span>1800-123-5555</span></a>
            </div>
        </div>
    </div>

    <div class="container-inner">
        <div class="row">
            <div class="col-sm-7">
                <div class="magical_slider">
                    <?php $i = 1; ?>
                    @if(isset($media))
                    @foreach($media as $images)
                    @if(isset($images->image))
                    <div class="w-100">

                        <img src="{{asset('images/media/'.$images->image)}}">
                        <div class="slide_text_pkg">{{$images->caption ?? ''}}
                            <span> {{$i}} of {{count($media)}}</span>
                        </div>
                    </div>
                    @endif
                    <?php $i++; ?>
                    @endforeach
                    @endif
                </div>


            </div>
            <div class="px-h">
                <div class="col-sm-5 col_hotel_rating">
                    <div class="col_hotel_rating_inner">
                        <p><strong>{{$translate =App\Helpers\Menus::Translator(134)}}:</strong></p>
                        <p class="star_hotel">
                            @if(isset($hotels_star) && isset($single_package->hotel_id))
                            @foreach ($hotels_star as $star)
                            @if(in_array($star[0]['id'],json_decode($single_package->hotel_id)))
                            <span><input type="radio" name="star_hotel" checked> <label>{{$star[0]['hotel_type']}} Star</label></span>
                            @endif
                            @endforeach
                            @endif
                        </p>
                        <p>
                            @if(isset($citys))
                            @foreach($citys as $key=>$city)
                            <span>{{$translate =App\Helpers\Menus::Translator(135)}}: {{$city->title}} ({{count($citys)-$key}}D)</span>
                            <i class="
                                {{count($citys)-$key > 1 ? 'fa fa-arrow-right':''}}" aria-hidden="true"></i>
                            @endforeach
                            @endif
                        </p>

                        <div class="row hotel_row_brief text-center">
                            @if(isset($activities))
                            @foreach ($activities as $row)
                            @if ($row->image != null)
                            @php $image = '/'.$row->image @endphp
                            @else
                            @php $image = 'galleryimage.png' @endphp
                            @endif

                            <div class="col-sm-2"><img src="{{ asset('images/media' . '/' . $image) }}">
                                <p>{{$row->title}}</p>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col_hotel_rating_inner col_hotel_rating_inner_sec_2">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="starting_from">{{$translate =App\Helpers\Menus::Translator(126)}}:</p>
                                <input type="hidden" id="currency" name="currency" value="{{$currency->currency_symbol ?? ''}}">
                                <input type="hidden" id="money" name="money" value="{{$currency->currency_rate ?? ''}}">
                                @if($single_package->discount_price != null)
                                <div class="paisa">
                                    <p class="pricing_hotel">
                                        <strong>{{$currency->currency_symbol}} {{number_format($single_package->discount_price * $currency->currency_rate)}}
                                            /-</strong>
                                        <span>{{$currency->currency_symbol}} {{number_format($single_package->compare_price * $currency->currency_rate)}}/-</span>
                                    </p>
                                </div>
                                @else
                                <div class="paisa">
                                    <p class="pricing_hotel"><strong>
                                            {{$currency->currency_symbol}} {{number_format($single_package->compare_price * $currency->currency_rate)}}
                                        </strong>
                                    </p>
                                </div>
                                @endif
                                <strong>Per Person on twin sharing</strong>
                            </div>
                            <div class="col-sm-6 ">
                                <p class="starting_from pull-right">Price For The Month</p>
                                <select class="select_month_year pull-right" id="month-dd">
                                    <option value="" selected disabled>Select Month</option>
                                    @if($season_package != null)
                                    @foreach($season_package as $month)
                                    <option value="{{$month->id}}">{{$month->months}} {{now()->year}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    @if ($single_package->select_package === 0)
                    <a href="{{url(app()->getLocale().'/package/checkout')}}?id={{$single_package->id}}" class="inquirenowbtn">
                        <input type="hidden" name="product_id" value="{{$single_package->id}}">
                        <input type="submit" id="" name="" value="Checkout" style="background-color: #3cb3e4;">
                    </a>
                    @endif

                    <input type="submit" id="quotesBtn" name="submit" value="{{$translate =App\Helpers\Menus::Translator(132)}}">

                    <p class="text-center served_total">Dopamine has served 16666+ travelers for {{ $single_package->title ?? '' }}</p>

                </div>
            </div>
        </div>
    </div>

    <div class="px-h on_scroll_fixed">
        <div class="container-inner">
            <div class="row">
                <div class="col-sm-7">
                    <a href="#overview">Overview </a>
                    <a href="#itinerary">Itinerary </a>
                    <a href="#hotels">Hotels </a>
                    <a href="#inclusions">{{$translate =App\Helpers\Menus::Translator(142)}} / Exclusions </a>
                    <a href="#faq">FAQ</a>
                    <a href="#images_gallery">Images</a>
                    <a href="#video_gallery">Videos</a>
                </div>
                <div class="col-sm-5">
                    <div class="top_fixed_prices">
                        <strong>{{$currency->currency_symbol}}
                            @if($single_package->discount_price)
                            {{$single_package->discount_price * $currency->currency_rate}}
                            @elseif($single_package->compare_price != null)
                            {{$single_package->compare_price * $currency->currency_rate}}
                            @endif
                            /-</strong>
                        <span>{{$currency->currency_symbol}} {{$single_package->compare_price * $currency->currency_rate}}/-</span>
                        (per person)
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-h">
        <div class="container-inner">
            <div class="row">
                <div class="col-sm-7">
                    <div id="overview" class="inner_box_fixed_tab">

                        <div class="who_we_are contentboxtoggle" id="content">

                            <h4>{{ $single_package->title ?? '' }} - Overview</h4>

                            <div class="read-more-target-2">
                                <p class="" id="contentText">{!! $single_package->description ?? '' !!}</p>
                            </div>
                            @if($single_package->description != null)
                            <p class="pull-right"><a id="readMoreButton" class="readmore-btn">{{$translate =App\Helpers\Menus::Translator(111)}}</a>
                            </p>
                            @endif

                        </div>

                    </div>
                    <div id="itinerary" class="inner_box_fixed_tab">
                        <div class="container-inner">
                            <h4>Itinerary</h4>
                        </div>
                        <div class="clear"></div>
                        <section>
                            <div class="panel-group" id="accordion">
                                @if(isset($itinerarys))
                                @foreach($itinerarys as $key=> $itinerary)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <!--<h4 class="panel-title">-->
                                        <h4 class="accordion-toggle" type="button" data-toggle="collapse" data-target="#day1{{$key}}" aria-expanded="true" aria-controls="day1{{$key}}">Day {{$key + 1}}</h4>
                                        <!--</h4>-->
                                    </div>
                                    <div id="day1{{$key}}" class="panel-collapse collapse {{$key == 0 ? 'in' : ''}}">
                                        <div class="panel-body {{$key == 0 ? 'showaccordion' : ''}} ">
                                            <h3>{{$itinerary->title}}</h3>
                                            <div class="tags">
                                                @foreach (explode(',', $itinerary->tags) as $tag)
                                                <span>{{ $tag }}</span>
                                                @endforeach
                                            </div>
                                            {!!$itinerary->description ?? ''!!}
                                            @if (isset($itinerary_media))
                                            <div class="slider_itinerary">
                                                @foreach($itinerary_media as $med)
                                                @if($itinerary->id==$med->reference_id)
                                                <div class="col-sm-4">
                                                    @if ($med->image != null)
                                                    @php $image = '/'.$med->image @endphp
                                                    @else
                                                    @php $image = 'galleryimage.png' @endphp
                                                    @endif
                                                    <img src="{{ asset('images/media'. $image) }}">
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </section>
                    </div>


                    <div id="hotels" class="inner_box_fixed_tab" style="min-height: auto;">
                        <div class="hotel_tab_info">
                            <h4>Hotels</h4>
                            <p>Note: Our agents will provide you these or similar hotels depending on availability</p>
                        </div>
                        <div class="clear"></div>
                        @if (isset($hotels))
                        <!--<div class="panel-group" id="accordion0">-->
                        <div class="accordion panel-group" id="accordionExample">
                            @foreach ($hotels as $key=> $hotel)
                            @if(in_array($hotel->hotel_id,json_decode($single_package->hotel_id)))


                            <div class="card">
                                <div class="card-header" id="headingOne">

                                    <!--<h2 class="mb-0 panel-title">-->

                                    <h4 class="accordion-toggle p-0 {{$key != 0 ? 'collapsed' : ''}}" type="button" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne{{$key}}">
                                        Days {{$key + 1}}
                                    </h4>
                                    <!--</h2>-->
                                </div>

                                <div id="collapseOne{{$key}}" class="collapse {{$key != 0 ? '' : 'in'}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                @if ($hotel->image != null)
                                                @php $image = '/'.$hotel->image @endphp
                                                @else
                                                @php $image = 'galleryimage.png' @endphp
                                                @endif
                                                <img src="{{ asset('images/media'. $image) }}">
                                            </div>
                                            <div class="col-sm-6">
                                                    @for ($x = (int)$hotel->hotel_type; $x <= 4; $x++) <i class="fa fa-star text-muted" aria-hidden="true"></i>
                                                        @endfor
                                                        {{-- <span><input type="radio" checked> <label>{{$hotel->hotel_type}} Star</label></span>--}}
                                                        <h3 style="margin: 8px 0px;">{{$hotel->title ?? ''}}</h3>
                                                        <p>{{$hotel->description ?? ''}}</p>
                                                        <div class="review_hotel d-none">
                                                            <img src="{{asset('images/icon_hotel_s.png')}}"> <span class="numbers_htoels_rating">24</span>
                                                        </div>
                                                @for ($x = 1; $x <= (int)$hotel->hotel_type; $x++)
                                                    <i class="fa fa-star select-rating" aria-hidden="true"></i>
                                                    @endfor
                                                    <div class="clearfix"></div>

                                                        <ul class="css-18g8ve5">
                                                            @foreach (explode(',', $hotel->tags) as $tag)
                                                            <li>{{ $tag ?? '' }}</li>
                                                            @endforeach
                                                        </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            @endif
                            <hr>
                            @endforeach
                        </div>

                        @endif
                    </div>
                    <section class="sec section safe_holidays ">
                        <div class="container-inner">

                            <h4 class="common">Our Commitment to Safe Holidays</h4>
                            <p class="common2">We are actively maintaining the safety measures for providing you a risk
                                free
                                vacation.</p>
                            <div class="row safe_holidays_slider">
                                @if(isset($holidays))
                                @foreach($holidays as $holiday)
                                <div class="col-sm-3">
                                    @if ($holiday->image != null)
                                    @php $image = $holiday->image @endphp
                                    @else
                                    @php $image = 'galleryimage.png' @endphp
                                    @endif
                                    <img src="{{asset('images/media'.'/'.$image)}}">
                                    <h5>{{$holiday->title ?? ''}}</h5>
                                    <p>{!! $holiday->description ?? '' !!}</p>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </section>
                    <div id="inclusions" class="inner_box_fixed_tab">


                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Inclusions</a></li>
                            <li><a data-toggle="tab" href="#menu1">Exclusions</a></li>

                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">


                                <ul>
                                    @if(isset($inclusion) && $inclusion != null)
                                    @foreach($inclusion as $inclues)
                                    <li>{{$inclues->title ?? ''}}</li>
                                    @endforeach
                                    @else

                                        No Inclusion
                                    @endif
                                </ul>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <ul>
                                    @if(isset($exclusion) && $exclusion != null)
                                    @foreach($exclusion as $exclus)
                                    <li>{{$exclus->title ?? ''}}</li>
                                    @endforeach
                                    @else

                                        No Exclusion
                                    @endif
                                </ul>
                            </div>

                        </div>


                    </div>
                </div>
                <div class="col-sm-5 z-n9">
                    <div class="expert_form ">
                        @include('Frontend/snippets/form-modal')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="sec section sec_faq_detialed">
        <div class="container-inner">
            @if(isset($faqs))
            <div class="col-sm-7">
                <div id="faq" class="">
                    <div class="faq_sec">
                        <h4><!--{{$faqs[0]->title}}--> FAQ's</h4>
                        <div class="panel-group" id="accordion">

                            @foreach($faqs as $key => $faq)

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <!--<h4 class="panel-title">-->
                                    <h4 class="accordion-toggle panel-title" data-toggle="collapse" data-target="#accordion{{$key}}" aria-expanded="true" aria-controls="accordion{{$key}}">
                                        {{ $faq->faqs_question ?? ''}}
                                    </h4>
                                    <!--</h4>-->
                                </div>
                                <div id="accordion{{$key}}" class="panel-collapse collapse {{$key != 0 ? '' : 'in'}}" data-parent="#accordion">
                                    <div class="panel-body">
                                        {{ $faq->faqs_answer ?? ''}}
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-sm-7"></div>
            @endif
            <div class="col-sm-5">
                <div class="how_it_works text-center inner_box_fixed_tab">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{asset('images/icon1.png')}}">
                            <strong>650+</strong>
                            Verified Agents
                        </div>
                        <div class="col-sm-4">
                            <img src="{{asset('images/icon4.png')}}">
                            <strong>DopamineTravel</strong>
                            Verified
                        </div>
                        <div class="col-sm-4">
                            <img src="{{asset('images/icon5.png')}}">
                            <strong>Stringent</strong>
                            Quality Control
                        </div>
                    </div>
                </div>
                <div class="how_it_works how_it_works2 text-center inner_box_fixed_tab">
                    <h3>How It Works</h3>

                    <div class="row">
                        <div class="col-sm-1">
                            <div class="how_it_work_num">1</div>
                        </div>
                        <div class="col-sm-11 text-left">
                            <strong>Personalise This Package</strong>
                            Make changes as per your travel plan & submit the request.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="how_it_work_num">2</div>
                        </div>
                        <div class="col-sm-11 text-left">

                            <strong>Get Multiple Quotes</strong>
                            Connect with top 3 agents, compare quotes & customize further.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="how_it_work_num">3</div>
                        </div>
                        <div class="col-sm-11 text-left">

                            <strong>Book The Best Deal</strong>
                            Pay in easy installments & get ready to enjoy your holiday.
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="clear"></div>
    </section>
    @if (isset($similarPackage))
    <section class="sec section similar_packages bg-white">
        <div class="px-h">
            <div class="container-inner">
                <h4>Similar Packages</h4>
                <div class=" slider_red_price row">

                    @foreach ($similarPackage as $pack)
                    <div class="col-sm-4">
                        <div class="red_slide_image">
                            @if ($pack->image != null)
                            @php $image = '/'.$pack->image @endphp
                            @else
                            @php $image = 'galleryimage.png' @endphp
                            @endif
                            <img src="{{ asset('images/media' . '/' . $image) }}"><a class="see-details-button absolute-center" href="{{ url(app()->getLocale().'/packages',$pack->slug) }}">View
                                Details</a>
                            <div class="slide_text_pkg txt">{{$pack->title ?? ''}}</div>
                        </div>
                        <div class="similar_packages_inner_slider">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title_red_slider">
                                        <div class="title_red_slider">
                                            <span>{{$translate =App\Helpers\Menus::Translator(135)}}:
                                                @if($pack->city != null)
                                                @foreach(App\Helpers\DefaultLanguage::GetCity($pack->city) as $key=>$city)
                                                {{$city}}
                                                ({{count(App\Helpers\DefaultLanguage::GetCity($pack->city))-$key}}
                                                D)
                                                @endforeach
                                                @endif</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 nopad">
                                        <div class="price_red_slider text-left">{{$pack->maximum_days ?? ''}}
                                            Days
                                            & {{$pack->maximum_days - 1 ?? ''}}
                                            Nights <span> |
                                                @if($pack->hotel_id != null)
                                                {{-- @foreach(App\Helpers\DefaultLanguage::OnlyHotel($pack->hotel_id) as $hotel)--}}
                                                {{-- <input name="Similar_Packages_hotel_star_input"--}}
                                                {{-- type="radio"--}}
                                                {{-- class="radio-common-circle"--}}
                                                {{-- id="Similar Packages_input_53852_53852"--}}
                                                {{-- value="2 star"--}}
                                                {{-- checked="">--}}
                                                <label class="pt0" for="Similar_Packages_input">{{App\Helpers\DefaultLanguage::OnlyHotel($pack->hotel_id)}}</label> </span>
                                            {{-- @endforeach--}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 ">
                                    <!-- <p class="starting_from">{{$translate =App\Helpers\Menus::Translator(126)}}:</p>
                                <span class="off_percent">25% Off</span> -->
                                </div>
                                <div class="row hotel_row_brief text-center">
                                    @if(isset($similar_activity))
                                    @foreach($similar_activity[0] as $activity)
                                    @if ($activity->image != null)
                                    @php $image = '/'.$activity->image @endphp
                                    @else
                                    @php $image = 'galleryimage.png' @endphp
                                    @endif
                                    <div class="col-sm-3 text-center"><img src="{{ asset('images/media' . '/' . $image) }}">
                                        <span>{{$activity->title ?? ''}}</span>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <section class="bg-white">
        <div class="px-h">
            <div class="container-inner">
                <div class="row m-0" style="width: 100%">
                    @auth
                    <button class="accordion is-open ">Write a Reviews</button>
                    <div class="accordion-content" style=" margin-bottom:20px;">
                        <form action="{{ url('reviews') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $single_package->id }}">
                            <div class="header">
                                <div class="row">

                                    <div class=" my-md-auto my-2">
                                        <div class="form-floating mb-3">
                                            <label for="name" class="form-label">Name:</label>
                                            <input type="text" class="form-control form-control shadow-none" id="name_field" name="name" value="{{ old('name') }}" required placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="my-md-auto my-2">
                                        <div class="form-floating mb-3">
                                            <label for="name" class="form-label">Email:</label>
                                            <input type="email" class="form-control form-control shadow-none" id="email_field" name="email" value="{{ old('email') }}" required placeholder="Email">
                                        </div>
                                    </div>
                                    <div class=" col-12 mb-md-4 my-2">
                                        <div class="form-floating">
                                            <label for="message" class="form-label">Comment:</label>
                                            <textarea class="form-control form-control shadow-none" placeholder="Leave a Comment here" name="comment" id="comment_area" style="height: 100px" required>{{ old('comment') }}</textarea>
                                            <label for="comment_area">Leave a Comment
                                                here</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 my-md-auto my-2 my-auto ps-0">
                                        <div class="form-line">

                                            <section class='rating-widget'>

                                                <!-- Rating Stars Box -->
                                                <div class='rating-stars text-left'>
                                                    <ul class="d-flex list-unstyled" id='stars'>
                                                        <li class='star' title='Poor' data-value='1'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='Fair' data-value='2'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='Good' data-value='3'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='Excellent' data-value='4'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='WOW!!!' data-value='5'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <input class="rating" type="hidden" name="rating" value="1">
                                            </section>

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end my-md-auto text-end my-2 buy-cart">
                                        <button class="btn btn-primary w-50  border-0 buy ms-auto">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endauth
                    @guest
                    <a href="{{url(app()->getLocale().'/login') }}">
                        <button class="accordion">Write a Reviews</button>
                    </a>
                    @endguest
                </div>
            </div>
            @if ($single_package->select_package === 1)
            <div class="container-inner">
                <button class="accordion  is-open" id="inquirenow">Inquire Now</button>
                <div class="accordion-content" style="padding-inline:6px;">
                    <form action="{{url('enquire-now')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $single_package->id }}">
                        <div class="">
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter Name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message:</label>
                                <textarea type="text" name="message" id="message" class="ckeditor form-control choices" cols="30" rows="10">{{ old('message') }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </section>
    <section class="px-h sec section sec_darjeeling_pkg_by_city bg-white">

        <div class="container-inner">
            <h4>{{$single_package->title ?? ''}} City Names</h4>
            <div class="row">
                <div class="col-sm-12">
                    @if(isset($citys))
                    @foreach($citys as $key=>$city)
                    <a class="f14 fw7" href="#">{{$city->title ?? ''}}</a>
                    @endforeach
                    @endif
                </div>
                <div class="col-sm-12">
                    <hr>
                </div>
            </div>
        </div>

    </section>

    <div class="px-h">
        <div class="container-inner fancy_gallery" id="images_gallery">
            <h4>Image Gallery</h4>
            <div class="row">
                @foreach($media as $images)
                @if(isset($images->image))
                <div class="col-sm-4 card">
                    <div class="card-image">
                        <a href="{{asset('images/media/'.$images->image)}}" data-fancybox="gallery" data-caption="{{$images->caption ?? ''}}">
                            <img src="{{asset('images/media/'.$images->image)}}" alt="Image Gallery">
                        </a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        <div class="container-inner video_gallery" id="video_gallery">
            <h4>Video Gallery</h4>
            <div class="row">
                <div class="card-deck col-9">
                    @if(isset($gallery))
                    @foreach ($gallery as $video)
                    @if($video->video_link)
                    <div class="card col-sm-4">
                        <a data-fancybox data-small-btn="true" href="{{$video->video_link ?? ''}}">
                            <img class="card-img-top img-fluid" src="{{ asset('images/media/video-black.jpg')}}" />
                        </a>
                    </div>
                    @else
                    <div class="card col-sm-4">
                        No Video Found
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div id="quotesmyModal" class="popup">
        <div class="popup-content">
            <div class=" quotesclose-div">

                <img src="{{asset('images/dopamine/sa.svg#CloseWhite-usage')}}  " class=" quotesclose" alt="">
            </div>

            <!-- <span class="quotesclose">&times;</span> -->
            <div class="popup-clearfix">
                <h4 class="location_heading ">How It Works</h4>
                <div class="textes">
                    <ul>
                        <li>
                            <span class="round-bullets ">1</span>
                            <p>Tell us details of your holiday plan.</p>
                        </li>
                        <li>
                            <span class="round-bullets">2</span>
                            <p>Get multiple quotes from expert agents, compare &amp; customize further.</p>
                        </li>
                        <li>
                            <span class="round-bullets ">3</span>
                            <p>Select &amp; book best deal.</p>
                        </li>
                    </ul>
                </div>
                <div class="box3">
                    <div class="card">
                        <img src="{{asset('images/dopamine/sa.svg#IllusAgent-usage')}}  " class="svg" alt="">
                        <div class="how-it-img">
                            <h4 class="card-text">650+</h4>
                            <p class="para">Verified Agents</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{asset('images/dopamine/na.svg#IllusMoneySafe-usage')}} " class="svg" alt="">
                        <div class="how-it-img">
                            <h4 class="card-text">Dopamine Travel</h4>
                            <p class="para">Verified</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{asset('images/dopamine/na.svg#IllusQualityCheck-usage')}}" class="svg" alt="">
                        <div class="how-it-img">
                            <h4 class="card-text">Stringent</h4>
                            <p class="para">Quality Control</p>
                        </div>
                    </div>
                </div>
                <hr class="bb">

                <div class="call-detail">
                    <span class="icon">
                        <img src="WhatsApp Image 2023-05-13 at 1.45.31 AM (1).jpeg" class="icon" alt="">
                    </span>
                    <span class="para">Call Us for details</span>
                </div>
                <h3 class="location_heading">
                    1800-123-5555</h3>
                <p class="text-center ">650+ Agents | 40 Lac+ Travelers | 65+ Destinations</p>


            </div>
            <div class="form-popup">
                @include('Frontend/snippets/form-package')

            </div>


        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#month-dd').on('change', function() {
                var idMonth = this.value;
                var currency = $('#currency').val();
                var money = $('#money').val();
                $.ajax({
                    url: "{{url('package/months')}}",
                    type: "GET",
                    data: {
                        month_id: idMonth,
                        currency_id: currency,
                        money_id: money,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $(".paisa").html('');
                        // console.log(result.money);
                        $(".paisa").html('<p class="pricing_hotel"><strong>' + result.currency + ' ' + result.prices[0] * result.money + '</strong></p>');
                    }
                });
            });
        });
    </script>
    <script>
        //   var picker = new Pikaday({
        //     field: document.getElementById('datepicker')
        // });
        const accordionBtns = document.querySelectorAll(".accordion");

        accordionBtns.forEach((accordion) => {
            accordion.onclick = function() {
                this.classList.toggle("is-open");

                let content = this.nextElementSibling;
                console.log(content);

                if (content.style.maxHeight) {
                    //this is if the accordion is open
                    content.style.maxHeight = null;

                } else {
                    //if the accordion is currently closed
                    content.style.maxHeight = content.scrollHeight + "px";
                    console.log(content.style.maxHeight);
                }
            };
        });
    </script>
    <script>
        $('#stars li').on('mouseover', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function() {
            $(this).parent().children('li.star').each(function(e) {
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('#stars li>i').on('click', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            console.log(onStar)
            var stars = $(this).parent().children('li.star>i');
            console.log(stars)

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li>i.selected').last().data('value'), 10);
            $('.rating').val(ratingValue);
            // var msg = "";
            // if (ratingValue > 1) {
            //     msg = "Thanks! You rated this " + ratingValue + " stars.";
            // }
            // else {
            //     msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            // }
            // responseMessage(msg);
        });
    </script>
    <script>
        $('.readmore-btn').on('click', function() {
            $(this).parents('.contentboxtoggle').find('.read-more-target-2').toggleClass('show-content-2');
            var button = document.getElementById("readMoreButton");
            if (document.querySelector(".read-more-target-2").classList.contains("show-content-2")) {
                button.innerHTML = "Read Less";
            } else {
                button.innerHTML = "{{$translate =App\Helpers\Menus::Translator(111)}}";
            }
        });

        function toggleContent() {
            var contentText = document.querySelector(".read-more-target");
            contentText.classList.toggle("show-content");

            var button = document.getElementById("readMoreButton");
            if (contentText.classList.contains("show-content")) {
                button.innerHTML = "Read Less";
            } else {
                button.innerHTML = "{{$translate =App\Helpers\Menus::Translator(111)}}";
            }
        }


        $(".panel-heading").on('click', function() {
            // $(this).parents('.panel-default').find(".panel-body").toggleClass('showaccordion');
            // $(this).parents('.panel-default').siblings().find(".showaccordion").removeClass('showaccordion');
            // // $(this).parents('.panel-default').find(".panel-heading").toggleClass('active');
            // $(this).parents('.panel-default').siblings().find(".active").removeClass('active');
        });
        $('.inquirenowbtn').on('click', function() {
            $('#inquirenow').click()
        })
        $('#inquirenow').on('click', function() {
            console.log("hellomjjn");
        })
    </script>
    @endsection
