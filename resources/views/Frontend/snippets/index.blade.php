@extends('Frontend.layouts.master')

@section('content')
    <style>
        .enquire{
            color: #ffff;
            background-color: #fb8f1d;
            padding-left: 4px;
            font-size: 14px;
            border: #fb8f1d;
        }
        .enquiry{
            margin-right: 4px;
        }
    </style>
    <section class="trendings">
        <div class="container">
            <div class="trendings-content">
                <div class="section-header">
                    <h3 class="section-head-title">Trending stories</h3>
                    <input class="form-control fs-4 m-5" id="search" type="text" placeholder="Search..">
                </div>
                <div class="stories">
                    @if(count($package) > 0)
                        @foreach($package as $pack)
                            <div class="story">
                                @if($pack->image!= null)
                                    @php $image = '/'.$pack->image @endphp
                                @else
                                    @php $image = 'galleryimage.png' @endphp
                                @endif
                                <a href="{{$locale('package',$pack->slug)}}?language_id={{$pack->language_id}}">
                                    <img src="{{asset('images/media'.'/'.$image)}}" alt="" class="story-img">
                                </a>
                                <a href="{{url('package',$pack->slug)}}?language_id={{$pack->language_id}}">
                                    <h4 class="story-title">{{$pack->title}}</h4>
                                </a>
                                 <p class="story-desc my-0">{!!$pack->description!!}</p>
                                    <div class="justify-content-between d-flex">
                                        <div><a href="{{url('package',$pack->slug)}}?language_id={{$pack->language_id}}" class="read-more">Read More</a></div>
                                        @if($pack->select_package == null)
                                        <div class="enquiry">
                                            <button type="button" class="enquire"  data-bs-toggle="modal" data-bs-target="#exampleModal{{$pack->id}}">
                                                Enquire Now
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$pack->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Enquire Now</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{url('enquire-now')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="package_id" value="{{$pack->id}}">
                                                        <div class="modal-body">
                                                                <div class="mb-3 mt-3">
                                                                    <label for="name" class="form-label">Name:</label>
                                                                    <input type="text" class="form-control" id="email" placeholder="Enter Name" name="name">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">Email:</label>
                                                                    <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                                                                </div>
                                                               <div class="mb-3">
                                                                <label for="phone" class="form-label">Phone:</label>
                                                                <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
                                                               </div>
                                                               <div class="mb-3">
                                                                <label for="message" class="form-label">Message:</label>
                                                                   <textarea value="{{old('message') }}" type="text"
                                                                             name="message"
                                                                             id="message" class="ckeditor form-control choices"
                                                                             cols="30"
                                                                             rows="10">
                                                                             </textarea>
                                                               </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                            </div>
                        @endforeach
                    @else
                        <div class="story">
                            <h1>No Package Found</h1>
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
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script>
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                console.log(value)
                $(".story").filter(function() {
                    $(this).toggle($(this).find('.story-title').text().toLowerCase().indexOf(value) > -1)
                });
            });
        </script>
    <!--Trending Stories -->
@endsection
{{--<script>--}}
{{--    $(document).ready(function(){--}}
{{--        $("#myInput").on("keyup", function() {--}}
{{--            var value = $(this).val().toLowerCase();--}}
{{--            $("#myTable tr").filter(function() {--}}
{{--                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--<script>--}}
{{--        $('#searchKeyword').on('keyup', function() {--}}
{{--        var searchVal = $(this).val().toLowerCase();--}}
{{--        var filterItems = $('[data-filter-item]');--}}

{{--        if ( searchVal != '' ) {--}}
{{--        filterItems.addClass('hidden');--}}
{{--        $('[data-filter-item][data-filter-name*="' + searchVal.toLowerCase() + '"]').removeClass('hidden');--}}
{{--    } else {--}}
{{--        filterItems.removeClass('hidden');--}}
{{--    }--}}
{{--    });--}}
{{--</script>--}}
