@extends('layouts.master')

@section('content')
    <h3>{{ __('Dashboard') }}</h3>

    <div class="form-container">
        @if (session('status'))
            <div class="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif
        {{ __('You are logged in!') }}
    </div>
@endsection
