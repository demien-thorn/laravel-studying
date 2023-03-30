@extends('layouts.master', ['file' => 'basket'])

<?php /** @var App\Models\Order $order */ ?>

@section('title', __('title.basket'))

@section('content')
    <h3>@lang('titles.basket')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th colspan="2">@lang('form.name')</th>
                <th>@lang('form.quantity')</th>
                <th>@lang('form.price')</th>
                <th>@lang('form.cost')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->skus as $sku)
                <tr>
                    <td><img src="{{ Storage::url(path: $sku->product->image) }}" alt="" width="50px"></td>
                    <td><a href="{{ route(
                        name: 'sku',
                        parameters: [$sku->product->category->code, $sku->product->code, $sku]) }}">
                        {{ $sku->product->__('name') }}
                    </a></td>
                    <td><div class="form-inline">
                        <span class="count-goods">{{ $sku->countInOrder }}</span>
                        <form action="{{ route(name: 'basket-remove', parameters: $sku) }}" method="post">
                            @csrf
                            <button type="submit" class="button-minus">-</button>
                        </form>
                        <form action="{{ route(name: 'basket-add', parameters: $sku) }}" method="post">
                            @csrf
                            <button type="submit" class="button-plus">+</button>
                        </form>
                    </div></td>
                    <td>{{ $sku->price }} {{ $currencySymbol }}</td>
                    <td>
                        {{ $sku->price * $sku->countInOrder }}
                        {{ $currencySymbol }}
                    </td>
                </tr>
            @endforeach
            <tr><td colspan="5">
                @if(!$order->hasCoupon())
                    <form class="form-container" method="post" action="{{ route(name: 'set-coupon') }}">
                        @csrf
                        <b>@lang('form.add_coupon')</b>
                        <input type="text" name="coupon">
                        <input type="submit" name="" value="@lang('buttons.add')">
                        @include('layouts.error', ['fieldName' => 'coupon'])
                    </form>
                @else
                    <div class="form-container">@lang('notes.coupon_in_use'): {{ $order->coupon->code }}</div>
                @endif
            </td></tr>
            <tr>
                <td colspan="3"><b>@lang('form.total'):</b></td>
                <td></td>
                @if($order->hasCoupon())
                    <td>
                        <strike>{{ $order->getFullSum(false) }}</strike>
                        <b>{{ $order->getFullSum() }}{{ $currencySymbol }}</b>
                    </td>
                @else
                    <td><b>{{ $order->getFullSum() }} {{ $currencySymbol }}</b></td>
                @endif
            </tr>
            <tr><td colspan="5">
                <a href="{{ route(name: 'basket-place') }}" type="button" class="ordering">
                    @lang('form.order')
                </a>
            </td></tr>
            </tbody>
        </table>
    </div>
@endsection
