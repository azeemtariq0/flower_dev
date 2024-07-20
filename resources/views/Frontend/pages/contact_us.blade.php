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
<div class="message" style="margin-top: 150px;">
	<div class="container">
		<div class="row">
		<h1 class="text-well message-contact">Contact Us</h1><br>
			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
				<figure id="img-contact"><a href="#"><img src="{{ asset('flower/img/550x450.png')}}" class="img-responsive" alt="img-holiwood"></a></figure>
			</div>
			<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 message-contact">
				<h1>Send us a message</h1>
				<form class="form-group" action="form" method="post">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="name-ip">Name<span>*</span></label><br>
						<input type="text" name="input-name" id="name-ip" class="input-lg form-control" placeholder="Mark Stevens">
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="mail-ip">Mail<span>*</span></label><br>
						<input type="text" name="input-mail" id="mail-ip" class="input-lg form-control" placeholder="Mark Stevens">
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>What's on your mind?<span>*</span></label>
						<textarea placeholder="Write your message here..." class="form-control"></textarea>
					</div>
					<button type="submit">Send message</button>
				</form>
				
				
			</div>
		</div>
	</div>
</div>
<div id="map" style="display:none;">
	
</div>

</main>
@endsection
