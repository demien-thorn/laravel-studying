@extends('layouts.master')

@section('title', 'Verify')

@section('content')
    <h3>{{ __('Verify Your Email Address') }}</h3>

    <div class="form-container">
        @if (session('resent'))
            <div class="alert" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <input type="submit" value="{{ __('click here to request another') }}">.
        </form>
    </div>
@endsection
