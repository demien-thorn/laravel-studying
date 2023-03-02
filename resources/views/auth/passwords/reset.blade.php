@extends('layouts.master')

@section('title', 'Сброс')

@section('content')
    <h3>{{ __('Reset Password') }}</h3>

    <div class="form-container">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">{{ __('Email Address') }}</label>
            <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                placeholder="E-mail"
                value="{{ $email ?? old('email') }}"
                required autocomplete="email"
                autofocus>
            @error('email')
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password">{{ __('Password') }}</label>
            <input
                id="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="Password"
                required autocomplete="new-password">
            @error('password')
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input
                id="password-confirm"
                type="password"
                class="form-control"
                name="password_confirmation"
                placeholder="Confirm password"
                required autocomplete="new-password">

            <input type="submit" value="{{ __('Reset Password') }}">
        </form>
    </div>
@endsection
