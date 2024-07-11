<style>
    .mb-0 {
        margin-bottom: 0px;
    }

    .mb-3 {
        margin-bottom: 2rem;
    }

    .my-3 {
        margin-block: 2rem;
    }

    input[name="yesnobtn2"] {
        margin-bottom: 0px !important;

    }

    input[name="yesnobtn2"]~label {
        padding-inline: 10px;
    }

    .dateerror {
        position: absolute;
        top: 100%;
        left: 10px;
    }

    .selectedDateContainerp {
        position: relative;
    }

    .mtc {
        margin-top: 20px;
    }

    .ui.popup.calendar {
        height: auto;
    }

    .maindatesec {
        width: 100%;
    }

    .position-relative {
        position: relative;
    }

    .calendarcss {
        position: absolute;
        width: 10px;
        height: 10px;
        top: 0;
        visibility: hidden;
    }

    .calendarcss>div {
        width: 10px;
        height: 10px;
    }

    .ui.calendar .ui.table tr:first-child th {
        background-color: #3cb3e4;
    }

    .ui.calendar .ui.table.day tr:first-child th {
        background-color: #3cb3e4;
    }

    .ui.calendar .ui.table.day tr:nth-child(2) th {
        background-color: #3cb3e4;
        border: 0;
    }
</style>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="https://rawgit.com/KidSysco/jquery-ui-month-picker/v3.0.0/demo/MonthPicker.min.css"> -->
<!-- <script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script> -->
<!-- <script src="{{ asset('/js/MonthPicker.min.js') }}"></script> -->
<form id="regFormpackage" method="post">
    <!-- One "tab" for each step in the form: -->
    <div class="tab tabpkg ">
        <div class="form-head">
            <img src="https://pmediaweb.com/dev/dopaminetravel/public/travel/images/form_map_icon.png" alt="">
            <h4>{{$translate =App\Helpers\Menus::Translator(98)}}</h4>
        </div><b> {{$translate =App\Helpers\Menus::Translator(99)}}: </b>
        <p class="reqpackagediv"><label><img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#LocationMarkerIcon-usage" alt=""></label>
            <input class="reqpackage" placeholder="{{$translate =App\Helpers\Menus::Translator(99)}}" name="city_to">
        </p>
        <label class="fielderror">Enter Correct City Name</label>
        <div class="checkbox-row">
            <input class="wait" type="checkbox" id="exploringp">
            <label for="exploringp">{{$translate =App\Helpers\Menus::Translator(100)}}</label>
        </div>
        <b> {{$translate =App\Helpers\Menus::Translator(101)}}: </b>
        <p><label for=""><img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#LocationMarkerIcon-usage" alt=""></label>
            <input placeholder="{{$translate =App\Helpers\Menus::Translator(101)}}" name="city_from">
        </p>

        <div class="d-flex">
            <b> {{$translate =App\Helpers\Menus::Translator(102)}}
                <span>{{$translate =App\Helpers\Menus::Translator(103)}}</span></b>
            <b id="dayheadingp">{{$translate =App\Helpers\Menus::Translator(129)}}</b>
        </div>
        <!-- <div class=" d-flex" id="date-btn-rowp">
            <div class="col-4 date-btn">
                <div>
                    <input type="text" id="date1p" name="fixed_date" class="d-none datePicker ">
                    <label class="date-btn-cln date1p " for="date1p">{{$translate =App\Helpers\Menus::Translator(104)}}</label>
                </div>
            </div>
            <div class="col-4 date-btn">
                <div>
                    <input type="text" id="date2p" name="flexible_date" class="d-none datePicker ">
                    <label class="date-btn-cln date2p " for="date2p">{{$translate =App\Helpers\Menus::Translator(105)}}</label>
                </div>
            </div>
            <div class="col-4 date-btn">
                <div>
                    <input type="checkbox" id="date3p" value="Anytime" name="date_anytime" class="d-none datePicker ">
                    <label class="date-btn-cln date3 " for="date3p">{{$translate =App\Helpers\Menus::Translator(106)}}</label>
                </div>
            </div>

        </div> -->
        <div class="date-btn-new-2">
            <div class=" date-btn">
                <div class="maindatesec d-flex">
                    <div class="col-4 position-relative">
                        <label for="date1p">{{$translate =App\Helpers\Menus::Translator(104)}}</label>
                        <div class="ui calendar calendarcss" id="example1">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" id="date1p" name="fixed_date" placeholder="Date">
                            </div>
                        </div>
                    </div>
                    <div class="col-4 position-relative">
                        <label for="date2p">{{$translate =App\Helpers\Menus::Translator(105)}}</label>
                        <div class="ui calendar calendarcss" id="example2">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" name="flexible_date" id="date2p" placeholder="Date">
                            </div>
                        </div>
                    </div>
                    <div class="col-4 date">
                        <input type="checkbox" value="Anytime" class="d-none" id="date3p" name="date_anytime">
                        <label for="date3p">{{$translate =App\Helpers\Menus::Translator(106)}}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="justify-content-between date-error selectedDateContainerp reqpackagediv" oninput="this.className = ''">


            <p class="newdatep m-0">
                <label><img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#CalendarIcon-usage" alt=""></label>
                <input type="text" readonly class="selectedDatep req">
                <span class="removeDateIconp" style="display:none; margin-block:auto; padding-right:10px">&#10006;</span>
            </p>
            <p class="daycounter" style="width: 40%;">
                <span class="minus">-</span>
                <input class="dayscounter" type="text" name="number_of_days" value="1" />
                <span class="plus">+</span>

            </p>
        </div>
        <label class="fielderror " for="">Select One Date-Type </label>
        <div class="checkbox-row mtc" id="bookticketsp">
            <input class="wait" type="checkbox" id="bookticketsssp" name="travel_ticket" value="booked">
            <label for="bookticketsssp">{{$translate =App\Helpers\Menus::Translator(107)}}</label>
        </div>
        <div class="submit mt-5"> <button class="w-100 nextbtn-popup" type="button" id="nextBtnpackage" onclick="nextPrevpackage(1)">{{$translate =App\Helpers\Menus::Translator(108)}}</button></div>
    </div>
    <div class="tab tabpkg">
        <div class="form-head">
            <img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#LandlineIcon-usage" alt="">
            <h4>How do we contact you?</h4>
        </div>
        <b> Email* </b>
        <p class="reqpackagediv"><Label><img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#ContactIcon-usage" alt=""></Label>
            <input type="email" id="emailvalid" class="reqpackage" placeholder="E-mail..." name="email">
        </p>
        <label class="fielderror">Enter Valid Email Id</label>
        <b>Phone No*</b>
        <div class="selectdiv">
            <select name="phone_code" id="">
                <option value=" +213"> (+213)</option>
                <option value=" +376"> (+376)</option>
                <option value=" +244"> (+244)</option>
                <option value=" +1264"> (+1264)</option>
                <option value=" +1268"> (+1268)</option>
                <option value=" +54"> (+54)</option>
                <option value=" +374"> (+374)</option>
                <option value=" +297"> (+297)</option>
                <option value=" +61"> (+61)</option>
                <option value=" +43"> (+43)</option>
                <option value=" +994"> (+994)</option>
                <option value=" +1242"> (+1242)</option>
                <option value=" +973"> (+973)</option>
                <option value=" +880"> (+880)</option>
                <option value=" +1246"> (+1246)</option>
                <option value=" +375"> (+375)</option>
                <option value=" +32"> (+32)</option>
                <option value=" +501"> (+501)</option>
                <option value=" +229"> (+229)</option>
                <option value=" +1441"> (+1441)</option>
                <option value=" +975"> (+975)</option>
                <option value=" +591"> (+591)</option>
                <option value=" +387"> (+387)</option>
                <option value=" +267"> (+267)</option>
                <option value=" +55"> (+55)</option>
                <option value=" +673"> (+673)</option>
                <option value=" +359"> (+359)</option>
                <option value=" +226"> (+226)</option>
                <option value=" +257"> (+257)</option>
                <option value=" +855"> (+855)</option>
                <option value=" +237"> (+237)</option>
                <option value=" +1"> (+1)</option>
                <option value=" +238"> (+238)</option>
                <option value=" +1345"> (+1345)</option>
                <option value=" +236"> (+236)</option>
                <option value=" +56"> (+56)</option>
                <option value=" +86"> (+86)</option>
                <option value=" +57"> (+57)</option>
                <option value=" +269"> (+269)</option>
                <option value=" +242"> (+242)</option>
                <option value=" +682"> (+682)</option>
                <option value=" +506"> (+506)</option>
                <option value=" +385"> (+385)</option>
                <option value=" +53"> (+53)</option>
                <option value=" +90392"> (+90392)</option>
                <option value=" +357"> (+357)</option>
                <option value=" +42"> (+42)</option>
                <option value=" +45"> (+45)</option>
                <option value=" +253"> (+253)</option>
                <option value=" +1809"> (+1809)</option>
                <option value=" +1809"> (+1809)</option>
                <option value=" +593"> (+593)</option>
                <option value=" +20"> (+20)</option>
                <option value=" +503"> (+503)</option>
                <option value=" +240"> (+240)</option>
                <option value=" +291"> (+291)</option>
                <option value=" +372"> (+372)</option>
                <option value=" +251"> (+251)</option>
                <option value=" +500"> (+500)</option>
                <option value=" +298"> (+298)</option>
                <option value=" +679"> (+679)</option>
                <option value=" +358"> (+358)</option>
                <option value=" +33"> (+33)</option>
                <option value=" +594"> (+594)</option>
                <option value=" +689"> (+689)</option>
                <option value=" +241"> (+241)</option>
                <option value=" +220"> (+220)</option>
                <option value=" +7880"> (+7880)</option>
                <option value=" +49"> (+49)</option>
                <option value=" +233"> (+233)</option>
                <option value=" +350"> (+350)</option>
                <option value=" +30"> (+30)</option>
                <option value=" +299"> (+299)</option>
                <option value=" +1473"> (+1473)</option>
                <option value=" +590"> (+590)</option>
                <option value=" +671"> (+671)</option>
                <option value=" +502"> (+502)</option>
                <option value=" +224"> (+224)</option>
                <option value=" +245"> (+245)</option>
                <option value=" +592"> (+592)</option>
                <option value=" +509"> (+509)</option>
                <option value=" +504"> (+504)</option>
                <option value=" +852"> (+852)</option>
                <option value=" +36"> (+36)</option>
                <option value=" +354"> (+354)</option>
                <option value=" +91"> (+91)</option>
                <option value=" +62"> (+62)</option>
                <option value=" +98"> (+98)</option>
                <option value=" +964"> (+964)</option>
                <option value=" +353"> (+353)</option>
                <option value=" +972"> (+972)</option>
                <option value=" +39"> (+39)</option>
                <option value=" +1876"> (+1876)</option>
                <option value=" +81"> (+81)</option>
                <option value=" +962"> (+962)</option>
                <option value=" +7"> (+7)</option>
                <option value=" +254"> (+254)</option>
                <option value=" +686"> (+686)</option>
                <option value=" +850"> (+850)</option>
                <option value=" +82"> (+82)</option>
                <option value=" +965"> (+965)</option>
                <option value=" +996"> (+996)</option>
                <option value=" +856"> (+856)</option>
                <option value=" +371"> (+371)</option>
                <option value=" +961"> (+961)</option>
                <option value=" +266"> (+266)</option>
                <option value=" +231"> (+231)</option>
                <option value=" +218"> (+218)</option>
                <option value=" +417"> (+417)</option>
                <option value=" +370"> (+370)</option>
                <option value=" +352"> (+352)</option>
                <option value=" +853"> (+853)</option>
                <option value=" +389"> (+389)</option>
                <option value=" +261"> (+261)</option>
                <option value=" +265"> (+265)</option>
                <option value=" +60"> (+60)</option>
                <option value=" +960"> (+960)</option>
                <option value=" +223"> (+223)</option>
                <option value=" +356"> (+356)</option>
                <option value=" +692"> (+692)</option>
                <option value=" +596"> (+596)</option>
                <option value=" +222"> (+222)</option>
                <option value=" +269"> (+269)</option>
                <option value=" +52"> (+52)</option>
                <option value=" +691"> (+691)</option>
                <option value=" +373"> (+373)</option>
                <option value=" +377"> (+377)</option>
                <option value=" +976"> (+976)</option>
                <option value=" +1664"> (+1664)</option>
                <option value=" +212"> (+212)</option>
                <option value=" +258"> (+258)</option>
                <option value=" +95"> (+95)</option>
                <option value=" +264"> (+264)</option>
                <option value=" +674"> (+674)</option>
                <option value=" +977"> (+977)</option>
                <option value=" +31"> (+31)</option>
                <option value=" +687"> (+687)</option>
                <option value=" +64"> (+64)</option>
                <option value=" +505"> (+505)</option>
                <option value=" +227"> (+227)</option>
                <option value=" +234"> (+234)</option>
                <option value=" +683"> (+683)</option>
                <option value=" +672"> (+672)</option>
                <option value=" +670"> (+670)</option>
                <option value=" +47"> (+47)</option>
                <option value=" +968"> (+968)</option>
                <option value=" +92">(+92)</option>
                <option value=" +680"> (+680)</option>
                <option value=" +507"> (+507)</option>
                <option value=" +675"> (+675)</option>
                <option value=" +595"> (+595)</option>
                <option value=" +51"> (+51)</option>
                <option value=" +63"> (+63)</option>
                <option value=" +48"> (+48)</option>
                <option value=" +351"> (+351)</option>
                <option value=" +1787"> (+1787)</option>
                <option value=" +974"> (+974)</option>
                <option value=" +262"> (+262)</option>
                <option value=" +40"> (+40)</option>
                <option value=" +7"> (+7)</option>
                <option value=" +250"> (+250)</option>
                <option value=" +378"> (+378)</option>
                <option value=" +239"> (+239)</option>
                <option value=" +966"> (+966)</option>
                <option value=" +221"> (+221)</option>
                <option value=" +381"> (+381)</option>
                <option value=" +248"> (+248)</option>
                <option value=" +232"> (+232)</option>
                <option value=" +65"> (+65)</option>
                <option value=" +421"> (+421)</option>
                <option value=" +386"> (+386)</option>
                <option value=" +677"> (+677)</option>
                <option value=" +252"> (+252)</option>
                <option value=" +27"> (+27)</option>
                <option value=" +34"> (+34)</option>
                <option value=" +94"> (+94)</option>
                <option value=" +290"> (+290)</option>
                <option value=" +1869"> (+1869)</option>
                <option value=" +1758"> (+1758)</option>
                <option value=" +249"> (+249)</option>
                <option value=" +597"> (+597)</option>
                <option value=" +268"> (+268)</option>
                <option value=" +46"> (+46)</option>
                <option value=" +41"> (+41)</option>
                <option value=" +963"> (+963)</option>
                <option value=" +886"> (+886)</option>
                <option value=" +7"> (+7)</option>
                <option value=" +66"> (+66)</option>
                <option value=" +228"> (+228)</option>
                <option value=" +676"> (+676)</option>
                <option value=" +1868"> (+1868)</option>
                <option value=" +216"> (+216)</option>
                <option value=" +90"> (+90)</option>
                <option value=" +7"> (+7)</option>
                <option value=" +993"> (+993)</option>
                <option value=" +1649">(+1649)</option>
                <option value=" +688"> (+688)</option>
                <option value=" +256"> (+256)</option>
                <option value=" +44"> (+44)</option>
                <option value=" +380"> (+380)</option>
                <option value=" +971"> (+971)</option>
                <option value=" +598"> (+598)</option>
                <option value=" +1"> (+1)</option>
                <option value=" +7"> (+7)</option>
                <option value=" +678"> (+678)</option>
                <option value=" +379"> (+379)</option>
                <option value=" +58"> (+58)</option>
                <option value=" +84"> (+84)</option>
                <option value=" +1284"> (+1284)</option>
                <option value=" +1340"> (+1340)</option>
                <option value=" +681"> (+681)</option>
                <option value=" +969">(+969)</option>
                <option value=" +967"> (+967)</option>
                <option value=" +260"> (+260)</option>
                <option value=" +263"> (+263)</option>
            </select>
            <input placeholder="Phone..." name="phone" type="number">
        </div>
        <div class="submit mt-5 d-flex">
            <button class="w-20 prevbtn-popup" type="button" id="prevBtnpackage" onclick="nextPrevpackage(-1)">
                < </button>
                    <button class="w-80 nextbtn-popup" type="button" id="nextBtnpackage" onclick="nextPrevpackage(1)">{{$translate =App\Helpers\Menus::Translator(108)}}</button>
        </div>


    </div>
    <div class="tab tabpkg mt-5">
        <div class="form-head">

            <h4>Where do you want to go?</h4>
        </div><b> Preferred Hotel Category <span>(Rating)</span>*</b>
        <div class="d-flex justify-content-between">
            <div class="checkbox-row">
                <input type="checkbox" id="5starp" name="rating" value="5Star">
                <label for="5starp">5 Star</label>
            </div>
            <div class="checkbox-row">
                <input type="checkbox" id="4starp" name="rating" value="4Star">
                <label for="4starp">4 Star</label>
            </div>
            <div class="checkbox-row">
                <input type="checkbox" id="3starp" name="rating" value="3Star">
                <label for="3starp">3 Star</label>
            </div>
            <div class="checkbox-row">
                <input type="checkbox" id="2starp" name="rating" value="2Star">
                <label for="2starp">2 Star</label>
            </div>
        </div>


        <hr class="m-0">
        <div class="d-flex yesnobtn my-3">
            <div>
                <p class="border-0 mb-0"><label class="p-0" for=""><img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#Flights-usage" alt=""></label>
                    <b class="p-0">Flights for local sightseeing?</b>

                </p>
            </div>

            <div class="d-flex my-auto">
                <div class="d-flex">
                    <input class="m-0" type="radio" name="yesnobtn" value="Budget With Airfare" id="yesbtnpp" checked>
                    </input>
                    <label class=" m-0 px-2h" for="yesbtnpp">YES</label>
                </div>
                <div class="d-flex">
                    <input class="m-0" type="radio" value="Budget Without Airfare" name="yesnobtn" id="nobtnpp">

                    </input>
                    <label class=" m-0 px-2h" for="nobtnpp">NO</label>
                </div>
            </div>
        </div>

        <hr class="m-0">

        <b> <b id="budget-star2"> Budget Without Airfare: </b> <span>( per person )</span> </b>
        <p><Label><img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#BudgetIcon-usage" alt=""></Label>
            <input class="wait" placeholder="Enter your budget value" name="budgetvalue">
        </p>
        <div class="d-flex adultinfant">
            <div class="col-4">
                <div>
                    <b> Adults <span> (12+ yrs)</span> </b>
                    <p><Label><img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#BudgetIcon-usage" alt=""></Label>
                        <select class="w-100 border-0 outline-0" name="adults_12_+" id="">
                            <option selected value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div>
                    <b> Infant <span> (0-2yrs)</span> </b>
                    <p><Label><img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#BudgetIcon-usage" alt=""></Label>
                        <select class="w-100 border-0 outline-0" name="infant" id="">
                            <option selected value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </p>
                </div>
            </div>
            <div class="col-4">
                <div>
                    <b> Child's <span> (2-12yrs)</span> </b>
                    <p><Label><img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#BudgetIcon-usage" alt=""></Label>
                        <select class="w-100 border-0 outline-0" name="adults_2_12" id="">
                            <option selected value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <b class="d-flex justify-content-between"> I Will Book
            <span>clear</span></b>
        <div class="d-flex will-book">
            <div class="col-4">
                <div class="book-btn">
                    <input type="radio" class="d-none" name="willbook" value="In Next 2-3 Days" id="23daysp">
                    <label class="will-b-l" for="23daysp">In Next 2-3 Days</label>
                </div>
            </div>
            <div class="col-4 ">
                <div class="book-btn">
                    <input type="radio" class="d-none" name="willbook" value="In This Week" id="thisweekp">
                    <label class="will-b-l" for="thisweekp">In This Week</label>
                </div>
            </div>
            <div class="col-4 ">
                <div class="book-btn">
                    <input type="radio" class="d-none" name="willbook" value="In This Month" id="thismonthp">
                    <label class="will-b-l" for="thismonthp">In This Month</label>
                </div>
            </div>
            <div class="col-4 ">
                <div class="book-btn">
                    <input type="radio" class="d-none" name="willbook" value="Later Something" id="latesomethingp">
                    <label class="will-b-l" for="latesomethingp">Later Something</label>
                </div>
            </div>
            <div class="col-4 ">
                <div class="book-btn">
                    <input type="radio" class="d-none" name="willbook" value="Just Checking Price" id="justcheckp">
                    <label class="will-b-l" for="justcheckp">Just Checking Price</label>
                </div>
            </div>
        </div>
        <div class="submit mt-5 d-flex justify-content-between">
            <button class="w-20 backbtn-popup" type="button" id="prevBtnpackage" onclick="nextPrevpackage(-1)">Back</button>
            <button class="w-20 nextbtn-popup" type="button" id="nextBtnpackage" onclick="nextPrevpackage(1)">{{$translate =App\Helpers\Menus::Translator(108)}}</button>
        </div>
    </div>
    <div class="tab tabpkg mt-5">
        <div class="form-head">

            <h4>Almost Done!</h4>
        </div>
        <div class="d-flex yesnobtn-2 mb-3">
            <div>
                <p class="border-0 mb-0"><label class="p-0" for=""><img src="https://eliteblue.net/travel/v3/public/images/dopamine/na.svg#Flights-usage" alt=""></label>
                    <b class="p-0">Cab for local sightseeing?</b>

                </p>
            </div>

            <div class="d-flex my-auto">
                <div class="d-flex">
                    <input class="m-0" type="radio" name="yesnobtn2" value="cab_yes" id="yesbtn2p2" checked>
                    </input>
                    <label class=" m-0 px-2h" for="yesbtn2p2">YES</label>
                </div>
                <div class="d-flex">
                    <input class="m-0" type="radio" value="cab_no" name="yesnobtn2" id="nobtn2p2">

                    </input>
                    <label class=" m-0 px-2h" for="nobtn2p2">NO</label>
                </div>
            </div>
        </div>

        <div class="mt-3">

            <b class="d-flex justify-content-between">Which type of package would you prefer?
                <span>clear</span></b>
            <div class="d-flex will-book">
                <div class="col-6">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="pkgdays" value="Customizable Package" id="custompkgp">
                        <label class="will-b-l" for="custompkgp">Customizable Package</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="pkgdays" value="Bestselling Standard Package" id="bestpkgp">
                        <label class="will-b-l" for="bestpkgp">Bestselling Standard Package</label>
                    </div>
                </div>

            </div>

        </div>
        <div class="mt-3">
            <b class="d-flex justify-content-between">Preferred time to call
                <span>clear</span></b>
            <div class="d-flex will-book">
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="timetocall" value="Anytime" id="anytimep">
                        <label class="will-b-l" for="anytimep">Anytime</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="timetocall" value="10 AM-12 PM" id="10to12p">
                        <label class="will-b-l" for="10to12p">10AM-12PM</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="timetocall" value="12-2 PM" id="12to2p">
                        <label class="will-b-l" for="12to2p">12-2PM</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="timetocall" value="2-4 PM" id="2to4p">
                        <label class="will-b-l" for="2to4p">2-4PM</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="timetocall" value="4-6 PM" id="4to6p">
                        <label class="will-b-l" for="4to6p">4-6PM</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="timetocall" value="After 6" id="after6p">
                        <label class="will-b-l" for="after6p">After 6</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 cabs" id="cabs2">
            <b class="d-flex justify-content-between">Driver speaks
                <span>clear</span></b>
            <div class="d-flex will-book">
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="lang" value="eng" id="english">
                        <label class="will-b-l" for="english">English</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="lang" value="local" id="local">
                        <!-- <label class="will-b-l" for="hindi">Hindi</label> -->
                        <label for="local">Local</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <b class="d-flex justify-content-between">Type of tour you want?
                <span>clear</span></b>
            <div class="d-flex will-book">
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="pkgtype" value="Honeymoon" id="Honeymoonp">
                        <label class="will-b-l" for="Honeymoonp">Honeymoon</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="pkgtype" value="Family" id="Familyp">
                        <label class="will-b-l" for="Familyp">Family</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="pkgtype" value="Adventure" id="Adventurep">
                        <label class="will-b-l" for="Adventurep">Adventure</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="pkgtype" value="Offbeat" id="Offbeatp">
                        <label class="will-b-l" for="Offbeatp">Offbeat</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="pkgtype" value="Wildlife" id="Wildlifep">
                        <label class="will-b-l" for="Wildlifep">Wildlife</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="book-btn">
                        <input type="radio" class="d-none" name="timetocall" value="Religious" id="Religiousp">
                        <label class="will-b-l" for="Religiousp">Religious</label>
                    </div>
                </div>

            </div>
        </div>
        <div class="mt-3">
            <b>Additional requirements</b>
            <textarea class="w-100" name="additional_requirements" placeholder="* Hotel names if you have already decided,
                        * Special considerations, e.g. kid friendly,
                        * Arrival and departure date / time, if tickets booked?" id="" cols="30" rows="5"></textarea>
        </div>
        <div class="submit mt-5 d-flex justify-content-between">
            <button class="w-20 backbtn-popup" type="button" id="prevBtnpackage" onclick="nextPrevpackage(-1)">Back</button>
            <button class="w-20 nextbtn-popup btn_save" type="button">Submit</button>
        </div>
    </div>
