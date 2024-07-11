@extends('Frontend.layouts.master')
@section('title')
    My Profile - {{config('app.name')}}
@endsection
@section('content')
    <div class="container-fluid md-shadow rounded-4">
        <div class="row">
            @include('Frontend.dashboard.userSidebar')

{{--            <div class="row justify-content-centeralign-items-center">--}}
                <div class="col-md-9">
                  <div class="row">
                      <div class="col-md-8 mx-auto">
                          <div class="card border-0">
                              <div class="card-body">
                                  @foreach($data as $row)
                                      <form action="{{url('update_profile',$row->id)}}"  method="post" enctype="multipart/form-data">
                                          @csrf
                                          @method('PUT')
                                      <div class="d-flex justify-content-center mb-4">
                                          <div class="profile-image-outer-container">
                                              <div class="profile-image-inner-container " style="background-color: #d4d4d4;">
                                                  <td>
                                                      @if($row->image!= null)
                                                          @php $image = $row->image @endphp
                                                      @else
                                                          @php $image = 'avatar.png' @endphp
                                                      @endif

                                                  <img src="{{asset('images/profile'.'/'.$image)}}">
                                                  <span class="profile-image-button bg-dark">
                                                                        <i style="line-height: unset" class="fas fa-camera text-white"></i>
                                                                    </span>
                                              </div>
                                              <input type="file" name="image" id="file" class="profile-image-input">
                                          </div>
                                      </div>
                                      <div class="row mb-3">
                                          <div class="col-md-12">
                                              <input  type="text" placeholder="Enter your name" class="py-3 form-control text-dark rounded-pill " name="name" value="{{$row->name}}" required="" autocomplete="email" required>
                                          </div>
                                      </div>
                                      <div class="row mb-3">
                                          <div class="col-md-12">
                                              <input value="{{$row->email}}" id="email" type="email"  class="py-3 text-dark rounded-pill form-control " name="email" required="" autocomplete="current-password" readonly >
                                          </div>
                                      </div>
                                      <div class="row mb-3">
                                          <div class="col-md-12">
                                              <input value="{{$row->phone_number}}" type="number" placeholder="Enter your cell number (optional)" class="py-3 form-control text-dark rounded-pill" val name="phone_number" value=""  autocomplete="email" min="0">
                                          </div>
                                      </div>
                                      <div class="row mb-0">
                                          <div class="col-md-12">
                                              <button type="submit"  class="btn read-more-cta px-4 py-2 fs-5 text-uppercase my-4 ">
                                                  Update
                                              </button>
                                          </div>
                                      </div>
                                  </form>
                                  @endforeach

                              </div>
                          </div>
                      </div>
                  </div>
                </div>
{{--            </div>--}}

        </div>
    </div>

@endsection
