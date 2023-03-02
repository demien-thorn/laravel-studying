@extends('layouts.master', ['file' => 'basket'])

@section('title', 'Basket')

@section('content')
    <h3>Basket</h3>
    <div class="undertitle">Place your order here!</div>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th colspan="2">Name</th>
                <th>Amount</th>
                <th>Price</th>
                <th>Cost</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products()->with('category')->get() as $product)
                <tr>
                    <td>
                        <img src="{{ Storage::url(path: $product->image) }}" alt="" width="50px">
                    </td>
                    <td>
                        <a href="{{ route(name: 'product', parameters: [$product->category->code, $product->code]) }}">
                            {{$product->name}}
                        </a>
                    </td>
                    <td>
                        <div class="form-inline">
                            <span class="count-goods">{{ $product->pivot->count }}</span>
                            <form action="{{ route(name: 'basket-remove', parameters: $product) }}" method="post">
                                <button type="submit" class="button-minus">-</button>
                                @csrf
                            </form>
                            <form action="{{ route(name: 'basket-add', parameters: $product) }}" method="post">
                                <button type="submit" class="button-plus">+</button>
                                @csrf
                            </form>
                        </div>
                    </td>
                    <td>{{ $product->price }} UAH</td>
                    <td>{{ $product->getPriceForCount() }} UAH</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><b>Total cost:</b></td>
                <td></td>
                <td><b>{{ $order->getFullSum() }} UAH</b></td>
            </tr>
            <tr>
                <td colspan="5">
                    <a href="{{ route(name: 'basket-place') }}" type="button" class="ordering">Place an order</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
