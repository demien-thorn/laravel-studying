@extends('layouts.master')

@section('title', 'Registration')

@section('content')
    <h3>New user registration</h3>
    {{--{{ __('Register') }}--}}

    <div class="form-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label for="name">
                Username
                {{--{{ __('Name') }}--}}
            </label>
            <input
                id="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                name="name"
                placeholder="Name"
                value="{{ old('name') }}"
                required autocomplete="name"
                autofocus>
            @error('name')
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

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
                required autocomplete="email">
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
                required autocomplete="new-password">
            @error('password')
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password-confirm">
                Confirm password
                {{--{{ __('Confirm Password') }}--}}
            </label>
            <input
                id="password-confirm"
                type="password"
                name="password_confirmation"
                placeholder="Confirm password"
                required autocomplete="new-password">

            <input type="submit" name="register" value="Register!">
            {{--<input type="submit" name="register" value="{{ __('Register') }}!">--}}
        </form>
    </div>
@endsection
