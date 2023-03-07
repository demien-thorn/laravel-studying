@extends('layouts.master')

@section('title', 'Authorization')

@section('content')
    <h3>@lang('auth/login.title')</h3>

    <div class="form-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">@lang('auth/login.email')</label>
            <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                placeholder="E-mail"
                value="{{ old('email') }}"
                required autocomplete="email"
                autofocus>
            @include('layouts.error', ['fieldName' => 'email'])

            <label for="password">@lang('auth/login.password')</label>
            <input
                id="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="Password"
                required autocomplete="current-password">
            @include('layouts.error', ['fieldName' => 'password'])

            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">@lang('auth/login.remember')</label>

            <input type="submit" name="authorize" value="@lang('auth/login.send')">
            <br>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">@lang('auth/login.forgot')</a>
            @endif
        </form>
    </div>
@endsection
