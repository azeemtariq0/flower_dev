@extends('frontend.layouts.master')
@section('title')
    Home - Comments
@endsection
@section('description')
    {{--Meta Description here --}}
@endsection
@section('keywords')
    {{--   Meta Keywords here --}}
@endsection
@section('content')

    <div class="container-fluid md-shadow rounded-4">
        <div class="row">
            @include('frontend.dashboard.userSidebar')


            {{--            <div class="row justify-content-centeralign-items-center">--}}

            <div class="col-md-9">
                <ul class="nav nav-tabs justify-content-start border-0" id="myTab" role="tablist">
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Post</button>
                    </li>
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Deal</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                       @if(count($activity) != 0 )
                        @foreach($activity as $row)

                            <div class="row my-3">
                                <div class="col-md-12 mx-auto">
                                    <div class="card bg-gray">
                                        <div class="card-header">
                                            <div class="card border-0">




                                                <div class="col-12 ">
                                                    <div class="row align-items-center w-100 mx-auto main-pd-card d-flex bg-white sm-shadow rounded-3 p-3 position-relative">
                                                        <div class="col-1 p-0 my-auto">
                                                            <a href="{{url('blog',$row[0]->slug)}}">
                                                            <img src="{{asset('images/blog'.'/'.$row[0]->image)}}" alt="Product_image" class="w-100">
                                                            </a>
                                                        </div>
                                                        <div class="col-8 mx-3">
                                                            <a href="{{url('blog',$row[0]->slug)}}">
                                                            <h6 class="text-truncate m-0 text-dark">
                                                                {{$row[0]->title}}
                                                            </h6>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <h5 class="m-0 py-2 ">Comments</h5>
                                        </div>

                                        @foreach($comments as $comment)


                                            @if($comment->reference_id == (int)$row[0]->reference_id)


                                                <div class="card-footer">
                                                    <p class="card-text text-end"><small class="text-muted fw-sm">
                                                            <strong>{{$comment->created_at}} </strong></small></p>

                                                    {{$comment->comments}}
                                                </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <h5 class="py-5">You have not posted any comments yet.</h5>
                        @endif

                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @if(count($activity) != 0 )
                            @foreach($coupon as $row)
                            <div class="row my-3">
                                <div class="col-md-12 mx-auto">
                                    <div class="card bg-gray">
                                        <div class="card-header">
                                            <div class="card border-0">
                                                <div class="col-12 ">
                                                    <div class="row align-items-center w-100 mx-auto main-pd-card d-flex bg-white sm-shadow rounded-3 p-3 position-relative">
                                                        <div class="col-1 p-0 my-auto">

                                                            <a href="{{url('single-coupons',$row[0]->slug)}}">
                                                            <img src="{{asset('images/media'.'/'.$row[0]->image)}}" style="height:50px;object-fit:contain" alt="Product_image" class="w-100">
                                                            </a>
                                                        </div>
                                                        <div class="col-8 mx-3">
                                                            <a href="{{url('single-coupons',$row[0]->slug)}}">
                                                            <h6 class="text-truncate m-0 text-dark">
                                                                {{$row[0]->title}} </h6>
                                                            </a>
                                                            <p class="price mb-0">
                                                            <span class="old_price pe-2 text-dark">
                                                            <strike>
                                                                ${{$row[0]->compare_price}}
                                                                </strike>
                                                                </span>
                                                                ${{$row[0]->regular_price}}
                                                                <span class="fs-6 fw-bold text-danger float-end">
=                                                                </span>
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>



                                            </div>
                                            <h5 class="m-0 py-2 ">Comments</h5>
                                        </div>

                                        @foreach($comments as $comment)


                                            @if($comment->reference_id == (int)$row[0]->reference_id)


                                                <div class="card-footer">
                                                    <p class="card-text text-end"><small class="text-muted fw-sm">
                                                            <strong>{{$comment->created_at}} </strong></small></p>

                                                    {{$comment->comments}}
                                                </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <h5 class="py-5">You have not posted any comments yet.</h5>
                        @endif
                    </div>
                </div>

            </div>

            {{--            </div>--}}

        </div>
    </div>

@endsection


<style>
    .bg-gray{
        background: #f9f9f9;
    }
</style>
