@extends('Frontend.layouts.master')
@section('content')



   <main>
        <div class="content-search">
            <div class="container container-100">
                <i class="far fa-times-circle" id="close-search"></i>
                <h3 class="text-center">what are your looking for ?</h3>
                <form method="get" action="/search" role="search" style="position: relative;">
                    <input type="text" class="form-control control-search" value="" autocomplete="off" placeholder="Enter Search ..." aria-label="SEARCH" name="q">

                    <button class="button_search" type="submit">search</button>
                </form>
            </div>

        </div>
        <!-- slider -->


        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                <div class="item active slide-1">
                    <img src="{{ asset('flower/img/1920x1080.png') }}" alt="img-holiwood">
                    <div class="carousel-caption">
                        <h3>EXPLORE THE</h3>
                        <h1>New Arrivals</h1>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout</p>
                        <img src="{{ asset('flower/img/310x26.png') }}" alt="img-holiwood"><br>
                        <a href="#">Shop now</a>
                    </div>

                </div>

                <div class="item slide-2">
                    <img src="{{ asset('flower/img/1920x1080.png') }}" alt="img-holiwood">
                    <div class="carousel-caption">
                        <h3>A Ferfect</h3>
                        <h1>Bouquet</h1>
                        <div class="line"></div>
                        <p>It is a long established fact that a reader will be distracted by the redable content of a
                            page when looking at its latout</p>
                        <a href="#">Shop now</a>
                    </div>

                </div>

                <div class="item slide-1">
                    <img src="{{ asset('flower/img/1920x1080.png') }}" alt="img-holiwood">
                    <div class="carousel-caption">
                        <h3>EXPLORE THE</h3>
                        <h1>New Arrivals</h1>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout</p>
                        <img src="{{ asset('flower/img/310x26.png')}}" alt="img-holiwood"><br>
                        <a href="#">Shop now</a>
                    </div>

                </div>

               

            </div>
        </div>






        <div class="brand container">
            <div class="row">
                <div class="brand-1 col-lg-2 col-md-2 col-sm-2 col-xs-4"></div>
                <div class="brand-2 col-lg-2 col-md-2 col-sm-2 col-xs-4"></div>
                <div class="brand-3 col-lg-2 col-md-2 col-sm-2 col-xs-4"></div>
                <div class="brand-4 col-lg-2 col-md-2 col-sm-2 col-xs-4"></div>
                <div class="brand-5 col-lg-2 col-md-2 col-sm-2 col-xs-4"></div>
                <div class="brand-6 col-lg-2 col-md-2 col-sm-2 col-xs-4"></div>
            </div>

        </div>

        <!-- Slider -->

   
     <!--   <?php // include('showcase.php'); ?>
        <?php // include('counter_section.php'); ?>
        <?php // include('brand_section.php'); ?>
        <?php // include('blog_section.php'); ?> -->




<div class="count">
    <div class="img-count">
        <img src="{{ asset('flower/img/1920x880.png') }}" alt="img-holiwood">
    </div>
    <div class="title-count">
        <h1>Sale up to 40%</h1>
        <p>It is a long established facr that a reader will be distracted by the<br> readable content of a page
            when looking at its layout</p>
        <div id="countdown">
            <div id='tiles'></div>
            <ul class="labels">
                <li>Days</li>
                <li>Hours</li>
                <li>Mins</li>
                <li>Secs</li>
            </ul>
        </div>
        <a href="#">Shop now</a>
    </div>


</div>

    </main>


@endsection
