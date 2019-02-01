@if (Auth::user()->role == 'admin')
<?php $layout = 'layouts.masteradmin'; ?>
@else
<?php $layout = 'layouts.masteruser'; ?>
@endif
@extends($layout)

@section('title')
  Ubah Event
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
                Ubah Event
            </header>
            <div class="panel-body">
                {{ Form::open(array('url' => route('events.update', [$event->id]), 'method' => 'patch', 'id' => 'event', 'class'=>'cmxform form-horizontal tasi-form')) }}
                <div class="form-group">
                    {{ Form::label('title', 'Judul', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::text('title', $event->title, array('class' => 'form-control tkh','placeholder'=>'Judul', 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('theme', 'Tema', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::textarea('theme', $event->theme, array('class' => 'form-control tkh','placeholder'=>'Tema')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('description', 'Deskripsi', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::textarea('description', $event->description, array('class' => 'form-control tkh','placeholder'=>'Deskripsi')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('category_id', 'Kategori', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::select('category_id', $categories, $event->category_id, array('class' => 'form-control tkh','placeholder'=>'- Pilih -', 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('unit_id', 'Unit', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::select('unit_id', $units, $event->unit_id, array('class' => 'form-control tkh','placeholder'=>'- Pilih -', 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('place', 'Tempat', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::text('place', $event->place, array('class' => 'form-control tkh','placeholder'=>'Tempat', 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('date', 'Tanggal', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::text('date', $event->date, array('class' => 'form-control tkh','placeholder'=>'Tanggal', 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('times', 'Waktu', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::text('times', $event->times, array('class' => 'form-control tkh','placeholder'=>'Waktu', 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('quota', 'Kuota', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::text('quota', $event->quota, array('class' => 'form-control tkh','placeholder'=>'Kuota', 'onKeyPress' => 'return event.charCode >= 48 && event.charCode <= 57')) }}
                    </div>
                </div>
                @if (Auth::user()->role == 'admin')
                <div class="form-group">
                    {{ Form::label('publication_status', 'Status Publikasi', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                        {{ Form::checkbox('publication_status', null, $event->publication_status, ['class'=>'checkbox form-control', 'style'=>'width: 20px;']) }}
                    </div>
                </div>
                @endif
                <div class="form-group">
                    {{ Form::label('start_reg', 'Awal Pendaftaran', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::text('start_reg', $event->start_reg, array('class' => 'form-control tkh','placeholder'=>'Awal Pendaftaran', 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('end_reg', 'Akhir Pendaftaran', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                    {{ Form::text('end_reg', $event->end_reg, array('class' => 'form-control tkh','placeholder'=>'Akhir Pendaftaran', 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('pay_status', 'Status Pembayaran', array('class' => 'control-label col-lg-2')) }}
                    <div class="col-lg-10">
                        {{ Form::checkbox('pay_status', null, $event->pay_status, ['class'=>'checkbox form-control', 'style'=>'width: 20px;', 'id'=>'statuspay']) }}
                    </div>
                </div>
                <div id="fmpay" @if ($event->pay_status == false) style="display: none;" @endif>
                    <div class="form-group">
                        {{ Form::label('start_pay', 'Awal Pambayaran', array('class' => 'control-label col-lg-2')) }}
                        <div class="col-lg-10">
                        {{ Form::text('start_pay', $event->start_pay, array('class' => 'form-control tkh','placeholder'=>'Awal Pambayaran')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('end_pay', 'Akhir Pambayaran', array('class' => 'control-label col-lg-2')) }}
                        <div class="col-lg-10">
                        {{ Form::text('end_pay', $event->end_pay, array('class' => 'form-control tkh','placeholder'=>'Akhir Pambayaran')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('bank_name', 'Nama Bank', array('class' => 'control-label col-lg-2')) }}
                        <div class="col-lg-10">
                        {{ Form::text('bank_name', $event->bank_name, array('class' => 'form-control tkh','placeholder'=>'Nama Bank')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('bank_number', 'Nomor Rekening', array('class' => 'control-label col-lg-2')) }}
                        <div class="col-lg-10">
                        {{ Form::text('bank_number', $event->bank_number, array('class' => 'form-control tkh','placeholder'=>'Nomor Rekening')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('bank_owner', 'Atas Nama Rekening', array('class' => 'control-label col-lg-2')) }}
                        <div class="col-lg-10">
                        {{ Form::text('bank_owner', $event->bank_owner, array('class' => 'form-control tkh','placeholder'=>'Atas Nama Rekening')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('cost', 'Biaya', array('class' => 'control-label col-lg-2')) }}
                        <div class="col-lg-10">
                        {{ Form::text('cost', $event->cost, array('class' => 'form-control tkh','placeholder'=>'Biaya', 'onKeyPress' => 'return event.charCode >= 48 && event.charCode <= 57')) }}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                {{Form::submit('Simpan', array('class'=>'btn btn-danger'))}}
                <a href="{{ URL::route('events.index') }}" class="btn btn-default" type="button">Batal</a>
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

    {{Html::script('js/pay.js')}}
@stop
