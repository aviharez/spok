@extends('layouts.master')
@section('title_site', 'List Permintaan')
@section('list_permintaan', 'active')
@section('title_page', 'List Permintaan')


@section('button_header')
  <a class="btn btn-success" data-backdrop="static" data-keyboard="false" href="/order/create">
    <i class="fa fa-plus mr-1"></i>Buat Permintaan</a>
@endsection

@section('breadcumb_nav')
    <li class="breadcrumb-item">Permintaan
    </li>
    <li class="breadcrumb-item active">List Permintaan</li>
@endsection

@section('content')
      <div class="content-header row">
        <div class="content-header-right col-md-4 col-12">
          <div class="btn-group float-md-right">
          </div>
        </div>
      </div>
      <div class="content-detached content-right">
        <div class="content-body">
          <section class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Permintaan</h4>
                  <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <!-- Task List table -->
                    <div class="table-responsive">
                      <table id="ordertable" data-order='[[ 0, "desc" ]]' class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle zero-configuration" width="100%">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Peminta</th>
                            <th>Keterangan</th>
                            <th>Eksekutor</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody id="fbody">
                          @foreach ($orders as $item)
                          <tr>
                              <td>{{ $item->id }}</td>
                              <td>{{ $item->pegawais->nama }}</td>
                              <td>{{ $item->description }}</td>
                              <td>{{ $item->executors->nama }}</td>
                              <td>
                                @if ($item->status == 'Waiting')
                                  <span class="badge badge-info">{{ $item->status }}</span>
                                @endif
                                @if ($item->status == 'Queue')
                                  <span class="badge badge-warning">{{ $item->status }}</span>
                                @endif
                                @if ($item->status == 'On Progress')
                                  <span class="badge badge-primary">{{ $item->status }}</span>
                                @endif
                                @if ($item->status == 'Rejected')
                                  <span class="badge badge-danger">{{ $item->status }}</span>
                                @endif
                                @if ($item->status == 'Finished')
                                  <span class="badge badge-success">{{ $item->status }}</span>
                                @endif
                              </td>
                              <td class="action-menu" data-order_id="{{ $item->id }}" data-nama="{{ $item->pegawais->nama }}" data-executor="{{ $item->executors->nama }}">
                                      <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                      <div class="dropdown-menu" x-placement="bottom-start">
                                        @if ($item->status == 'Waiting')
                                            <a data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#update" class="dropdown-item update" data-order_id="{{ $item->id }}" data-nama="{{ $item->pegawais->nama }}" data-executor="{{ $item->executors->nama }}">Edit</a>    
                                        @endif
                                        <a data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#detail" class="dropdown-item preview"  data-order_id="{{ $item->id }}" data-nama="{{ $item->pegawais->nama }}" data-executor="{{ $item->executors->nama }}">Detail</a>
                                        <a href="{{ route('pdf', $item->id) }}" target="_blank" class="dropdown-item">Preview</a>
                                      </div>
                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
      <div class="sidebar-detached sidebar-left">
        <div class="sidebar">
          <div class="bug-list-sidebar-content">
            <!-- Predefined Views -->
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Status</h4>
                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
              </div>
                <!-- bug-list view -->
                <div class="card-body ">
                  <div class="list-group" id="list">
                    <a class="list-group-item list-group-item-action active" id="l_all">Semua</a>
                    <a class="list-group-item list-group-item-action" id="l_waiting">Waiting</a>
                    <a class="list-group-item list-group-item-action" id="l_queue">Queue</a>
                    <a class="list-group-item list-group-item-action" id="l_progress">On Progress</a>
                    <a class="list-group-item list-group-item-action" id="l_rejected">Rejected</a>
                    <a class="list-group-item list-group-item-action" id="l_finished">Finished</a>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Predefined Views -->
          </div>
        </div>
      </div>

      <script type="text/javascript">
        $(document).ready(function() {
             var table = $('#ordertable').DataTable();
             $('#l_all').on('click', function() {
                $('#list a').removeClass('active');
                $(this).toggleClass('active');
                var bd = $('#fbody').find('tr');
                bd.show();
             });
             $('#l_waiting').on('click', function() {
                $('#list a').removeClass('active');
                $(this).toggleClass('active');
                filterStatus('Waiting');
             });
              $('#l_queue').on('click', function() {
              $('#list a').removeClass('active');
                $(this).toggleClass('active');
                filterStatus('Queue');
             });
              $('#l_progress').on('click', function() {
              $('#list a').removeClass('active');
                $(this).toggleClass('active');
                filterStatus('Progress');
             });
              $('#l_rejected').on('click', function() {
              $('#list a').removeClass('active');
                $(this).toggleClass('active');
                filterStatus('Rejected');
             });
              $('#l_finished').on('click', function() {
              $('#list a').removeClass('active');
                $(this).toggleClass('active');
                filterStatus('Finished');
             });

             $('.preview').click(function() {
                window.item_id = $(this).data('order_id');
                window.nama = $(this).data('nama');
                window.executor = $(this).data('executor');
              });

             $('.update').click(function() {
                window.item_id = $(this).data('order_id');
                window.nama = $(this).data('nama');
                window.executor = $(this).data('executor');
             }) 
            
              $('#detail').on('shown.bs.modal', function(e) {
                var id = window.item_id;
                var nama = window.nama;
                var executor = window.executor;
                console.log(id);
                var url = '/detail-order/'+id;
                $.ajax({
                  url: url,
                  type: "GET",
                  dataType: "json",
                  success: function (data) {
                    console.log(data);
                      $('#peminta').val(nama);
                      $('#tanggal').val(data.created_at);
                      $('#kd_mesin').val(data.kd_mesin);
                      $('#description').text(data.description);
                      $('#prioritas').val(data.priority);
                      $('#eksekutor').val(executor);
                      $('#pop').val(data.penghentian);
                      $('#ketentuan').val(data.ketentuan);
                      $('#status').val(data.status);
                      $('#approved_at').val(data.approved_at);
                      $('#confirmed_at').val(data.confirmed_at);
                      $('#confirmed_by').val(data.confirmed_by);
                      $('#finished_at').val(data.finished_at);
                      $('#keterangan').text(data.keterangan);
                      $('#btapprove').hide();
                  }
                });
              });

              $('#update').on('shown.bs.modal', function(e) {
                var id = window.item_id;
                var nama = window.nama;
                var executor = window.executor;
                console.log(id);
                var url = '/detail-order/'+id;
                $.ajax({
                  url: url,
                  type: "GET",
                  dataType: "json",
                  success: function (data) {
                    console.log(data);
                      $('#id_update').val(data.id);
                      $('#peminta_update').val(nama);
                      $('#tanggal_update').val(data.created_at);
                      $('#kd_mesin_update').val(data.kd_mesin);
                      $('#description_update').text(data.description);
                      $('#prioritas_update').val(data.priority);
                      $('#eksekutor_update').val(data.executor_id);
                      $('#pop_update').val(data.penghentian);
                      $('#ketentuan_update').val(data.ketentuan);
                      $('#status_update').val(data.status);
                      $('#approved_at_update').val(data.approved_at);
                      $('#confirmed_at_update').val(data.confirmed_at);
                      $('#confirmed_by_update').val(data.confirmed_by);
                      $('#finished_at_update').val(data.finished_at);
                      $('#keterangan_update').text(data.keterangan);
                  }
                });
              });

        }); 

        

        function filterStatus(status) {
          var bd = $('#fbody').find('tr');
                var data = status;
                bd.hide();
                bd.filter(function (i,v) {
                  var $t = $(this);
                  for (var d = 0; d < data.length; ++d) {
                    if ($t.is(":contains('" + status + "')")) {
                      return true;
                    }
                    return false;
                  }
                }).show();
        }                        

     </script>

      <div class="modal fade text-left" id="detail" tabindex="-1" role="dialog" aria-hidden="true">
        @include('modals.detail')
    
      </div>

      <div class="modal fade text-left" id="update" tabindex="-1" role="dialog" aria-hidden="true">
          @include('modals.update')
      
        </div>

    {{-- </div> --}}
  {{-- </div> --}}
@endsection

@section('customjs')

<script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../../assets/datatables/datatables.min.css"/>
<script type="text/javascript" src="../../../assets/datatables/datatables.min.js"></script>

@endsection