@extends('Frontend.layouts.master')
@section('content')
<style type="text/css">
    .page_content_area {
        padding: 10px;
    }

</style>

    <div class="container-fluid page_banner section">
<div class="row">
		<div class="breadcrumb-image" style="background-image: url({!! ($media) ? asset('images/media'.'/'.$media->image) : "https://images.pexels.com/photos/544117/pexels-photo-544117.jpeg" !!});">
    <div class="container text-center">
        <h1>{{$pages->title ?? 'No Title Found'}}</h1>
        <ol class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active">{{$pages->title ?? 'No Title Found'}}</li>
                    </ol>
    </div>
</div>
	</div>
</div>

    <div class="page_content_area">
        <div class="container">

            <div class="row">
                <?php if($pages->short_description){ ?>
                <div class="col-md-12">
                    <h1 class="strong">{!! $pages->short_description ?? 'No Description Found' !!}</h1>
                </div>
                <?php } ?>
                 <?php if($pages->long_description){ ?>
                <div class="col-md-12">
                    <p>{!! $pages->long_description ?? 'No Description Found' !!}</p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
@endsection
