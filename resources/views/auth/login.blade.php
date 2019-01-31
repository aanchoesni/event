@extends('layouts.masterlogin')

@section('style')
  <style>
    .tkh {
      color: black;
    }
  </style>
@endsection

@section('content')
<form class="form-signin" method="POST" action="{{ route('login') }}">
    @csrf
    <h2 class="form-signin-heading">{{ __('Login') }}</h2>
    <div class="login-wrap">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="form-control tkh{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email" required autofocus>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <input type="password" class="form-control tkh" placeholder="Password" name="password" id="password" autofocus>
        <button class="btn btn-lg btn-login btn-block" type="submit">MASUK</button>
        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Tetap Masuk') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="registration tkh">
            Belum punya akun.
            <a class="" href="{{ route('register') }}">
                Daftar
            </a>
        </div>
        <div class="registration tkh">
            Lupa password?
            <a class="" href="{{ route('password.request') }}">
                Reset Password
            </a>
        </div>
  </div>
</form>
@endsection

@section('script')
  <script type="text/javascript" src="https://statik.unesa.ac.id/simalumni_konten_statik/backend/assets/advanced-datatable/media/js/jquery.js"></script>
	<script type="text/javascript" src="https://statik.unesa.ac.id/simalumni_konten_statik/backend/js/jquery.validate.min.js"></script>
  <!--script for this page-->
  <script type="text/javascript" src="https://statik.unesa.ac.id/simalumni_konten_statik/backend/js/form-validation-script.js"></script>
@endsection
