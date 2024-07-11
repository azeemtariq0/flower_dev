@extends('layouts.app')


@section('content')
<?php  $isView = (@$product_category->is_view==1) ? 'readonly' : '';   ?>
<?php  $isSelectView = (@$product_category->is_view==1) ? 'pointer-off' : '';   ?>
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
                  @if(!isset($product_category->id))
                   {!! Form::open(array('route' => 'product-categories.store','method'=>'POST', 'id' => 'product_categories_form','enctype'=>'multipart/form-data')) !!}
                   @else
                     {!! Form::model($product_category, ['id' => 'product_categories_form','enctype'=>'multipart/form-data','method' => 'PATCH','route' => ['product-categories.update', $product_category->id]]) !!}
                    @endif
                   <!-- <form class="validate" action="{{ route('users.store')}}" method="post" data-success="Sent! Thank you!" data-toastr-position="top-right"> -->
                    <fieldset>
                        <!-- required [php action request] -->
                        <input type="hidden" name="action" value="contact_send" />
                         <div class="col-md-6">


                                 <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10">
                                            <label>Product Category </label>
                                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
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
                                   <i class="fa fa-check"></i>  <?= (!isset($product_category->id)) ? "Save" : "Update" ?>
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