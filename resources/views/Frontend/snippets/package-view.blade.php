<div class="total_records product-grid">{{$translate =App\Helpers\Menus::Translator(130)}}
    <span>{{$package->total() ?? ''}}</span>
    Tour Packages
{{--    @if (isset($slug) != null)--}}
{{--    {{$slug}}--}}
{{--    @else--}}
{{--    {{isset($slug) != null ? $slug : 'Tour Packages'}}--}}
{{--    @endif--}}

</div>
{{--<div class="total_records">{{$single->title ?? 'Tour Packages'}} </div>--}}
<div class="select_order_by pull-right">
    <select class="submit-form-sort ">
        <option disabled>Select Sort</option>
        <option value="popularity" {{isset($_GET['sort']) && $_GET['sort'] == 'popularity' ? 'selected' : ''}}>
            Popularity
        </option>
        <option value="price_low_to_high" {{isset($_GET['sort']) && $_GET['sort'] == 'price_low_to_high' ? 'selected' : ''}}>
            Price: Low to High
        </option>
        <option value="price_high_to_low" {{isset($_GET['sort']) && $_GET['sort'] == 'price_high_to_low' ? 'selected' : ''}}>
            Price: High to Low
        </option>
        <option value="duration_low_to_high" {{isset($_GET['sort']) && $_GET['sort'] == 'duration_low_to_high' ? 'selected' : ''}}>
            Duration: Low to High
        </option>
        <option value="duration_high_to_low" {{isset($_GET['sort']) && $_GET['sort'] == 'duration_high_to_low' ? 'selected' : ''}}>
            Duration: High to Low
        </option>
    </select>
