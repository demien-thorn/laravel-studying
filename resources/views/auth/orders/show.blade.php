@extends('layouts.master')

@section('title', 'Order #'.$order->id)

@section('content')
    <h3>Order #{{ $order->id }}</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>Customer</th>
                <th>Customer's phone</th>
                <th>Ordered at</th>
                <th colspan="2">Product name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Cost</th>
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
                <td colspan="5"><b>Total cost:</b></td>
                <td colspan="2"></td>
                <td><b>{{ $order->calculateFullSum() }} UAH</b></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
