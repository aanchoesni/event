@if (Auth::user()->role == 'admin')
<?php $layout = 'layouts.masteradmin'; ?>
@else
<?php $layout = 'layouts.masteruser'; ?>
@endif
@extends($layout)

@section('title')
  Master Event
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
                Master Event
            </header>
            <br><div style="padding-left: 15px"><a href="{{URL::to('admin/events/create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Tambah</a></div>
            <div class="panel-body"  style:"overflow: scroll;">
              <div class="adv-table">
                  <table  class="display table table-bordered" id="tbmaster">
                    <thead>
                      <tr>
                        <th style="text-align:center;" width="5%">No</th>
                        <th style="text-align:center;" width="20%">Nama</th>
                        <th style="text-align:center;" width="20%">Event</th>
                        <th style="text-align:center;" width="10%">Tipe Peserta</th>
                        <th style="text-align:center;" width="10%">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $no = 1; ?>
                      @foreach($events as $value)
                        @if ($value->publication_status != 't')
                        <tr style="background-color: red; color: white;">
                          <td style="text-align:center; background-color: red; color: white;">{!! $no++; !!}</td>
                        @endif
                        @if ($value->publication_status == 't')
                          <tr style="background-color: green; color: white;">
                            <td style="text-align:center; background-color: green; color: white;">{!! $no++; !!}</td>
                        @endif
                          <td>
                              <div style="font-weight: bold;">{!! $value->rCategory->name !!}</div>
                              <div>Judul : {!! $value->title !!}</div>
                              <div>Tema : {!! $value->theme !!}</div>
                          </td>
                          <td>
                              <div>Unit : {!! $value->rUnit->name !!}</div>
                              <div>Tempat : {!! $value->place !!}</div>
                              <div>Tanggal : {!! $value->date !!}</div>
                              <div>Waktu : {!! $value->times !!}</div>
                              <div>Kuota : {!! $value->quota !!}</div>
                          </td>
                          <td>
                              <ol id="{{$value->id}}">
                                @foreach ($value->rType as $types)
                                    <li id="{{$value->id}}_{{$types->id}}">
                                        <div data-id="{{ $value->id }}">
                                            {{ $types->name }}
                                            <span class="btn btn-xs btn-danger btn-del-type" data-id="{{ $types->id }}"><i class="fa fa-times"></i></span>
                                        </div>
                                    </li>
                                @endforeach
                              </ol>
                              <div data-id="{{ $value->id }}" style="vertical-align: bottom;">
                                  {{ Form::select('type', $type, null, array('class' => 'form-control tkh select2','placeholder'=>'- Pilih -', 'required', 'id'=>'type_'.$value->id, 'style'=>'width: 110px;')) }}
                                  <div class="btn btn-default btn-info btn-sm btn-add-type">Submit</div>
                              </div>
                          </td>
                          <td style="text-align:center; vertical-align: middle;">
                            <a href="{{ url('admin/participant/'.$value->id) }}" class="btn btn-success"><i class="fa fa-user"></i></a>

                            <a href="{{ route('events.edit', $value->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>

                            <button class="btn btn-danger" id="btn_delete" data-file="{{$value->id}}"><i class="fa fa-trash-o"></i></button>
                            {{ Form::open(['url'=>route('events.destroy', ['data'=>Crypt::encrypt($value->id)]), 'method'=>'delete', 'id' => 'del_'.$value->id, 'style' => 'display: none;']) }}
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
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('script')
    <script type="text/javascript" src="{!!asset('admin/assets/advanced-datatable/media/js/jquery.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/assets/advanced-datatable/media/js/jquery.dataTables.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/assets/data-tables/DT_bootstrap.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/packages/select2/select2.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/packages/select2/select2.js')!!}"></script>

    <script type="text/javascript" charset="utf-8">
    var urlType = "{{ route('selectype.store') }}";
    var urlTypeDel = "{{ route('selectype.delete') }}";
    $(document).ready(function() {
        $(".select2").select2();
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
                  console.log(data);
                $("#del_"+data).submit();
              }, 1000); // 1 second delay
            }
            else{
              swal("Dibatalkan","Data batal dihapus", "error");
            }
          }
    );});
  </script>
  {{Html::script('js/type.js')}}
@stop