</form>
<div style="text-align:center;margin-top:40px;">
    <span class="step "></span>
    <span class="step "></span>
    <span class="step "></span>
    <span class="step "></span>
</div>
<script>
    //form js
    $('#example1').calendar({
        type: 'date',
        onClick: function(date, text, mode) {

            $('.selectedDatep').val(text);
            $('.selectedDateContainerp').css('display', 'flex');
            $('#dayheadingp').css('display', 'block');
            $('.maindatesec').css('display', 'none');
            $('.removeDateIconp').css('display', 'block');
            $('.removeDateIconp').on('click', function() {
                console.log("hhhhhhhhhh");
                $('.selectedDateContainerp').css('display', 'none');
                $('.date-btn-new-2').find('.date-btn').css('display', 'flex');
                $('#dayheadingp').css('display', 'none');
                $('.maindatesec').css('display', 'flex');
            })
        }
    });
    $('#example2').calendar({

        type: 'month',
        onChange: function(date, text, mode) {

            $('.selectedDatep').val(text);
            $('.selectedDateContainerp').css('display', 'flex');
            $('#dayheadingp').css('display', 'block');
            $('.maindatesec').css('display', 'none');
            $('.removeDateIconp').css('display', 'block');
            $('.removeDateIconp').on('click', function() {
                console.log("hhhhhhhhhh");
                $('.selectedDateContainerp').css('display', 'none');
                $('.date-btn-new-2').find('.date-btn').css('display', 'flex');
                $('#dayheadingp').css('display', 'none');
                $('.maindatesec').css('display', 'flex');
            })
        }
    });
    var currentTabpackage = 0; // Current tab is set to be the first tab (0)
    showTabpackage(currentTabpackage); // Display the current tab


    function showTabpackage(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tabpkg");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtnpackage").style.display = "none";
        } else {
            document.getElementById("prevBtnpackage").style.display = "inline";
        }
        if (n == (x.length + 1)) {
            document.getElementById("nextBtnpackage").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtnpackage").innerHTML = "{{$translate =App\Helpers\Menus::Translator(108)}}";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicatorpackage(n)
    }

    function nextPrevpackage(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tabpkg");
        console.log("tab", x);
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && validateFormpackage() == false) return false;
        // Hide the current tab:
        x[currentTabpackage].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTabpackage = currentTabpackage + n;
        // if you have reached the end of the form...
        if (currentTabpackage >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regFormpackage").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTabpackage(currentTabpackage);
    }

    function validateFormpackage() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tabpkg");
        console.log("currentTabpackage", currentTabpackage);
        y = x[currentTabpackage].getElementsByClassName("reqpackage");
        z = x[currentTabpackage].getElementsByClassName("reqpackagediv");
        console.log("y ", x[currentTabpackage]);
        console.log("y lenght", y.length);
        var emailInput = document.getElementById("emailvalid");
        var emails = emailInput.value;
        var emailRegex = /\S+@\S+\.\S+/;
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            console.log("single y", y[i]);
            // If a field is empty...
            if (y[i].value == "") {
                console.log(y[i].name);
                // add an "invalid" class to the field:
                z[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
                return false;
            }
            if (y[i].name == 'email') {
                console.log(y[i].name);
                emailInput.className += " invalid";
                valid = emailRegex.test(emails);
                console.log("test", valid);
                return valid;
            }
        }
        console.log(valid);
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step ")[currentTabpackage].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicatorpackage(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += "active";
    }

    //datepicker
    const radioGroup = document.getElementsByName("yesnobtn");

    radioGroup.forEach(ynbtn => {
        ynbtn.addEventListener("change", event => {
            if (event.target.value === "Budget With Airfare") {
                // console.log("True selected");
                document.getElementById("budget-star2").innerHTML = "Budget With Airfare : "
            } else
                document.getElementById("budget-star2").innerHTML = "Budget Without Airfare :"

        });
    });
    var radioGroup2 = document.getElementsByName("yesnobtn2");

    radioGroup2.forEach(ynbtn2 => {
        ynbtn2.addEventListener("change", event => {
            console.log("True selected");
            if (event.target.value === "cab_yes") {

                // document.getElementById("cabs").innerHTML = "none"
                // $('.cabs').css('display', 'none')
                document.getElementById("cabs2").style.display = "block"

            } else {
                document.getElementById("cabs2").style.display = "none"
            }
        });
    });
    $('#date1p').on('click', function() {
        console.log(document.getElementById('date1p').value);
    })
    $('#date1p').on('change', function() {
        console.log("ghr ja");
    })
    var aahh = document.getElementById('date1p').value
    $('.maindatesec').find('#example2').find('input').on('change', function() {
        console.log("last hope");
    })


    function datefunc() {
        $('.newdatep').find('.selectedDatep').val("").closest('.selectedDateContainerp').css('display', 'none');
        $('.maindatesec').find('.date').find('input').on('change', function() {
            console.log("fuck");
            $('.selectedDatep').val($(this).val());
            $('.selectedDateContainerp').css('display', 'flex');
            $('.selectedDateContainerp2').find('input').removeClass('req');
            $('.date-btn-new-2').find('.date-btn').css('display', 'none');
            $('.removeDateIconp').css('display', 'block');
            $('#dayheadingp').css('display', 'block');
            $('#example2').calendar({
                type: 'date'
            });

        })

        $('.removeDateIconp').on('click', function() {
            console.log("hhhhhhhhhh");
            $('.selectedDateContainerp').css('display', 'none');
            $('.date-btn-new-2').find('.date-btn').css('display', 'flex');
            $('#dayheadingp').css('display', 'none');
        })
    }
    datefunc()

    // $('.selectedDatep')
</script>