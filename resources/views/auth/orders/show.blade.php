@extends('layouts.master')

<?php /** @var App\Models\Order $order */ ?>

@section('title', __('title.order').'#'.$order->id)

@section('content')
    <h3>@lang('titles.order') #{{ $order->id }}</h3>
    <div class="undertitle">@lang('form.customer'): {{ $order->name }}</div>
    <div class="undertitle">@lang('form.phone'): {{ $order->phone }}</div>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>@lang('form.ordered_at')</th>
                <th colspan="2">@lang('form.product')</th>
                <th>@lang('form.quantity')</th>
                <th>@lang('form.price')</th>
                <th>@lang('form.cost')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($skus as $sku)
                <tr>
                    <td>{{ $order->created_at }}</td>
                    <td><img src="{{ Storage::url(path: $sku->product->image) }}" alt="" height="50"></td>
                    <td><a href="{{ route(
                        name: 'sku',
                        parameters: [$sku->product->category->code, $sku->product->code, $sku]) }}">
                        {{ $sku->product->__('name') }}
                    </a></td>
                    <td><span class="button-minus">{{ $sku->pivot->count }}</span></td>
                    <td>{{ $sku->pivot->price }} {{ $order->currency->symbol }}</td>
                    <td>{{ $sku->pivot->price * $sku->pivot->count }} {{ $order->currency->symbol }}</td>
                </tr>
            @endforeach
            @if($order->hasCoupon())
                <tr>
                    <td colspan="3">@lang('form.coupon_used'):</td>
                    <td colspan="2"></td>
                    <td><b><a href="{{ route(name: 'coupons.show', parameters: $order->coupon) }}">
                        {{ $order->coupon->code }}
                    </a></b></td>
                </tr>
            @endif
            <tr>
                <td colspan="3"><b>@lang('form.total'):</b></td>
                <td colspan="2"></td>
                <td><b>{{ $order->sum }} {{ $order->currency->symbol }}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
