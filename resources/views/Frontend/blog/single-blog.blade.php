@extends('Frontend.layouts.master')

@section('content')
    <style>
        pre {
            all: unset;
        }

        pre span {
            font-size: 16px;

        }

        .blog-tags {
            background: #f6f6f6;
            margin: 2px;
            padding: 2px 8px;
            border-radius: 3px;
        }
    </style>
    <section class="explore">
        <div class="container">
            <div class="row">
                <div class="col-md-4"><img src="{{ asset('images/media' . '/' . $single_blog->image) }}" alt=""
                        class="shadow rounded-3 w-100"></div>
                <div class="col-md-8 my-auto">
                    <h3 class="section-title">{{ $single_blog->title }} </h3>
                    <p class="p-description">{!! $single_blog->short_description !!}</p>
                </div>
                <div class="col-12">
                    <div class="section-text">
                        <p class="p-description">{!! $single_blog->long_description !!}</p>
                    </div>
                </div>
                <div class="col-5">
                    <div class="section-text">
                        <?php $myArray = explode(',', $single_blog->tags); ?>
                        @foreach ($myArray as $value)
                            <span class="tags blog-tags">{{ '#' . $value }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
    {{--    <section class="explore"> --}}
    {{--        <div class="container"> --}}
    {{--            <div class="row"> --}}
    {{--                <div class="col-md-8 my-auto"><h3 class="section-title">{{$single_blog->title}} </h3> --}}
    {{--                    <p class="p-description">{!!$single_blog->short_description!!}</p></div> --}}
    {{--                <div class="col-12"> --}}
    {{--                    <div class="section-text"> --}}
    {{--                        <p class="p-description">{!!$single_blog->long_description!!}</p> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            </div> --}}

    {{--        </div> --}}
    {{--        </div> --}}
    {{--    </section> --}}
    <section class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-12">
                <div class="subscribe-bar">
                    <div class="subscribe-content">
                        <h3>Sign up for email</h3>
                    </div>
                    <div class="email-content mt-3">
                        <form id="mailForm" class="d-flex">
                            <input type="email" class="form-control fs-4" id="email" name="email" required
                                placeholder="Enter your email address">
                            <div class="subscribe-btn">
                                <button type="button" class="btn btn-explore mt-0 submitt">SUBSCRIBE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Trending Stories -->
@endsection
