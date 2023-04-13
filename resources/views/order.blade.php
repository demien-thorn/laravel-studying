@extends('layouts.master', ['file' => 'order'])

<?php /** @var App\Models\Order $order */ ?>

@section('title', __('title.checkout'))

@section('content')
    <h3>@lang('titles.checkout')</h3>

    <div class="content-main clearfix">
        <div class="form-container">
            <div class="small-text">
                @lang('order.cost')
                <b>{{ $order->getFullSum() }} {{ $currencySymbol }}</b><br>
                @lang('order.info')
            </div>
            <form action="{{route(name: 'basket-confirm')}}" method="post">
                @csrf
                <label for="name">@lang('order.name')</label>
                <input type="text" name="name" id="name" placeholder="Name" style="display: block">
                <label for="phone">@lang('order.phone')</label>
                <input type="text" name="phone" id="phone" placeholder="Phone" style="display: block">
                @guest
                    <label for="email">@lang('order.email')</label>
                    <input type="email" name="email" id="email" placeholder="E-mail" style="display: block">
                @endguest
                <input type="submit" value="@lang('order.confirm')"
                    class="btn btn-primary btn-lg px-4 fw-bold" style="display: block" >
            </form>
        </div>
    </div>
@endsection
