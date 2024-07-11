@extends('layouts.app')


@section('content')
<?php  $isView = (@$product_sub_category->is_view==1) ? 'readonly' : '';   ?>
<?php  $isSelectView = (@$product_sub_category->is_view==1) ? 'pointer-off' : '';   ?>
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
                  @if(!isset($product_sub_category->id))
                   {!! Form::open(array('route' => 'product-sub-categories.store','method'=>'POST', 'id' => 'product_sub_categories_form','enctype'=>'multipart/form-data')) !!}
                   @else
                     {!! Form::model($product_sub_category, ['id' => 'product_sub_categories_form','enctype'=>'multipart/form-data','method' => 'PATCH','route' => ['product-sub-categories.update', $product_sub_category->id]]) !!}
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
                                            <select class=" form-control select2" {{$isView}} id="product_category_id"  required name="product_category_id">
                                            <option value="">Selec an option</option>
                                            @foreach($categories as $value)
                                               <option {{  $value->id== @$product_sub_category->category_id ? 'selected' : '' }} value="{{ $value->id}}">{{ $value->name}}</option>
                                               @endforeach
                                           </select>

                                           <label id="product_category_id-error" class="error mt-2 text-danger" for="product_category_id" style="display: none"></label>
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10">
                                            <label>Product Sub Category </label>
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
                                   <i class="fa fa-check"></i>  <?= (!isset($product_sub_category->id)) ? "Save" : "Update" ?>
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