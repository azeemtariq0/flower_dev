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

<div class="wellcome" style="margin-top: 200px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 text-well">
				<h1>About Us</h1>
				<p>Yasmin Flowers is a new venture that brings together the majestic beauty of the Damascus jasmine and the vibrant flower culture of the Netherlands. We are passionate about sharing the unique charm and elegance of these flowers with our customers, and we are dedicated to providing exceptional service and quality in all aspects of our business.
Who We Are:
Our team is composed of experienced florists, horticulturists, and business professionals who share a love for the beauty and fragrance of flowers. We are committed to sourcing the finest Damascus jasmine and other flowers from the Netherlands, and to using our expertise to create stunning arrangements that exceed our customers' expectations.
Why Yasmin Flowers:
At Yasmin Flowers, we believe that flowers have the power to bring joy and serenity into our lives. We are passionate about sharing this gift with our customers, and we are dedicated to providing exceptional service and quality in all aspects of our business. Whether you're looking for a special occasion or just want to brighten up your day, we have the perfect arrangement for you.
Our Mission:
Our mission at Yasmin Flowers is to provide exceptional service, quality, and value to our customers while promoting the beauty and elegance of the Damascus jasmine and other flowers from the Netherlands. We strive to create a warm and welcoming environment where our customers can feel comfortable and at ease, and where they can find inspiration for their floral arrangements.
Values:
At Yasmin Flowers, we value:<br>
* Quality: We are committed to providing only the finest flowers and exceptional service to our customers.<br>
* Innovation: We are constantly looking for new and creative ways to use flowers in our arrangements.<br>
* Sustainability: We strive to minimize our environmental impact by using sustainable practices and sourcing flowers from environmentally responsible suppliers.<br>
* Customer satisfaction: We are dedicated to providing exceptional service and ensuring that every customer leaves our shop feeling satisfied and happy.<br>
Services:<br>
* Custom flower arrangements for special occasions<br>
* Flower subscription service for regular deliveries<br>
* Wholesale flower sales for florists and event planners<br>
* Floral design classes and workshops</p>
					<div class="social-well">
						<span>SOCIAL:</span>
						<a href="#" id="link-insta2"></a>
						<a href="#" id="link-fb2"></a>
						<a href="#" id="link-tw2"></a>
						<a href="#" id="link-sky2"></a>
					</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-4 col-xs-12 img-well">
				<figure id="img-about"><a href="#"><img src="{{ asset('flower/img/slide.png') }}" alt="img-holiwood"></a></figure>
			</div>
		</div>
	</div>
</div>

<!-- ------------------------- -->


		
	</div>
</div>

</main>
@endsection
