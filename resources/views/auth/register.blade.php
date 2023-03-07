@extends('layouts.master')

@section('title', 'Registration')

@section('content')
    <h3>@lang('auth/register.title')</h3>

    <div class="form-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label for="name">@lang('auth/register.name')</label>
            <input
                id="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                name="name"
                placeholder="Name"
                value="{{ old('name') }}"
                required autocomplete="name"
                autofocus>
            @include('layouts.error', ['fieldName' => 'name'])

            <label for="email">@lang('auth/register.email')</label>
            <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                placeholder="E-mail"
                value="{{ old('email') }}"
                required autocomplete="email">
            @include('layouts.error', ['fieldName' => 'email'])

            <label for="password">@lang('auth/register.password')</label>
            <input
                id="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="Password"
                required autocomplete="new-password">
            @include('layouts.error', ['fieldName' => 'password'])

            <label for="password-confirm">@lang('auth/register.confirm_password')</label>
            <input
                id="password-confirm"
                type="password"
                name="password_confirmation"
                placeholder="Confirm password"
                required autocomplete="new-password">

            <input type="submit" name="register" value="@lang('auth/register.send')">
        </form>
    </div>
@endsection
