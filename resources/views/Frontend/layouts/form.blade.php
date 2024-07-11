@include('Frontend.layouts.header')



        <!-- Thanks to Pieter B. for helping out with the logistics -->
<div class="container form_container">
    <form id="contact" action="#" style="display: none;">
        <div>
            <h3>fff</h3>
            <section>
                <p><strong>Hey! Are you looking for help in planning your trip?</strong></p>
                <p><input type="radio" name="help_planning" id="step_1" class="required"> <span>Yes! A romantic trip</span></p>
                <p><input type="radio" name="help_planning"  class="step_1  required"> <span>Yes! For a family trip</span></p>
                <p><input type="radio" name="help_planning" class="step_1  required"> <span>Yes! A honeymoon trip</span></p>
                <p><input type="radio" name="help_planning" class="step_1 required "> <span>Yes! For a trip with my friends</span></p>
                <p><input type="radio" name="help_planning" class="step_1  required"> <span>For a group trip</span></p>
                <p><input type="radio" name="help_planning" class="step_1  required"> <span>For a solo trip</span></p>
            </section>
            <h3>eee</h3>
            <section>
                <p><strong>May I know what kind of destination you are looking for?</strong></p>
                <p><input type="radio" name="looking_for" class="required"> <span>Adventure</span></p>
                <p><input type="radio" name="looking_for" class="required"> <span>Leisure</span></p>
                <p><input type="radio" name="looking_for" class="required"> <span>Beaches</span></p>
                <p><input type="radio" name="looking_for" class="required"> <span>Hill Stations</span></p>
                <p><input type="radio" name="looking_for" class="required"> <span>Nature</span></p>
                <p><input type="radio" name="looking_for" class="required"> <span>Cold Places</span></p>
            </section>
            <h3>ddd</h3>
            <section>
                <p><strong>Based on your requirements, here are some suggested destinations.</strong></p>
                <p>You may select from below</p>
                <p><input type="radio" name="suggested_destination" class="required"> <span>Himachal</span></p>
                <p><input type="radio" name="suggested_destination" class="required"> <span>Andaman</span></p>
                <p><input type="radio" name="suggested_destination" class="required"> <span>Uttarakhand</span></p>
                <p><input type="radio" name="suggested_destination" class="required"> <span>Europe</span></p>
                <p><input type="radio" name="suggested_destination" class="required"> <span>Thailand</span></p>
                <p><input type="radio" name="suggested_destination" class="required"> <span>Others</span></p>
            </section>
            <h3>aa</h3>
            <section>
                <p><strong>Is your travel date fixed?</strong></p>
                <p><input type="radio" name="fixed_travel_date" class="required"> <span>Yes</span></p>
                <p><input type="radio" name="fixed_travel_date" class="required"> <span>Not Yet</span></p>
            </section>
            <h3>ccc</h3>

            <section>
                <p><strong>Is your travel date fixed?</strong></p>
                <input type="text" placeholder="Firstname" name="firstname"  class="required" />
                <input type="text" placeholder="Surname"  name="surname" class="required" />
                <input type="text" placeholder="Date of Brith" name="birthdate"  class="required" />
                <input type="text" placeholder="Insurance number"  name="insurance" class="required" />
                <input type="text" placeholder="Family Status" name="family" class="required"  />
                <select class="required">
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                </select>
            </section>

            <h3>bb</h3>
            <section>
                <p><strong>Address</strong></p>
                <input type="text" placeholder="Street, nbr" name="street" class="required"  />
                <input type="text" placeholder="City" name="city"  class="required" />
                <input type="text" placeholder="Postcode" name="postcode"  class="required" />
                <input type="text" placeholder="Country" name="country"  class="required" />
            </section>
            <h3>aaa</h3>

            <section>
                <p><strong>Contact Information</strong></p>
                <input type="text" placeholder="Email address" name="email" />
                <p><input type="text" name="phone_code" class="phone_code" placeholder="+91"> <input type="text" placeholder="Phone" class="phone_num" class="required" /></p>
                <input type="text" placeholder="Mobile" class="required" name="mobile_num" />
            </section>



        </div>
    </form>
</div>



