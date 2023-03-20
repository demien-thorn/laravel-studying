@extends('layouts.master', ['file' => 'basket'])

@section('title', __('main.titles.basket'))

@section('content')
    <h3>@lang('basket.title')</h3>
    <div class="undertitle">@lang('basket.undertitle')</div>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th colspan="2">@lang('basket.name')</th>
                <th>@lang('basket.amount')</th>
                <th>@lang('basket.price')</th>
                <th>@lang('basket.cost')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->skus as $sku)
                <tr>
                    <td>
                        <img src="{{ Storage::url(path: $sku->product->image) }}" alt="" width="50px">
                    </td>
                    <td>
                        <a href="{{ route(
                            name: 'sku',
                            parameters: [$sku->product->category->code, $sku->product->code, $sku]) }}">
                            {{ $sku->product->__('name') }}
                        </a>
                    </td>
                    <td>
                        <div class="form-inline">
                            <span class="count-goods">{{ $sku->countInOrder }}</span>
                            <form action="{{ route(name: 'basket-remove', parameters: $sku) }}" method="post">
                                <button type="submit" class="button-minus">-</button>
                                @csrf
                            </form>
                            <form action="{{ route(name: 'basket-add', parameters: $sku) }}" method="post">
                                <button type="submit" class="button-plus">+</button>
                                @csrf
                            </form>
                        </div>
                    </td>
                    <td>{{ $sku->price }} {{ $currencySymbol }}</td>
                    <td>
                        {{ $sku->price * $sku->countInOrder }}
                        {{ $currencySymbol }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><b>@lang('basket.total')</b></td>
                <td></td>
                <td><b>{{ $order->getFullSum() }} {{ $currencySymbol }}</b></td>
            </tr>
            <tr>
                <td colspan="5">
                    <a href="{{ route(name: 'basket-place') }}" type="button" class="ordering">@lang('basket.order')</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
