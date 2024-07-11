@foreach($packages as $packag)
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
            <div class="slide_text_pkg">{{$packag->title}} <span>({{ $packag->maximum_days }} Days & {{ $packag->maximum_days - 1 }} Nights)</span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="title_red_slider text-abc">{!! $packag->description !!}</div>
            </div>
            <div class="col-sm-6 pull-right">
                <div class="price_red_slider">
                    {{$currency->currency_symbol}}
                    @if($packag->discount_price != null)
                        {{$packag->discount_price * $currency->currency_rate}}
                    @elseif($packag->compare_price != null)
                        {{$packag->compare_price * $currency->currency_rate}}
                    @endif /-
                </div>
                <div class="per_person_month_year">per person</div>
            </div>
        </div>
    </div>
@endforeach
