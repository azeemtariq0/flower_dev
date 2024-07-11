@foreach($monthSeason as $packag)
    <div class="col-sm-4">
        <div class="red_slide_image">
            @if($packag->image!= null)
                @php $image = '/'.$packag->image @endphp
            @else
                @php $image = 'galleryimage.png' @endphp
            @endif
            <img src="{{asset('images/media'.'/'.$image)}}"><a
                    class="see-details-button absolute-center"
                    href="{{ url(app()->getLocale().'/packages',$packag->slug) }}">View Packages</a>
            <div class="slide_text_pkg">{{$packag->title}} <span>({{ $packag->maximum_days }} Days	 & {{ $packag->maximum_days - 1 }} Nights)</span>
            </div>
            <div class="red_bar_top">Expert’s Pick</div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="title_red_slider text-abc">{!! $packag->description !!}</div>
            </div>

        </div>
    </div>
@endforeach
