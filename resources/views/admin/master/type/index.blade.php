@extends('layouts.masteradmin')

@section('title')
  Master Tipe Peserta
@stop

@section('asset')
    <link href="{!!asset('admin/assets/advanced-datatable/media/css/demo_page.css')!!}" rel="stylesheet">
    <link href="{!!asset('admin/assets/advanced-datatable/media/css/demo_table.css')!!}" rel="stylesheet">
    <link href="{!!asset('admin/packages/select2/select2.css')!!}" rel="stylesheet">
    <link href="{!!asset('admin/packages/select2/select2-bootstrap.css')!!}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .tkh {
            color: black;
        }
	</style>
@stop

@section('content')
<!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Master Tipe Peserta
            </header>
            <br><div style="padding-left: 15px"><a href="{{URL::to('admin/type/create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Tambah</a></div>
            <div class="panel-body"  style:"overflow: scroll;">
              <div class="adv-table">
                  <table  class="display table table-bordered table-striped" id="tbmaster">
                    <thead>
                      <tr>
                        <th style="text-align:center;" width="5%">No</th>
                        <th style="text-align:center;" width="20%">Nama</th>
                        <th style="text-align:center;">Deskripsi</th>
                        <th style="text-align:center;" width="10%">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $no = 1; ?>
                      @foreach($types as $value)
                        <tr>
                          <td style="text-align:center;">{!! $no++; !!}</td>
                          <td>{!! $value->name !!}</td>
                          <td>{!! $value->description !!}</td>
                          <td style="text-align:center;">
                            <a href="{{ route('type.edit', $value->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>

                            <button class="btn btn-danger btn-xs" id="btn_delete" data-file="{{$value->id}}"><i class="fa fa-trash-o"></i></button>
                            {{ Form::open(['url'=>route('type.destroy', ['data'=>Crypt::encrypt($value->id)]), 'method'=>'delete', 'id' => $value->id, 'style' => 'display: none;']) }}
                            {{ csrf_field() }}
                            {{ Form::close() }}
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
        </section>
    </div>
</div>
<!-- page end-->
@stop

@section('script')
    <script type="text/javascript" src="{!!asset('admin/assets/advanced-datatable/media/js/jquery.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/assets/advanced-datatable/media/js/jquery.dataTables.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/assets/data-tables/DT_bootstrap.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/assets/data-tables/DT_bootstrap.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/packages/select2/select2.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/packages/select2/select2.js')!!}"></script>

    <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $("#categories_id").select2();
        $('#tbmaster').dataTable();
    });

    $('button#btn_delete').on('click', function(e){
                e.preventDefault();
                var data = $(this).attr('data-file');

                swal({
                  title             : "Apakah Anda Yakin?",
                  text              : "Anda akan menghapus data ini!",
                  type              : "warning",
                  showCancelButton  : true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText : "Yes",
                  cancelButtonText  : "No",
                  closeOnConfirm    : false,
                  closeOnCancel     : false
                },
          function(isConfirm){
            if(isConfirm){
              swal("Terhapus","Data berhasil dihapus", "success");
              setTimeout(function() {
                $("#"+data).submit();
              }, 1000); // 1 second delay
            }
            else{
              swal("Dibatalkan","Data batal dihapus", "error");
            }
          }
    );});

    $('button#btn_aktif').on('click', function(e){
                e.preventDefault();
                var data = $(this).attr('data-file');

                swal({
                  title             : "Apakah Anda yakin?",
                  text              : "Responden ini dipakai!",
                  type              : "warning",
                  showCancelButton  : true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText : "Yes",
                  cancelButtonText  : "No",
                  closeOnConfirm    : false,
                  closeOnCancel     : false
                },
          function(isConfirm){
            if(isConfirm){
              swal("Dipakai","Responden dipakai", "success");
              setTimeout(function() {
                $("#aktif_"+data).submit();
              }, 1000); // 1 second delay
            }
            else{
              swal("cancelled","Dibatalkan", "error");
            }
          }
    );});

    $('button#btn_naktif').on('click', function(e){
                e.preventDefault();
                var data = $(this).attr('data-file');

                swal({
                  title             : "Apakah Anda yakin?",
                  text              : "Responden ini tidak dipakai!",
                  type              : "warning",
                  showCancelButton  : true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText : "Yes",
                  cancelButtonText  : "No",
                  closeOnConfirm    : false,
                  closeOnCancel     : false
                },
          function(isConfirm){
            if(isConfirm){
              swal("Dipakai","Responden tidak dipakai", "success");
              setTimeout(function() {
                $("#non_aktif_"+data).submit();
              }, 1000); // 1 second delay
            }
            else{
              swal("cancelled","Dibatalkan", "error");
            }
          }
    );});
  </script>
@stop
