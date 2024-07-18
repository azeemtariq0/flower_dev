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
                    @can('product-category-create')
                    <li>
                      <a href="{{ route('colors.create')}}" class="btn btn-sm btn-success btn_create_new_user">
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

                  <table class="table table-striped table-bordered table-hover table-responsive data-table">
                    <thead>
                      <tr>
                        <th>Color Name</th>
                        <th>Color Code</th>
                        <th>Description</th>
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
                ajax: "{{ route('colors.index') }}",
                columns: [
                {data: 'color_name', color_name: 'name'},
                {data: 'color_code', color_code: 'name'},
                {data: 'description', description: 'name'},
                {data: 'action', description: 'action', orderable: false, searchable: false},
                ]
              });

             }
          </script>
          @endsection