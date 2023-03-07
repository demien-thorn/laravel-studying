@extends('layouts.master', ['file' => 'order'])

@section('title', 'Checkout')

@section('content')
    <h3>@lang('order.title')</h3>

    <div class="content-main clearfix">
        <div class="form-container">
            <div class="small-text">
                @lang('order.cost') <b>{{ $order->calculateFullSum() }} <i class="fa-solid fa-hryvnia-sign"></i></b><br>
                @lang('order.info')
            </div>
            <form action="{{route(name: 'basket-confirm')}}" method="post">
                @csrf
                <label for="name">@lang('order.name')</label>
                <input type="text" name="name" id="name" placeholder="Name">
                <label for="phone">@lang('order.phone')</label>
                <input type="text" name="phone" id="phone" placeholder="Phone">
                @guest
                    <label for="email">@lang('order.email')</label>
                    <input type="email" name="email" id="email" placeholder="E-mail">
                @endguest
                <input type="submit" value="@lang('order.confirm')">
            </form>
        </div>
    </div>
@endsection
