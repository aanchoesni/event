@extends('layouts.masteradmin')

@section('title')
    Lengkapi Biodata
@endsection

@section('asset')
    <link href="{!!asset('admin/packages/select2/select2.css')!!}" rel="stylesheet">
    <link href="{!!asset('admin/packages/select2/select2-bootstrap.css')!!}" rel="stylesheet">
    <style>
        .tkh {
        color: black;
        }
    </style>
@endsection

@section('content')
<div class="col-lg-4">
    {{ Form::open(array('url' => route('biodata.update'), 'method' => 'post', 'id' => 'biodata', 'class' => 'cmxform tasi-form')) }}
        <section class="panel">
            <header class="panel-heading">
                Lengkapi Data {!! ucfirst(Auth::user()->role) !!}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label for="notlp">Nomor Identitas</label>
                <input type="text" class="form-control tkh" name="noidentitas" id="noidentitas" placeholder="Nomor Identitas" value="{{ $biodata->noidentitas }}" required>
                </div>
                <div class="form-group">
                    <label for="kodepos">Nama</label>
                    <input type="text" class="form-control tkh" name="name" id="name" placeholder="Nama" value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="type_id">Tipe Peserta</label>
                    {{ Form::select('type_id', $type, $biodata->type_id, ['class' => 'form-control tkh select2','placeholder'=>'- Pilih -', 'required', 'id' => 'type']) }}
                </div>
                {{-- @if ($biodata->type_id != 'd73ecaaa-b3d2-4c96-b37e-868c6a8ff7e5') --}}
                <div class="form-group" id="fmunit">
                    <label for="unit_id">Unit</label>
                    {{ Form::select('unit_id', $unit, $biodata->unit_id, ['class' => 'form-control tkh select2','placeholder'=>'- Pilih -', 'required', 'id' => 'unit']) }}
                </div>
                {{-- @endif --}}
                <div class="form-group">
                    <label for="origin">Asal</label>
                    <input type="text" class="form-control tkh" name="origin" id="origin" placeholder="Asal" value="{{ $biodata->origin }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor HP</label>
                    <input type="text" class="form-control tkh" name="phone" id="phone" placeholder="Nomor HP" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ $biodata->phone }}" required>
                </div>

                <div class="pull-right">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </section>
    {{ Form::close() }}
</div>
<div class="col-lg-8">
    <section class="panel panel-danger">
        <header class="panel-heading">
            Catatan
        </header>
        <div class="panel-body">
        </div>
    </section>
</div>
@endsection

@section('script')
    <script type="text/javascript" src="{!!asset('admin/assets/advanced-datatable/media/js/jquery.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/js/jquery.validate.min.js')!!}"></script>
    <!--script for this page-->
    <script type="text/javascript" src="{!!asset('admin/js/form-validation-script.js')!!}"></script>

    <script type="text/javascript" src="{!!asset('admin/packages/select2/select2.min.js')!!}"></script>
    <script type="text/javascript" src="{!!asset('admin/packages/select2/select2.js')!!}"></script>

    <script type="text/javascript" charset="utf-8">
    var type = "{{ $biodata->type_id }}";
    $(document).ready(function() {
        $(".select2").select2();
    });
    </script>
    {{Html::script('js/inseo.js')}}
@endsection
