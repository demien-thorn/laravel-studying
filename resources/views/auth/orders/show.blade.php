@extends('layouts.master')

@section('title', __('title.order').'#'.$order->id)

@section('content')
    <h3>@lang('titles.order') #{{ $order->id }}</h3>
    <div class="undertitle">@lang('auth/orders/show.customer'): {{ $order->name }}</div>
    <div class="undertitle">@lang('auth/orders/show.phone'): {{ $order->phone }}</div>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>@lang('auth/orders/show.ordered_at')</th>
                <th colspan="2">@lang('auth/orders/show.product')</th>
                <th>@lang('auth/orders/show.quantity')</th>
                <th>@lang('auth/orders/show.price')</th>
                <th>@lang('auth/orders/show.cost')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($skus as $sku)
                <tr>
                    <td>{{ $order->created_at }}</td>
                    <td><img src="{{ Storage::url(path: $sku->product->image) }}" alt="" height="50"></td>
                    <td>
                        <a href="{{ route(
                            name: 'sku',
                            parameters: [$sku->product->category->code, $sku->product->code, $sku]) }}">
                            {{ $sku->product->__('name') }}
                        </a>
                    </td>
                    <td><span class="button-minus">{{ $sku->pivot->count }}</span></td>
                    <td>{{ $sku->pivot->price }} {{ $order->currency->symbol }}</td>
                    <td>{{ $sku->pivot->price * $sku->pivot->count }} {{ $order->currency->symbol }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><b>@lang('auth/orders/show.total'):</b></td>
                <td colspan="2"></td>
                <td><b>{{ $order->sum }} {{ $order->currency->symbol }}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
