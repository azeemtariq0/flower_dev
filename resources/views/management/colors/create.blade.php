@extends('layouts.app')


@section('content')
<?php  $isView = (@$color->is_view==1) ? 'readonly' : '';   ?>
<?php  $isSelectView = (@$color->is_view==1) ? 'pointer-off' : '';   ?>
@if (count($errors) > 0)
<div id="content" class="padding-20">

    <div class="alert alert-danger margin-bottom-30">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
           @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
   @endif


   <div id="content" class="padding-20">

    <div class="row">

        <div class="col-md-12">

            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>{{ $data['page_management']['title'] ?? "" }}</strong>
                </div>

                <div class="panel-body">
                  @if(!isset($color->id))
                   {!! Form::open(array('route' => 'colors.store','method'=>'POST', 'id' => 'colors_form','enctype'=>'multipart/form-data')) !!}
                   @else
                     {!! Form::model($color, ['id' => 'colors_form','enctype'=>'multipart/form-data','method' => 'PATCH','route' => ['colors.update', $color->id]]) !!}
                    @endif
                   <!-- <form class="validate" action="{{ route('users.store')}}" method="post" data-success="Sent! Thank you!" data-toastr-position="top-right"> -->
                    <fieldset>
                        <!-- required [php action request] -->
                        <input type="hidden" name="action" value="contact_send" />
                         <div class="col-md-6">


                                 <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10">
                                            <label>Color Name </label>
                                            {!! Form::text('color_name', null, array('placeholder' => 'Color Name','class' => 'form-control')) !!}
                                        </div>

                                    </div>
                                </div>


                                 <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10">
                                            <label>Color Code </label>
                                            {!! Form::text('color_code', null, array('placeholder' => 'Color Code','class' => 'form-control')) !!}
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10">
                                            <label>Description </label>
                                            {!! Form::textarea('description', null, array('placeholder' => 'Descreption','class' => 'form-control','rows'=>2,$isView=>true)) !!}
                                        </div>

                                    </div>
                                </div>

                            </div>



                        </fieldset>
                        @if($isView=="")
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" onclick="save()" class="btn btn-info margin-top-30 pull-right">
                                   <i class="fa fa-check"></i>  <?= (!isset($color->id)) ? "Save" : "Update" ?>
                               </button>
                           </div>                       
                         </div>
                          @endif
                       {!! Form::close() !!}
                   </div>
               </div>
               <!-- /----- -->
           </div>
       </div>
   </div>
</div>
<!-- @include('blocks/validate') -->
@endsection