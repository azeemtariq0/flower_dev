@foreach($package as $packag)
    <div class="col-sm-2">
        @if($packag->image!= null)
            @php $image = '/'.$packag->image @endphp
        @else
            @php $image = 'galleryimage.png' @endphp
        @endif
        <div><img src="{{asset('images/media'.'/'.$image)}}"><a
                    class="see-details-button absolute-center"
                    href="{{url(app()->getLocale().'/tour-packages',$packag->slug)}}">View Packages</a></div>
        <h3>{{$packag->title}} <span>Starting from</span></h3>
        <p class="price_line">75+ packages <span>{{$currency->currency_symbol}}
                @if($packag->discount_price != null)
                    {{$packag->discount_price * $currency->currency_rate}}
                @elseif($packag->compare_price != null)
                    {{$packag->compare_price * $currency->currency_rate}}
                @endif
            </span></p>
        <p class="best_time">Best Time <span>Oct - Feb</span></p>
    </div>
@endforeach