</div>
<style>
    .will-book {
        flex-wrap: wrap;
    }

    .mt-3 {
        margin-top: 1rem !important;
    }

    .col-6 {
        width: 50%;
    }

    .adultinfant>div {
        padding: 5px;
    }

    .d-none {
        display: none;
    }

    .outline-0 {
        outline: none;
    }

    .mt-5 {
        margin-top: 3rem !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-80 {
        width: 80%;
    }

    .w-20 {
        width: 20%;
    }

    #regForm {
        background-color: #ffffff;
        margin-inline: auto;
        font-family: Raleway;
        /* padding: 40px; */
        width: 90%;
        min-width: 300px;
    }

    .form-head {
        text-align: center;
    }

    .form-head h4 {
        color: #009688;
        font-weight: bold;
    }

    .form-head img {
        width: 200px;
    }


    .tab p {
        display: flex;
        border: 1px solid black;
        padding-left: 5px;
    }

    .tab p input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
        border: none;
    }

    .tab p input:focus-visible {

        outline: none;
    }

    .tab .selectdiv input:focus-visible {

        outline: none;
    }

    /* Mark input boxes that gets an error on validation: */
    /* input.invalid {
        background-color: #ffdddd;
    } */

    /* Hide all steps by default: */
    .tab {
        display: none;
    }

    .read-more-target-2 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        /* Adjust the height to control the number of visible lines */
        /* line-height: 1.25em; Adjust the line height for proper spacing */
    }

    .show-content-2 {
        -webkit-line-clamp: unset;
    }

    /* #nextBtn {
        background-color: #04AA6D;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
    } */
    .nextbtn-popup:hover {
        background: transparent;
        color: #E6542D;
    }

    .nextbtn-popup {
        padding: 10px 20px;
        color: white;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
        background: #E6542D;
        height: 48px;
        opacity: 1;
        border: 1px solid #E6542D;
    }

    .prevbtn-popup {
        padding: 10px 20px;
        color: white;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
        background: #E6542D;
        height: 48px;
        opacity: 1;
        border: 1px solid #E6542D;
    }

    .backbtn-popup {
        padding: 10px 20px;
        color: #E6542D;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
        background: transparent;
        height: 48px;
        opacity: 1;
        border: 1px solid #E6542D;
    }

    /* #prevBtn {
        background-color: #04AA6D;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
    } */

    button:hover {
        opacity: 0.8;
    }


    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: none;
        opacity: 0.5;

    }

    .border-0 {
        border: none !important;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #04AA6D;
    }

    .tab p label img {
        width: 25px;
        height: 25px;
    }

    .tab p label {
        margin-top: auto;
        margin-bottom: auto;
        width: 30px;
        height: 25px;
    }

    .tab .selectdiv {
        display: flex;
        justify-content: space-between;
    }

    .tab .selectdiv input {
        width: 80%;
    }

    .tab b span {
        font-weight: normal;
        font-size: smaller;
    }

    .col-4 {
        width: 33.33333333%;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .date-btn>div {
        /* background: #009688; */
        padding: 10px;
        margin: 5px;
        color: white;
        text-align: center;
        font-weight: bold;
    }

    .book-btn label {
        background: #b2b2b2;
        padding-block: 10px;
        margin: 5px;
        color: white;
        text-align: center;
        font-weight: bold;
        width: 98%;
    }

    .book-btn.selected label {
        background: #20a397;

    }

    .p-0 {
        padding: 0px !important;
    }

    .m-0 {
        margin: 0px !important;
    }
</style>
<style>
    .z-n1 {
        z-index: 1;
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
        width: 30px !important;
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


    /* p {
        justify-content: center;
        display: flex;
    } */
</style>
<div class="category_box  w-100">
    @if(count($package) != 0)
    @foreach ($package as $packag)
{{--        @dd($packag,'aa')--}}
    <input type="hidden" class="hiddenid" id="hidden_id" value="{{$packag->id}}">
    <div class="col-sm-4 nopad">
        @if (isset($packag->image))
        <img src="{{ asset('images/media/' . $packag->image) }}">
        @else
        <img src="{{ asset('images/galleryimage.png') }}">
        @endif
    </div>
    <div class="col-sm-4">
        <h3><a href="{{url(app()->getLocale().'/packages',$packag->slug) }}">{{$packag->title}}</a>
        </h3>
        <div class="duration_cat">{{ $packag->maximum_days }} Days
            &  {{ $packag->maximum_days - 1 }}  Nights
            <span>| {{$translate =App\Helpers\Menus::Translator(133)}} </span>
        </div>
        <div class="strating_from">{{$translate =App\Helpers\Menus::Translator(126)}}:
            <?php
            if ($packag->compare_price == null) {
                $packagcompare = 1;
            } else {
                $packagcompare = $packag->compare_price;
            }
            ?>
            @if( $packag->discount_price != null)
            <span>{{ number_format((($packag->compare_price - $packag->discount_price) / $packagcompare) * 100) }}%
                Off</span>
            @endif
        </div>
        @if( $packag->discount_price != null)
        <div class="pirce_cate">{{$currency->currency_symbol}} {{$packag->discount_price * $currency->currency_rate}}
            /-
            <span>{{$currency->currency_symbol}} {{$packag->compare_price * $currency->currency_rate}}/-</span>
        </div>
        @else
        <div class="pirce_cate">
            {{$currency->currency_symbol}} {{$packag->compare_price * $currency->currency_rate}}
        </div>
        @endif
        <div class="small_text">Per Person on twin sharing</div>
        <div class="pkg_include"><span>{{$translate =App\Helpers\Menus::Translator(134)}}:</span>
            @if($packag->hotel_id != null)
            @foreach(App\Helpers\DefaultLanguage::GetHotel($packag->hotel_id) as $hotel)
            <div class="input_pkg"><input checked type="radio" name="pkg_include"><label>{{$hotel}}
                    Star</label>
            </div>
            @endforeach
            @endif
        </div>
        <div class="cate_cities">{{$translate =App\Helpers\Menus::Translator(135)}}: @if($packag->city != null)
            @foreach(App\Helpers\DefaultLanguage::GetCity($packag->city) as $key=>$city)
            {{$city}} ({{count(App\Helpers\DefaultLanguage::GetCity($packag->city))-$key}}D)
            @endforeach
            @endif
        </div>
    </div>
    <div class="col-sm-4 d-none">
        <div class="tage_cate">
            @foreach (explode(',', $packag->tags) as $tag)
            <span>{{ $tag }}</span>
            @endforeach
        </div>
        <div class="pkg_info d-none">Explore the scenic beauty of Kashmir, with this 4 nights 5 days
            Kashmir package....
        </div>
    </div>
    <hr>
    <div class="bottom_btns">
        <div>
            <a class="enquire-btn" href="{{ url(app()->getLocale().'/packages',$packag->slug) }}">
                <div class="view_details" style="color:white; padding-top: 0">{{$translate =App\Helpers\Menus::Translator(131)}}</div>
            </a>

        </div>
        <a href="#" data-id="{{$packag->id}}" class="customize_get_a_quote quotesBtn">{{$translate =App\Helpers\Menus::Translator(132)}}</a>
    </div>
    @endforeach
    <div class="pagination">
       
        @if($package->total()>= 6)
        @if($package->lastPage() >= 1)
        <span class="prev submit-form paginatebtn {{ $package->currentPage() == 1 ? 'active' : '' }}" id="prev" data-url="{{ $package->url(1) }}"> <i class="fa fa-chevron-left"></i> </span>

        @for ($i = 1; $i <= $package->lastPage(); $i++)
            <a data-url="{{ $package->url($i) }}" class="submit-form paginatebtn {{ $package->currentPage() == $i ? 'active' : '' }} pag-num">{{ $i }}</a>
            @endfor
            <span class="next submit-form paginatebtn {{ $package->currentPage() == $package->lastPage() ? 'active' : '' }}" id="next" data-url="{{ $package->url($package->currentPage() + 1) }}"> <i class="fa fa-chevron-right"></i> </span>
            @endif
            @endif

    </div>
    @else
    <div class="story">
        <div class="p64">
            <div class="error-mesg text-center"><span class="css-17i6t2c">
            <img src="{{asset('images/dopamine/collection.jpeg')}} " class="svg" alt="" style="object-fit: contain;">
            </span>
                <h3 class="pfc3 f32 fwb mt15 css-idm3bz">Your Requirements are unique!</h3>
                <p class="f16 pfc1 fw7 mb15">Our experts would love to create a package just
                    for you.</p>
                <div>
                    <div class="block wfull">

                        <button class="btn-filled-pri-large radius2 text-capitalize ripple css-5rbfaa quotesBtn">
                            <span class="wave"></span>Build your own package
                        </button>


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
                            <h4 class="card-text">Traveltriangle</h4>
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
        {{--<div class="story">--}}
        {{-- <div class="p64">--}}
        {{-- <div class="error-mesg text-center"><span class="css-17i6t2c"><svg viewBox="0 0 297.53 313.44" class="icon shape-codepen plpIcon">--}}
        {{-- <use xlink:href="/travel/v3/public/travel/plpIcon-icons-svg-d2d896fee69370824ae26d4a560abac1.svg#Uniquerequirements-usage"></use>--}}
        {{-- </svg></span>--}}
        {{-- <h3 class="pfc3 f32 fwb mt15 css-idm3bz">Your Requirements are unique!</h3>--}}
        {{-- <p class="f16 pfc1 fw7 mb15">Our experts would love to create a package just for you.</p>--}}
        {{-- <div>--}}
        {{-- <div class="block wfull">--}}
        {{-- <button id="quotesBtn"  class="btn-filled-pri-large radius2 text-capitalize ripple css-5rbfaa"><span class="wave"></span>Build your own package--}}
        {{-- </button>--}}
        {{-- </div>--}}
        {{-- </div>--}}
        {{-- </div>--}}
        {{-- </div>--}}
        {{-- <div id="quotesmyModal" class="popup">--}}
        {{-- <div class="popup-content">--}}
        {{-- <div class=" quotesclose-div">--}}

        {{-- <img src="{{asset('images/dopamine/sa.svg#CloseWhite-usage')}} " class=" quotesclose" alt="">--}}
        {{-- </div>--}}

        {{-- <!-- <span class="quotesclose">&times;</span> -->--}}
        {{-- <div class="popup-clearfix">--}}
        {{-- <h4 class="location_heading ">How It Works</h4>--}}
        {{-- <div class="textes">--}}
        {{-- <ul>--}}
        {{-- <li>--}}
        {{-- <span class="round-bullets ">1</span>--}}
        {{-- <p>Tell us details of your holiday plan.</p>--}}
        {{-- </li>--}}
        {{-- <li>--}}
        {{-- <span class="round-bullets">2</span>--}}
        {{-- <p>Get multiple quotes from expert agents, compare &amp; customize further.</p>--}}
        {{-- </li>--}}
        {{-- <li>--}}
        {{-- <span class="round-bullets ">3</span>--}}
        {{-- <p>Select &amp; book best deal.</p>--}}
        {{-- </li>--}}
        {{-- </ul>--}}
        {{-- </div>--}}
        {{-- <div class="box3">--}}
        {{-- <div class="card">--}}
        {{-- <img src="{{asset('images/dopamine/sa.svg#IllusAgent-usage')}} " class="svg" alt="">--}}
        {{-- <div class="how-it-img">--}}
        {{-- <h4 class="card-text">650+</h4>--}}
        {{-- <p class="para">Verified Agents</p>--}}
        {{-- </div>--}}
        {{-- </div>--}}
        {{-- <div class="card">--}}
        {{-- <img src="{{asset('images/dopamine/na.svg#IllusMoneySafe-usage')}} " class="svg" alt="">--}}
        {{-- <div class="how-it-img">--}}
        {{-- <h4 class="card-text">Traveltriangle</h4>--}}
        {{-- <p class="para">Verified</p>--}}
        {{-- </div>--}}
        {{-- </div>--}}
        {{-- <div class="card">--}}
        {{-- <img src="{{asset('images/dopamine/na.svg#IllusQualityCheck-usage')}}" class="svg" alt="">--}}
        {{-- <div class="how-it-img">--}}
        {{-- <h4 class="card-text">Stringent</h4>--}}
        {{-- <p class="para">Quality Control</p>--}}
        {{-- </div>--}}
        {{-- </div>--}}
        {{-- </div>--}}
        {{-- <hr class="bb">--}}

        {{-- <div class="call-detail">--}}
        {{-- <span class="icon">--}}
        {{-- <img src="WhatsApp Image 2023-05-13 at 1.45.31 AM (1).jpeg" class="icon" alt="">--}}
        {{-- </span>--}}
        {{-- <span class="para">Call Us for details</span>--}}
        {{-- </div>--}}
        {{-- <h3 class="location_heading">--}}
        {{-- 1800-123-5555</h3>--}}
        {{-- <p class="text-center ">650+ Agents | 40 Lac+ Travelers | 65+ Destinations</p>--}}


        {{-- </div>--}}
        {{-- <div class="form-popup">--}}
        {{-- @include('Frontend/snippets/form-package')--}}

        {{-- </div>--}}


        {{-- </div>--}}

        {{-- </div>--}}
        {{--</div>--}}
    @endif
</div>
<script>

</script>


{{--<script>--}}
{{-- // Get the modal--}}
{{-- var popup = document.getElementById("quotesmyModal");--}}

{{-- // Get the button that opens the modal--}}
{{-- var btn = document.getElementById("quotesBtn");--}}

{{-- // Get the <span> element that closes the modal--}}
{{-- var span = document.getElementsByClassName("quotesclose")[0];--}}

{{-- // When the user clicks on the button, open the modal--}}
{{-- btn.onclick = function() {--}}
{{-- popup.style.display = "flex";--}}
{{-- }--}}

{{-- // When the user clicks on the <span> (x), close the modal--}}
{{-- span.onclick = function() {--}}
{{-- popup.style.display = "none";--}}
{{-- }--}}

{{-- // When the user clicks anywhere outside of the modal, quotesclose it--}}
{{-- window.onclick = function(event) {--}}
{{-- if (event.target == popup) {--}}
{{-- popup.style.display = "none";--}}
{{-- }--}}
{{-- }--}}
{{-- // var picker = new Pikaday({--}}
{{-- //     field: document.getElementById('datepicker'),--}}
{{-- //     format: 'YYYY-MM-DD',--}}
{{-- //     position: 'bottom left'--}}
{{-- // });--}}
{{-- </script>--}}
