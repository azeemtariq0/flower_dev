<style>
    .li-links {
        text-align: left !important;
        padding: 15px !important;
    }

    .li-links a {
        color: white !important;
        padding: 15px !important;
    }

    .li-links.active {
        background: black !important;
    }
</style>
<div style="background: #fb8f1d" class="col-lg-3 col-md-3 col-sm-12 bg-signature  text-center pt-3">
    <div class="top_content px-5">

        <div class="d-flex justify-content-center mb-4">
            <div class="profile-image-outer-container">
                <div class="profile-image-inner-container text-center " style="-color: #d4d4d4;">

                    @if(auth()->user()->image!= null)
                        @php $image = auth()->user()->image @endphp
                    @else
                        @php $image = 'avatar.png' @endphp
                    @endif
                    <img style="border-radius: 50%;height: 150px;width: 150px"
                         src="{{asset('images/profile'.'/'.$image)}}" alt="{{auth()->user()->image.' Dashboard'}}">
                </div>
            </div>
        </div>
    </div>
    <div class="row p-0 mt-3 rounded-4 ">
        <div class="col-12 px-0">
            <h5 class="mb-0 py-3 fw-sm sm-shadow text-capitalize">
                {{auth()->user()->name}}
            </h5>
            <div class="links text-start">
                <ul class="m-0 p-0 pb-5">
                    <li class="list-unstyled li-links py-2 {{ (request()->is('my-profile')) ? 'active' : '' }}">
                        <a href="{{url(app()->getLocale().'/my-account/my-profile')}}"
                           class="fs-5 list-links text-decoration-none">
                            <i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                    </li>
                    <li class="list-unstyled li-links py-2 {{ (request()->is('change-password')) ? 'active' : '' }}">
                        <a href="{{url(app()->getLocale().'/my-account/change-password')}}"
                           class="fs-5 list-links text-decoration-none">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                            Change Password
                        </a>
                    </li>
                    <li class="list-unstyled li-links py-2">
                        <form class="m-0" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="fs-5 list-links text-decoration-none" href="#" :href="route('logout')"
                               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                {{ __('Logout') }}
                                </span>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    /*.links{*/
    /*    border-right: 7px solid #3b589d;*/
    /*}*/
    /*.links li.active a {*/
    /*    color: #38c4ca !important;*/
    /*}*/
    ul#myTab button {
        background: #38c4ca !important;
        color: white;
        border-radius: 30px;
        padding: 10px 29px;
    }
</style>
