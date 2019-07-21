@extends('layouts.auth_master')

@section('content')

<div class="login-box">
    <div class="login-logo">

        <a href="{{ route('login') }}" class="text-center"><img src="{{ asset('assets/img/scb.png') }}" class="img-responsive img" style="display: inline-block"></a>
    </div>
        <!-- /.login-logo -->
        <div class="login-box-body" style="background:#eee;">
            <p class="login-box-msg">Sign in to start your session</p>

            @if(session()->has('error'))
                <p class="text-danger">
                     {{ session()->get('error') }}
                </p>
            @endif
        <form method="POST" action="{{ route('post-login') }}">
            @csrf
            <div class="form-group has-feedback">
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control" placeholder="Email" >
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @enderror

            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" required class="form-control" placeholder="Password" >
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
@endsection
