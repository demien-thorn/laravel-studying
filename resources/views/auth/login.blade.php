@extends('layouts.master')

@section('title', 'Authorization')

@section('content')
    <h3>Authorization</h3>
    {{--{{ __('Login') }}--}}

    <div class="form-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">
                E-mail
                {{--{{ __('Email Address') }}--}}
            </label>
            <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                placeholder="E-mail"
                value="{{ old('email') }}"
                required autocomplete="email"
                autofocus>
            @error('email')
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label for="password">
                Password
                {{--{{ __('Password') }}--}}
            </label>
            <input
                id="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="Password"
                required autocomplete="current-password">
            @error('password')
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input
                type="checkbox"
                name="remember"
                id="remember"
                {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">
                {{ __('Remember Me') }}
            </label>

            <input type="submit" name="authorize" value="Authorize!">
            {{--<input type="submit" name="authorize" value="{{ __('Login') }}!">--}}
            <br>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    Forgot your password?
                    {{--{{ __('Forgot Your Password?') }}--}}
                </a>
            @endif
        </form>
    </div>
@endsection
