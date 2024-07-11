
@extends('Frontend.layouts.master')

@section('content')
    <section class="trendings">
        <div class="container">
            <div class="trendings-content">
                <div class="section-header">
                    <h3 class="section-head-title">Trending stories</h3>
                        <form action="{{url('search')}}" method="get" class="d-flex">
                            @csrf
                            <div class="search-input f-4">
                                <input type="text" class="form-control" name="search"
                                       placeholder="Type Your Keyword Here, I will find it for you!">
                            </div>
                            <button type="submit" class="search-icon-btn btn btn-primary border-0 text-white">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                </div>
                <div class="stories">
                    @if(count($blog) > 0)
                    @foreach($blog as $blogs)
                        <div class="story">
                            @if($blogs->image!= null)
                                @php $image = '/'.$blogs->image @endphp
                            @else
                                @php $image = 'galleryimage.png' @endphp
                            @endif
                            <a href="{{$locale('blog/'.$blogs->slug)}}?language_id={{$blogs->language_id}}">
                            <img src="{{asset('images/media'.'/'.$image)}}" alt="" class="story-img">
                            </a>
                            <a href="{{url('blog',$blogs->slug)}}?language_id={{$blogs->language_id}}">
                            <h4 class="story-title">{{$blogs->title}}</h4>
                            </a>
                            <p class="story-desc my-0">{!!$blogs->short_description!!}</p>
                            <a href="{{url('blog',$blogs->slug)}}?language_id={{$blogs->language_id}}" class="read-more">Read More</a>
                        </div>
                    @endforeach
                    @else
                        <div class="story">
                            <h1>No Blog Found</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
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
