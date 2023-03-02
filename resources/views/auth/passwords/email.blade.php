@extends('layouts.master')

@section('title', 'E-mail')

@section('content')
    <h3>{{ __('Reset Password') }}</h3>

    <div class="form-container">
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label for="email">{{ __('Email Address') }}</label>
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
            <input type="submit" value="{{ __('Send Password Reset Link') }}">
        </form>
    </div>
@endsection
