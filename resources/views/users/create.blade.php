@extends('layouts.app')


@section('content')

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
       <div class="colm-md-12 row" style="margin-top: 10px;">
    <div class="col-md-11"></div>
</div>

       <div id="content" class="padding-20">

        <div class="row">

            <div class="col-md-6">

                <!-- ------ -->
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>{{ $data['page_management']['title'] ?? "" }}</strong>
                    </div>

                    <div class="panel-body">

                    
                             @if(!isset($user->id))
                                {!! Form::open(array('route' => 'users.store','method'=>'POST', 'id' => 'users_form')) !!}
                                @else
                                {!! Form::model($user, ['id'=>'users_form','method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                                @endif
                       <!-- <form class="validate" action="{{ route('users.store')}}" method="post" data-success="Sent! Thank you!" data-toastr-position="top-right"> -->
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" id="soceity_id" name="soceity_id" value="{{ auth()->user()->soceity_id }}" />
                            <input type="hidden" id="block_hidden" value="{{ @$user->block_id }}" />
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Name *</label>
<!--                                         <input type="text" name="contact[first_name]" value="" class="form-control required"> -->
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control required')) !!}




                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Email *</label>
                                        <!-- <input type="email" name="contact[email]" value="" class="form-control required"> -->
                                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control required')) !!}
                                    </div>
                                </div>
                            </div>

                        

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Password *</label>
                                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control required')) !!}
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Confirm Password *</label>
                                        <!-- <input type="text" name="contact[start_date]" value="" class="form-control datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false"> -->
                                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control required')) !!}
                                    </div>
                                </div>
                            </div>
        
                        </fieldset>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info margin-top-30 pull-right">
                                   <i class="fa fa-check"></i>  <?= (!isset($user->id)) ? "Save" : "Update" ?>
                               </button>
                           </div>
                       </div>

                        {!! Form::close() !!}

                    </div>

                </div>
                <!-- /----- -->

            </div>



        </div>

    </div>


</div>





<script type="text/javascript">
    
        $('#project').on('change', function() {
        var id = $(this).val();
        if (id) {
            $.ajax({
               url: '<?= env('APP_BASEURL') ?>/get-blocks',
                type: 'post',
                dataType: 'json',
                 headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
	       data:{'project_id':id,'_token':'{{ csrf_token() }}'},
                success: function(data) {
                    $('#block').empty();
                    $('#block').append('<option value="">Select Block</option>');
                    $.each(data, function(key, value) {
                        $('#block').append('<option value="' + value.id + '">' + value.block_name + '</option>');
                    });
                    $('#block').val($('#block_hidden').val()).trigger('change');;
                }
            });
        } else {
            $('#block').empty();
        }
    });

    $(document).ready(function() {
        $('#project').trigger('change');
    });
</script>





@endsection