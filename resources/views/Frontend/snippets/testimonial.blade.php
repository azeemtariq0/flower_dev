
@extends('Frontend.layouts.master')

@section('content')
    <section class="testimonials">
        <div class="container">

            <div class="testimonials-content">
                <h3 class="section-title">Testimonials</h3>
                <div class="testimonial-list">
                    @if(count($testimonial) > 0)
                    @foreach($testimonial as $test)
                    <div class="testimonial-item {{ $loop->index === 0 ? 'active' : ''}}">
                        <div class="testimonial-text">
                            <div class="rating">
                                <img src="https://raw.githubusercontent.com/mustafadalga/tour-and-travel/master/assets/img/star.svg" alt="">
                                <img src="https://raw.githubusercontent.com/mustafadalga/tour-and-travel/master/assets/img/star.svg" alt="">
                                <img src="https://raw.githubusercontent.com/mustafadalga/tour-and-travel/master/assets/img/star.svg" alt="">
                                <img src="https://raw.githubusercontent.com/mustafadalga/tour-and-travel/master/assets/img/star.svg" alt="">
                                <img src="https://raw.githubusercontent.com/mustafadalga/tour-and-travel/master/assets/img/star.svg" alt="">
                            </div>
                            <p class="testimonial-description">
                                {{$test->description}}
                            </p>
                            <h6 class="author-name">Edward Newgate</h6>
                            <span class="author-position">Founder Circle</span>

                        </div>
                        <div class="testimonial-img">
                            @if($test->image!= null)
                                @php $image = '/'.$test->image @endphp
                            @else
                                @php $image = 'galleryimage.png' @endphp
                            @endif
                            <img src="{{asset('images/media'.'/'.$image)}}" alt="">
                        </div>
                    </div>
                    @endforeach
                    @else
                        <div class="story" style="margin-left: 446px;">
                            <h1>No Testimonial Found</h1>
                        </div>
                    @endif
                    <div class="direction">
                        <div class="arrow passive" id="arrow-previous"><</div>
                        <div class="arrow" id="arrow-next">></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Trending Stories -->
@endsection
