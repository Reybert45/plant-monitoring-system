@extends('layouts.auth')

@section('title') Login As Employee @stop

@section('content')
<h4 class="auth-title"><span class="icon dripicons dripicons-user"></span> EMPLOYEE</h4>
<form method="POST" action="{{ route('login') }}" autocomplete="off">
    {{ csrf_field() }}
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="email" name="email" class="form-control form-control-xl" autocomplete="off" placeholder="Email Address" value="{{ old('email') }}" required autofocus />
        <div class="form-control-icon">
            <i class="bi bi-envelope"></i>
        </div>
        @if ($errors->has('email'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" name="password" class="form-control form-control-xl" autocomplete="off" placeholder="Password">
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        @if ($errors->has('password'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
    <button class="btn btn-success btn-block btn-lg shadow-lg mt-4">Log in</button>
</form>
@endsection