@extends('layouts.app')


@section('content')


<style type="text/css">
  
  form .row {
    margin-bottom: 12px;
}

</style>
<?php  $isView = (@$product->is_view==1) ? 'readonly' : '';   ?>
<?php  $isSelectView = (@$product->is_view==1) ? 'pointer-off' : '';   ?>
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
                  @if(!isset($product->id))
                   {!! Form::open(array('route' => 'products.store','method'=>'POST', 'id' => 'product_id','enctype'=>'multipart/form-data')) !!}
                   @else
                     {!! Form::model($product, ['id' => 'product_id','enctype'=>'multipart/form-data','method' => 'PATCH','route' => ['products.update', $product->id]]) !!}
                    @endif


                    <input type="hidden" id="old_product_sub_category_id" value="{{ @$product->product_sub_category_id }}" />
                   <!-- <form class="validate" action="{{ route('users.store')}}" method="post" data-success="Sent! Thank you!" data-toastr-position="top-right"> -->
                    <fieldset>
                        <!-- required [php action request] -->
                        <input type="hidden" name="action" value="contact_send" />
                         <div class="col-md-6">


                                 <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10">
                                            <label>Product Code </label>
                                            {!! Form::text('product_code', null, array('placeholder' => 'Auto','class' => 'form-control','readonly'=>true)) !!}
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10">
                                            <label>Product Category </label>
                                            <select class=" form-control select2" {{$isView}} id="product_category_id"  required name="product_category_id">
                                            <option value="">Selec an option</option>
                                            @foreach($categories as $value)
                                               <option {{  $value->id== @$product->product_category_id ? 'selected' : '' }} value="{{ $value->id}}">{{ $value->name}}</option>
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
                                            <select class=" form-control select2" {{$isView}} id="product_sub_category_id"   name="product_sub_category_id">
                                            <option value="">Selec an option</option>
                                           
                                           </select>
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10">
                                            <label>Product Name </label>
                                            {!! Form::text('product_name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10">
                                            <label>Sell Price </label>
                                            {!! Form::text('sell_price', null, array('placeholder' => 'Sell Price','class' => 'form-control')) !!}
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

                             <div class="col-md-6">

                                <div class="panel-body">

                  <table class="table table-striped table-bordered table-hover table-responsive data-table">
                    <thead>
                      <tr>
                        <th>Sr.</th>
                        <th>Upload Image</th>
                        <th>Image</th>
                       <th  class="center" width="10%"><button type="button" class="btn btn-default btn-xs" id="addNew"><i class="fa fa-plus"></i></button></th>
                      </tr>
                    </thead>
                    <tbody id="tbody">

                        @if(isset($product['product_detail']) && $product['product_detail']->toArray() )
                          @foreach($product->product_detail as $key => $row)
                         
                            <tr> 
                              <td class="text-center count">{{ $key+1 }}</td>
                              <td><input type="file" name="product_image[]" class="form-control" >
                              <input type="hidden" name="old_product_image[]" value="{{ $row['image'] }}" ></td>
                              <td><img src="{{ asset('products/'.$row["image"]) }}" with="80" height="80"></td>
                              <td><button type="button" class="btn btn-default btn-xs removeBtn"><i class="fa fa-trash"></i></button></td>
                          </tr>
                          @endforeach
                        @else

                          <tr>
                            <td class="text-center count">1</td>
                            <td><input type="file" name="product_image[]" class="form-control"></td>
                            <td></td>
                            <td><button type="button" class="btn btn-default btn-xs removeBtn"><i class="fa fa-trash"></i></button></td>
                        </tr>

                        @endif


                    </tbody>
                  </table>

                </div>
                            </div>



                        </fieldset>
                        @if($isView=="")
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" onclick="save()" class="btn btn-info margin-top-30 pull-right">
                                   <i class="fa fa-check"></i>  <?= (!isset($product->id)) ? "Save" : "Update" ?>
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
@include('management/products/validate')
@endsection