<style type="text/css">


    /* ==========================================================================
       Chrome Frame prompt
       ========================================================================== */

    .chromeframe {
        margin: 0.2em 0;
        background: #ccc;
        color: #000;
        padding: 0.2em 0;
    }

    /* ==========================================================================
       Author's custom styles
       ========================================================================== */


















    /*
     * Hide from both screenreaders and browsers: h5bp.com/u
     */

    .hidden {
        display: none !important;
        visibility: hidden;
    }

    /*
     * Hide only visually, but have it available for screenreaders: h5bp.com/v
     */

    .visuallyhidden {
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }

    /*
     * Extends the .visuallyhidden class to allow the element to be focusable
     * when navigated to via the keyboard: h5bp.com/p
     */

    .visuallyhidden.focusable:active,
    .visuallyhidden.focusable:focus {
        clip: auto;
        height: auto;
        margin: 0;
        overflow: visible;
        position: static;
        width: auto;
    }

    /*
     * Hide visually and from screenreaders, but maintain layout
     */

    .invisible {
        visibility: hidden;
    }

    /*
     * Clearfix: contain floats
     *
     * For modern browsers
     * 1. The space content is one way to avoid an Opera bug when the
     *    `contenteditable` attribute is included anywhere else in the document.
     *    Otherwise it causes space to appear at the top and bottom of elements
     *    that receive the `clearfix` class.
     * 2. The use of `table` rather than `block` is only necessary if using
     *    `:before` to contain the top-margins of child elements.
     */

    .clearfix:before,
    .clearfix:after {
        content: " "; /* 1 */
        display: table; /* 2 */
    }

    .clearfix:after {
        clear: both;
    }

    /*
     * For IE 6/7 only
     * Include this rule to trigger hasLayout and contain floats.
     */

    .clearfix {
        *zoom: 1;
    }

    /* ==========================================================================
       EXAMPLE Media Queries for Responsive Design.
       These examples override the primary ('mobile first') styles.
       Modify as content requires.
       ========================================================================== */


    /*
        Common
    */

    .wizard,
    .tabcontrol
    {
        display: block;
        width: 100%;
        overflow: hidden;
    }

    .wizard a,
    .tabcontrol a
    {
        outline: 0;
    }

    .wizard ul,
    .tabcontrol ul
    {
        list-style: none !important;
        padding: 0;
        margin: 0;
    }

    .wizard ul > li,
    .tabcontrol ul > li
    {
        display: block;
        padding: 0;
    }

    /* Accessibility */
    .wizard > .steps .current-info,
    .tabcontrol > .steps .current-info
    {
        position: absolute;
        left: -999em;
    }

    .wizard > .content > .title,
    .tabcontrol > .content > .title
    {
        position: absolute;
        left: -999em;
    }



    /*
        Wizard
    */

    .wizard > .steps
    {
        position: relative;
        display: block;
        width: 100%;
    }

    .wizard.vertical > .steps
    {
        display: inline;
        float: left;
        width: 30%;
    }

    .wizard > .steps .number
    {
        font-size: 1.429em;
    }

    .wizard > .steps > ul > li
    {
        width: 25%;
    }

    .wizard > .steps > ul > li,
    .wizard > .actions > ul > li
    {
        float: left;
    }

    .wizard.vertical > .steps > ul > li
    {
        float: none;
        width: 100%;
    }

    .wizard > .steps a,
    .wizard > .steps a:hover,
    .wizard > .steps a:active
    {
        display: block;
        width: auto;
        margin: 0 0.5em 0.5em;
        padding: 1em 1em;
        text-decoration: none;

        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    .wizard > .steps .disabled a,
    .wizard > .steps .disabled a:hover,
    .wizard > .steps .disabled a:active
    {
        background: #eee;
        color: #aaa;
        cursor: default;
    }

    .wizard > .steps .current a,
    .wizard > .steps .current a:hover,
    .wizard > .steps .current a:active
    {
        background: #fcfcfc;
        color: #111;
        cursor: default;
    }

    .wizard > .steps .done a,
    .wizard > .steps .done a:hover,
    .wizard > .steps .done a:active
    {
        background: #4CAF50;
        color: #fff;
    }

    .wizard > .steps .error a,
    .wizard > .steps .error a:hover,
    .wizard > .steps .error a:active
    {
        background: #ff3111;
        color: #fff;
    }

    .wizard > .content
    {
        background: #eee;
        display: block;
        margin: 0.5em;
        min-height: 35em;
        overflow: hidden;
        position: relative;
        width: auto;

        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    .wizard.vertical > .content
    {
        display: inline;
        float: left;
        margin: 0 2.5% 0.5em 2.5%;
        width: 65%;
    }

    .wizard > .content > .body
    {
        float: left;
        position: absolute;
        width: 95%;
        height: 95%;
        padding: 2.5%;
    }

    .wizard > .content > .body ul
    {
        list-style: disc !important;
    }

    .wizard > .content > .body ul > li
    {
        display: list-item;
    }

    .wizard > .content > .body > iframe
    {
        border: 0 none;
        width: 100%;
        height: 100%;
    }

    .wizard > .content > .body input
    {
        display: block;
        border: 1px solid #ccc;
    }

    .wizard > .content > .body input[type="checkbox"]
    {
        display: inline-block;
    }

    .wizard > .content > .body input.error
    {
        background: rgb(251, 227, 228);
        border: 1px solid #fbc2c4;
        color: #8a1f11;
    }

    .wizard > .content > .body label
    {
        display: inline-block;
        margin-bottom: 0.5em;
    }

    .wizard > .content > .body label.error
    {
        color: #8a1f11;
        display: inline-block;
        margin-left: 1.5em;
    }

    .wizard > .actions
    {
        position: relative;
        display: block;
        text-align: right;
        width: 100%;
    }

    .wizard.vertical > .actions
    {
        display: inline;
        float: right;
        margin: 0 2.5%;
        width: 95%;
    }

    .wizard > .actions > ul
    {
        display: inline-block;
        text-align: right;
    }

    .wizard > .actions > ul > li
    {
        margin: 0 0.5em;
    }

    .wizard.vertical > .actions > ul > li
    {
        margin: 0 0 0 1em;
    }

    .wizard > .actions a, .wizard > .actions a:hover, .wizard > .actions a:active {
        background: #E6542D;
        color: #fff;
        display: block;
        padding: 0.5em 1em;
        text-decoration: none;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 0;
    }

    .wizard > .actions .disabled a,
    .wizard > .actions .disabled a:hover,
    .wizard > .actions .disabled a:active
    {
        background: #eee;
        color: #aaa;
    }

    .wizard > .loading
    {
    }

    .wizard > .loading .spinner
    {
    }



    /*
        Tabcontrol
    */

    .tabcontrol > .steps
    {
        position: relative;
        display: block;
        width: 100%;
    }

    .tabcontrol > .steps > ul
    {
        position: relative;
        margin: 6px 0 0 0;
        top: 1px;
        z-index: 1;
    }

    .tabcontrol > .steps > ul > li
    {
        float: left;
        margin: 5px 2px 0 0;
        padding: 1px;

        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .tabcontrol > .steps > ul > li:hover
    {
        background: #edecec;
        border: 1px solid #bbb;
        padding: 0;
    }

    .tabcontrol > .steps > ul > li.current
    {
        background: #fff;
        border: 1px solid #bbb;
        border-bottom: 0 none;
        padding: 0 0 1px 0;
        margin-top: 0;
    }

    .tabcontrol > .steps > ul > li > a
    {
        color: #5f5f5f;
        display: inline-block;
        border: 0 none;
        margin: 0;
        padding: 10px 30px;
        text-decoration: none;
    }

    .tabcontrol > .steps > ul > li > a:hover
    {
        text-decoration: none;
    }

    .tabcontrol > .steps > ul > li.current > a
    {
        padding: 15px 30px 10px 30px;
    }

    .tabcontrol > .content
    {
        position: relative;
        display: inline-block;
        width: 100%;
        height: 35em;
        overflow: hidden;
        border-top: 1px solid #bbb;
        padding-top: 20px;
    }

    .tabcontrol > .content > .body
    {
        float: left;
        position: absolute;
        width: 100%;
        height: 95%;
        padding: 2.5%;
    }

    .tabcontrol > .content > .body ul
    {
        list-style: disc !important;
    }

    .tabcontrol > .content > .body ul > li
    {
        display: list-item;
    }

    .container {
        max-width: 800px;
        width: 100%;
        margin: 0 auto;
        position: relative;
    }

    #contact input[type="text"],
    #contact input[type="email"],
    #contact input[type="tel"],
    #contact input[type="url"],
    #contact textarea,
    #contact button[type="submit"] {
        font: 400 12px/16px "Titillium Web", Helvetica, Arial, sans-serif;
    }

    #contact {
        background: #F9F9F9;
        padding: 25px;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    #contact h3 {
        display: block;
        font-size: 30px;
        font-weight: 300;
        margin-bottom: 10px;
    }

    #contact h4 {
        margin: 5px 0 15px;
        display: block;
        font-size: 13px;
        font-weight: 400;
    }

    fieldset {
        border: medium none !important;
        margin: 0 0 10px;
        min-width: 100%;
        padding: 0;
        width: 100%;
    }

    #contact input[type="text"],
    #contact input[type="email"],
    #contact input[type="tel"],
    #contact input[type="url"],
    #contact select,
    #contact textarea {
        width: 100%;
        border: 1px solid #ccc;
        background: #FFF;
        margin: 0 0 5px;
        padding: 10px;
        margin: 7px 0px;
        display: inline-block;
        padding: 12px 25px;
        box-sizing: border-box;
        border-radius: 0;
        border: 1px solid lightgrey;
        font-size: 1em;
        font-family: inherit;
        background: white;
    }

    #contact input[type="text"]:hover,
    #contact input[type="email"]:hover,
    #contact input[type="tel"]:hover,
    #contact input[type="url"]:hover,
    #contact textarea:hover {
        -webkit-transition: border-color 0.3s ease-in-out;
        -moz-transition: border-color 0.3s ease-in-out;
        transition: border-color 0.3s ease-in-out;
        border: 1px solid #aaa;
    }

    #contact textarea {
        height: 100px;
        max-width: 100%;
        resize: none;
    }

    #contact button[type="submit"] {
        cursor: pointer;
        width: 100%;
        border: none;
        background: #4CAF50;
        color: #FFF;
        margin: 0 0 5px;
        padding: 10px;
        font-size: 15px;
    }

    #contact button[type="submit"]:hover {
        background: #43A047;
        -webkit-transition: background 0.3s ease-in-out;
        -moz-transition: background 0.3s ease-in-out;
        transition: background-color 0.3s ease-in-out;
    }

    #contact button[type="submit"]:active {
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
    }



    #contact input:focus,
    #contact textarea:focus {
        outline: 0;
        border: 1px solid #aaa;
    }



    .steps > ul > li > a,
    .actions li a {
        padding: 10px;
        text-decoration: none;
        margin: 1px;
        display: block;
        color: #777;
    }
    .steps > ul > li,
    .actions li {
        list-style:none;
    }
    .wizard > .content > .body label.error {
        position: absolute;
        right: 15px;
    }
    .steps.clearfix {
        opacity: 0;
        display: none;
    }
    .wizard > .content {
        background: transparent;
        display: block;
        margin: 0;
        min-height: 35em;
        overflow: hidden;
        position: relative;
        width: auto;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        padding: 0;
    }
    .form_container.container{
        max-width: 483px;
    }
    form#contact strong {
        color: #333;
        text-align: left;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 16px;
        line-height: 1.2;
        padding-right: 32px;
        white-space: normal;
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: normal;
        margin-top: 0;
        font-family: Lato,sans-serif!important;
    }
    section p:first-child {
        background: transparent !important;
        font-weight: 700;
    }
    .wizard > .content > .body label.error {
        color: red;
    }
</style>
@include('Frontend.layouts.footer')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js"></script>
<script type="text/javascript">
    var form = jQuery("#contact");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
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
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        }
    });
    jQuery( document ).ready(function() {

        jQuery("#contact").hide();



        jQuery("#contact").hide().delay(5000).queue(function(n) {
            jQuery(this).show(); n();
        });
    });
</script>
