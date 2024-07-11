@extends('Frontend.layouts.master')
@section('content')
    <style>
        .d-flex {
            justify-content: center;
        }

        .error-h img {
            width: 50%;
        }

        .read-more-cta {
            margin-top: 8px;
            text-align: center;
        }
    </style>
    <div class="container">
        <div class="row error-h">
            <div class="col-md-12 mx-auto text-center d-flex">
                <img class=" p-5" src="{{asset('frontend/404.png')}}" alt="">
            </div>
            <div class="col-md-12 text-center">
                <a href="{{url(app()->getLocale().'/')}}"
                   class="btn read-more-cta px-4 py-2 fs-5 text-uppercase my-4 mb-5">
                    Return to home
                </a>
            </div>
        </div>
    </div>


@endsection
