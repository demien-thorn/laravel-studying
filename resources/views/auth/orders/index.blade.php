@extends('layouts.master')

<?php /** @var App\Models\Order $orders */ ?>

@admin
    @section('title', __('title.orders_admin'))
@else
    @section('title', __('title.orders'))
@endadmin

@section('content')
    @admin
        <h3>@lang('titles.orders_admin')</h3>
    @else
        <h3>@lang('titles.orders')</h3>
    @endadmin

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('form.name')</th>
                <th>@lang('form.phone')</th>
                <th>@lang('form.ordered_at')</th>
                <th>@lang('form.total')</th>
                <th>@lang('form.actions')</th>
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
                    <td><a class="button_extra_small" type="button"
                        @admin
                            href="{{ route(name: 'orders.show', parameters: $order) }}"
                        @else
                            href="{{ route(name: 'person.orders.show', parameters: $order) }}"
                        @endadmin>
                        @lang('buttons.open')
                    </a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
