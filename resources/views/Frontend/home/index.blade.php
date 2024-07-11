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
                <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                <div class="item active slide-1">
                    <!-- <img src="{{ asset('flower/img/1920x1080.png') }}" alt="img-holiwood"> -->
                    <img src="{{ asset('flower/img/slider1.png') }}" alt="img-holiwood">
                    <!-- <div class="carousel-caption">
                        <h3>EXPLORE THE</h3>
                        <h1>New Arrivals</h1>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout</p>
                        <img src="{{ asset('flower/img/310x26.png') }}" alt="img-holiwood"><br>
                        <a href="#">Shop now</a>
                    </div> -->

                </div>

                <div class="item slide-2">
                    <img src="{{ asset('flower/img/slider2.png') }}" alt="img-holiwood">
                    <!-- <div class="carousel-caption">
                        <h3>A Ferfect</h3>
                        <h1>Bouquet</h1>
                        <div class="line"></div>
                        <p>It is a long established fact that a reader will be distracted by the redable content of a
                            page when looking at its latout</p>
                        <a href="#">Shop now</a>
                    </div> -->

                </div>

                <div class="item slide-1">
                    <img src="{{ asset('flower/img/slider3.png') }}" alt="img-holiwood">
                    <!-- <div class="carousel-caption">
                        <h3>EXPLORE THE</h3>
                        <h1>New Arrivals</h1>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout</p>
                        <img src="{{ asset('flower/img/310x26.png')}}" alt="img-holiwood"><br> -->
                        <!-- <a href="#">Shop now</a> -->
                    <!-- </div> -->

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



<div class=" wedding" id="showcase-3">



<h1>Category of Jenstore</h1>
<h2>Larger Range of <span class="hidden-xs">Yasmin </span> Flower </h2>
<div class="gallery clearfix">
<figure>
    <!-- <div class="img-wedding"><img src="img/1920x1170.png" alt="img-holiwood"></div> -->
    <div class="container wedding-content">
        <div class="row">

   @foreach($products as $value)
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 product-wedding">
        <div class="product-image-wedding">
                <a href="#"><img src="{{ asset('flower/img/slider2.png') }}" class="img-responsive" alt="img-holiwood"></a>
                <div class="product-icon-wedding">
                    <a href="{{ url('product/'.$value->id) }}"><i class="far fa-eye"></i></a>
                    <a href="javascript:void(0)" class="add-to-cart-button" data-product-id="{{ $value->id }}"><i class="fas fa-shopping-basket"></i></a>
                    <a href="#"><i class="far fa-heart"></i></a>
                </div>
        </div>
        <div class="product-title-wedding">
                <h5><a href="{{ url('add-to-cart/11') }}">{{ $value->product_name }}</a></h5>
                <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                <div class="prince">$160.8</div>
        </div>
    </div>

    @endforeach();
   
</div>
    </div>
    
</figure>
</div>

</div>


<div class="count hide">
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
