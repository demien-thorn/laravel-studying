@extends('layouts.master')

@section('title', 'Orders')

@section('content')
    <h3>@lang('auth/orders/main.title')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('auth/orders/main.name')</th>
                <th>@lang('auth/orders/main.phone')</th>
                <th>@lang('auth/orders/main.ordered_at')</th>
                <th>@lang('auth/orders/main.total')</th>
                <th>@lang('auth/orders/main.actions')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at->format('H:i, d M Y') }}</td>
                    <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                    <td>
                        <a class="button_extra_small" type="button"
                            @admin
                                href="{{ route(name: 'orders.show', parameters: $order) }}"
                            @else
                                href="{{ route(name: 'person.orders.show', parameters: $order) }}"
                            @endadmin>
                            @lang('main.buttons.open')
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
