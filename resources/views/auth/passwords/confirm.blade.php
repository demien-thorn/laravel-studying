@extends('layouts.master')

@section('title', 'Подтверждение')

@section('content')
    <h3>{{ __('Confirm Password') }}</h3>

    <div class="form-container">
        {{ __('Please confirm your password before continuing.') }}

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <label for="password">{{ __('Password') }}</label>
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

            <input type="submit" value="{{ __('Confirm Password') }}">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </form>
    </div>
@endsection
