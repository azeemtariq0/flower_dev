@extends('Frontend.layouts.master')
@section('title')
    Change Password - {{config('app.name')}}
@endsection
@section('content')

    <div class="container-fluid md-shadow rounded-4">
        <div class="row ">
            @include('Frontend.dashboard.userSidebar')
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card border-0">
                            <div class="card-body">
                                <form action=" {{url('update-password',auth()->user()->id)}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex justify-content-center mb-4">
                                        <div class="profile-image-outer-container">

                                            <h4 class="text-purp text-uppercase"> Change password</h4>

                                        </div>
                                    </div>
                                    @include('management.layouts.error')

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input type="password" placeholder="Enter current password"
                                                   class="py-3 form-control text-dark rounded-pill " name="password"
                                                   required="" autocomplete="email" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input id="text" placeholder="Enter new password" type="password"
                                                   class="py-3 text-dark rounded-pill form-control " name="new_password"
                                                   required="" autocomplete="current-password">
                                            <p style="font-size: 11px;padding-top:4px;" class="text-muted">Must be 8
                                                Characters and include one numeric,one uppercase ,one lowercase & one
                                                symbol</p>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input type="password" placeholder="Confirm new password"
                                                   class="py-3 form-control text-dark rounded-pill" val
                                                   name="confirm_password" value="" autocomplete="email" min="0">
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit"
                                                    class="btn read-more-cta px-4 py-2 fs-5 text-uppercase my-4">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
