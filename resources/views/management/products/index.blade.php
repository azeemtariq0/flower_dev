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
                    @can('product-create')
                    <li>
                      <a href="{{ route('products.create')}}" class="btn btn-sm btn-success btn_create_new_user">
                        <!-- <i class="et-megaphone"></i> -->
                        <span>{{ $data['page_management']['add'] ?? "" }}</span>
                      </a>
                    </li>
                    @endcan
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                    <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                  </ul>
                  <!-- /right options -->

                </div>

                <!-- panel content -->
                <div class="panel-body">

                  <table class="table table-striped table-bordered table-hover table-responsive data-table" width="100%">
                    <thead>
                      <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Sub Category</th>
                        <th>Sell Price</th>
                        <th>Discription</th>
                        <th>Created Date</th>
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
                ajax: "{{ route('products.index') }}",
                columns: [
                {data: 'product_code', product_code: 'name'},
                {data: 'product_name', product_name: 'name'},
                {data: 'product_code', product_name: 'name'},
                {data: 'product_code', product_name: 'name'},
                {data: 'sell_price', sell_price: 'name'},
                {data: 'description', description: 'name'},
                {data: 'created_at', created_at: 'name'},
                {data: 'action', description: 'action', orderable: false, searchable: false},
                ]
              });

             }
          </script>
          @endsection
