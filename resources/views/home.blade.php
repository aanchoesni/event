@if (Auth::user()->role == 'admin' || Auth::user()->role == 'adminevent')
<?php $layout = 'layouts.masteradmin'; ?>
@else
<?php $layout = 'layouts.masteruser'; ?>
@endif
@extends($layout)

@section('title')
  Dashboard
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
  {{Html::script('admin/js/jquery.js')}}
@endsection
