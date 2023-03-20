@extends('layouts.master')

@section('title', __('title.register'))

@section('content')
    <h3>@lang('titles.register')</h3>

    <div class="form-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label for="name">@lang('form.user_name')</label>
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

            <label for="email">@lang('form.email')</label>
            <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                placeholder="E-mail"
                value="{{ old('email') }}"
                required autocomplete="email">
            @include('layouts.error', ['fieldName' => 'email'])

            <label for="password">@lang('form.password')</label>
            <input
                id="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="Password"
                required autocomplete="new-password">
            @include('layouts.error', ['fieldName' => 'password'])

            <label for="password-confirm">@lang('form.password_confirm')</label>
            <input
                id="password-confirm"
                type="password"
                name="password_confirmation"
                placeholder="Confirm password"
                required autocomplete="new-password">

            <input type="submit" name="register" value="@lang('buttons.register')">
        </form>
    </div>
@endsection
