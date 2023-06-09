@extends('layouts.master')

@section('title', __('title.auth'))

@section('content')
    <div class="form-container form-signin w-100 m-auto">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">@lang('titles.auth')</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" value="{{ old('email') }}">
                <label for="floatingInput">@lang('form.email')</label>
                @include('layouts.error', ['fieldName' => 'email'])
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password">
                <label for="floatingPassword">@lang('form.password')</label>
                @include('layouts.error', ['fieldName' => 'password'])
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember" value="remember-me" {{ old('remember') ? 'checked' : '' }}>
                    @lang('buttons.remember')
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">@lang('buttons.auth')</button>
            <br>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">@lang('auth/login.forgot')</a>
            @endif
        </form>
    </div>
@endsection
