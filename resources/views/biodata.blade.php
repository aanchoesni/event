@if (Auth::user()->role == 'admin')
<?php $layout = 'layouts.masteradmin'; ?>
@else
<?php $layout = 'layouts.masteruser'; ?>
@endif
@extends($layout)

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
    @if (!$userDetail)
    {{ Form::open(array('url' => route('biodata.store'), 'method' => 'post', 'id' => 'biodata', 'class' => 'cmxform tasi-form')) }}
    @else
    {{ Form::open(array('url' => route('biodata.update'), 'method' => 'post', 'id' => 'biodata', 'class' => 'cmxform tasi-form')) }}
    @endif
        <section class="panel">
            <header class="panel-heading">
                Lengkapi Data {!! ucfirst(Auth::user()->role) !!}
            </header>
            <div class="panel-body">
                @if(Auth::user()->login_type != 'sso')
                <div class="form-group">
                    <label for="notlp">Nomor Identitas</label>
                <input type="text" class="form-control tkh" name="noidentitas" id="noidentitas" placeholder="Nomor Identitas" @if ($userDetail->noidentitas) value="{{ $userDetail->noidentitas }}" @else value="{{ old('noidentitas') }}" @endif required>
                </div>
                <div class="form-group">
                    <label for="kodepos">Nama</label>
                    <input type="text" class="form-control tkh" name="name" id="name" placeholder="Nama" value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="type_id">Tipe Peserta</label>
                    @if ($userDetail->type)
                    {{ Form::select('type', ['dosen'=>'Dosen', 'tendik'=>'Tendik', 'mahasiswa'=>'Mahasiswa', 'umum'=>'Umum'], $userDetail->type, ['class' => 'form-control tkh select2','placeholder'=>'- Pilih -', 'required', 'id' => 'type']) }}
                    @else
                    {{ Form::select('type', ['dosen'=>'Dosen', 'tendik'=>'Tendik', 'mahasiswa'=>'Mahasiswa', 'umum'=>'Umum'], old('type'), ['class' => 'form-control tkh select2','placeholder'=>'- Pilih -', 'required', 'id' => 'type']) }}
                    @endif
                </div>
                <div class="form-group">
                    <label for="fakultas">Fakultas/Unit</label>
                    <input type="text" class="form-control tkh" name="fakultas" id="fakultas" placeholder="Fakultas/Unit" @if ($userDetail->fakultas) value="{{ $userDetail->fakultas }}" @else value="{{ old('fakultas') }}" @endif required>
                </div>
                <div class="form-group">
                    <label for="origin">Asal</label>
                    <input type="text" class="form-control tkh" name="origin" id="origin" placeholder="Asal" @if ($userDetail->origin) value="{{ $userDetail->origin }}" @else value="{{ old('origin') }}" @endif required>
                </div>
                @else
                <div class="form-group">
                    <label for="kodepos">Nomor Identitas</label>
                    <input type="text" class="form-control tkh" name="name" id="noidentitasx" placeholder="Nomor Identitas" value="{{ $userDetail->noidentitas }}" readonly>
                </div>
                <div class="form-group">
                    <label for="kodepos">Nama</label>
                    <input type="text" class="form-control tkh" name="name" id="namex" placeholder="Nama" value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="kodepos">Tipe Peserta</label>
                    <input type="text" class="form-control tkh" name="name" id="typex" placeholder="Tipe Peserta" value="{{ ucfirst($userDetail->type) }}" readonly>
                </div>
                <div class="form-group">
                    @if (Auth::user()->role == 'mahasiswa')
                    <label for="fakultas">Fakultas</label>
                    @else
                    <label for="fakultas">Homebase</label>
                    @endif
                    <input type="text" class="form-control tkh" name="name" id="fakultasx" placeholder="Fakultas" value="{{ $userDetail->fakultas }}" readonly>
                </div>
                <div class="form-group">
                    @if (Auth::user()->role == 'mahasiswa')
                    <label for="prodi">Prodi</label>
                    @else
                    <label for="prodi">Satker</label>
                    @endif
                    <input type="text" class="form-control tkh" name="name" id="prodix" placeholder="Prodi" value="{{ $userDetail->prodi }}" readonly>
                </div>
                <div class="form-group">
                    <label for="kodepos">Asal</label>
                    <input type="text" class="form-control tkh" name="name" id="originx" placeholder="Asal" value="{{ $userDetail->origin }}" readonly>
                </div>
                @endif
                @if ($userDetail->phone)
                <div class="form-group">
                    <label for="phone">Nomor HP</label>
                    <input type="text" class="form-control tkh" name="phone" id="phone" placeholder="Nomor HP" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ $userDetail->phone }}" required>
                </div>
                @else
                <div class="form-group">
                    <label for="phone">Nomor HP</label>
                    <input type="text" class="form-control tkh" name="phone" id="phone" placeholder="Nomor HP" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ old('phone') }}" required>
                </div>
                @endif

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
    $(document).ready(function() {
        $(".select2").select2();
    });
    </script>
    {{Html::script('js/inseo.js')}}
@endsection
