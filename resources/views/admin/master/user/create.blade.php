@extends('layouts.masteradmin')

@section('title')
  Tambah User
@stop

@section('asset')
    <link href="{!!asset('admin/packages/select2/select2.css')!!}" rel="stylesheet">
    <link href="{!!asset('admin/packages/select2/select2-bootstrap.css')!!}" rel="stylesheet">
    <style>
    .tkh {
        color: black;
    }
	</style>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Tambah User
            </header>
            <div class="panel-body">
            	{{ Form::open(array('url' => route('users.store'), 'method' => 'post', 'id' => 'users', 'class'=>'cmxform form-horizontal tasi-form')) }}
                <div class="form-group">
                    {{ Form::label('name', 'Nama User', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::text('name', null, array('class' => 'form-control tkh','placeholder'=>'Nama User')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::text('email', null, array('class' => 'form-control tkh','placeholder'=>'Email')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Password', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::text('password', null, array('class' => 'form-control tkh','placeholder'=>'Password')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('role', 'Role', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::select('role', ['admin'=>'Admin', 'adminevent'=>'Admin Event', 'peserta'=>'Peserta'], null, array('class' => 'form-control tkh','placeholder'=>'- Pilih -', 'required')) }}
                    </div>
                </div>
                <div class="box-footer">
                {{Form::submit('Simpan', array('class'=>'btn btn-danger'))}}
                <a href="{{ URL::route('type.index') }}" class="btn btn-default" type="button">Batal</a>
                </div>
            	{{ Form::close() }}
            </div>
        </section>
    </div>
</div>
@stop

@section('script')
	<script type="text/javascript" src="{!!asset('admin/assets/advanced-datatable/media/js/jquery.js')!!}"></script>
	<script type="text/javascript" src="{!!asset('admin/js/jquery.validate.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/js/form-validation-script.js')!!}"></script>

    <script type="text/javascript" src="{!!asset('admin/packages/select2/select2.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/packages/select2/select2.js')!!}"></script>

    <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $(".select2").select2();
    });
    </script>
@stop
