@extends('Frontend.layouts.master')
@section('title')
    Dopamine
@endsection
@section('content')
    <style>
        :root {
            --primary: #1B4997;
        }

        ::selection{
            background-color: transparent;
            color: var(--primary);
        }

        body {
            font-family: 'Poppins', sans-serif;

        }

        .primary {
            color: var(--primary);
        }

        .bg-primary-main {
            background-color: var(--primary);
        }

        .list-links {
            font-weight: 500;
            color: #111;
        }

        .fw-sm {
            font-weight: 500;
        }

        .list-links:hover {
            color: #555;
        }

        .list-links.active {
            color: var(--primary);
        }

        .sm-shadow {
            box-shadow: 0 0 10px #0000002f;
        }

        .md-shadow {
            box-shadow: 0 0 10px #00000044;
        }

        .ico {
            width: 22px;
        }

        .coin-ico {
            width: 25px;
        }

        .payment {
            padding: 3.5% 0;
        }

        .buttons button {
            padding: 10px 30px;
            transition: all .3s;
        }

        .select button:hover {
            background-color: #eee !important;
        }

        .delete button:hover {
            background-color: #1b4897cf !important;
        }

        .time {
            position: absolute;
            bottom: 15px;
            right: 15px;
        }
    </style>

    <div class="container-fluid ">
        <div class="row">
           @include('frontend.dashboard.userSidebar')
                </div>
            </div>
        </div>
    </div>

@endsection
