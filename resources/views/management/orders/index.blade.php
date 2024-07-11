@extends('layouts.app')


@section('content')
  @include('layouts.additionalscripts.adddatatable')




  <div id="content" class="padding-20">

              @if ($message = Session::get('success'))
              <div class="alert alert-success">
                <p>{{ $message }}</p>
              </div>
              @endif
              <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>{{ $data['page_management']['title'] ?? "" }}</strong> <!-- panel title -->
                  </span>

                  <!-- right options -->
                  <ul class="options pull-right list-inline">
                
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                    <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                  </ul>
                  <!-- /right options -->

                </div>

                <!-- panel content -->
                <div class="panel-body">

                  <table class="table table-striped table-bordered table-hover table-responsive data-table">
                    <thead>
                      <tr>
                        <th>Customer Name</th>
                        <th>Email </th>
                        <th>Phone No </th>
                        <th>Item Qty</th>
                        <th>Total Amount</th>
                        <th width="20%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>

                </div>
                <!-- /panel content -->

              </div>
              <!-- /PANEL -->

            </div>
          @endsection

          @section('pagelevelscript')
          <script type="text/javascript">
             $(function () {
               reloadTbl();
            });


            function reloadTbl(load=false){
              if(load){
                $('.data-table').DataTable().destroy();
              }
               var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                  url: "{{ route('orders.index') }}",
                  data:  {
                  status :"{{ $status[\Request::segment(2)] }}" ,
                  }
                },
                columns: [
                {data: 'name', name: 'name'},
                {data: 'email', email: 'name'},
                {data: 'phone_no', phone_no: 'name'},
                {data: 'items', items: 'name'},
                {data: 'totalAmount', totalAmount: 'name'},
                {data: 'action', description: 'action', orderable: false, searchable: false},
                ]
              });

             }
          </script>
          @endsection
