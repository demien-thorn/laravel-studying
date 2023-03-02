@extends('layouts.master')

@section('title', 'Orders')

@section('content')
    <h3>Orders</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Ordered at</th>
                <th>Total cost</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at->format('H:i, d M Y') }}</td>
                    <td>{{ $order->getFullSum() }} UAH</td>
                    <td>
                        <a
                            @admin
                                href="{{ route(name: 'orders.show', parameters: $order) }}"
                            @else
                                href="{{ route(name: 'person.orders.show', parameters: $order) }}"
                            @endadmin
                            class="button_extra_small"
                            type="button">Open
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
