@extends('layouts.master')

@section('title', 'Order #'.$order->id)

@section('content')
    <h3>@lang('auth/orders/show.title') #{{ $order->id }}</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>@lang('auth/orders/show.customer')</th>
                <th>@lang('auth/orders/show.phone')</th>
                <th>@lang('auth/orders/show.ordered_at')</th>
                <th colspan="2">@lang('auth/orders/show.product')</th>
                <th>@lang('auth/orders/show.quantity')</th>
                <th>@lang('auth/orders/show.price')</th>
                <th>@lang('auth/orders/show.cost')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <img src="{{ Storage::url(path: $product->image) }}" alt="" height="50">
                    </td>
                    <td>
                        <a href="{{ route(name: 'product', parameters: [$product->category->code, $product->code]) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td><span class="button-minus">{{ $product->pivot->count }}</span></td>
                    <td>{{ $product->price }} UAH</td>
                    <td>{{ $product->getPriceForCount() }} UAH</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5"><b>@lang('auth/orders/show.total'):</b></td>
                <td colspan="2"></td>
                <td><b>{{ $order->calculateFullSum() }} UAH</b></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection