@extends('layouts.master')

@section('title', __('title.coupon').': '.$coupon->code)

@section('content')
    <h3>@lang('titles.coupon') {{ $coupon->code }}</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>@lang('form.field')</th>
                <th>@lang('form.value')</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $coupon->id }}</td>
            </tr>
            <tr>
                <td>@lang('form.code')</td>
                <td>{{ $coupon->code }}</td>
            </tr>
            @isset($coupon->currency)
                <tr>
                    <td>@lang('form.currency')</td>
                    <td>{{ $coupon->currency->code }}</td>
                </tr>
            @endisset
            <tr>
                <td>@lang('form.value')</td>
                <td>{{ $coupon->value }} @if($coupon->isAbsolute()) {{ $coupon->currency->symbol }} @else % @endif</td>
            </tr>
            <tr>
                <td>@lang('form.description')</td>
                <td>{{ $coupon->description }}</td>
            </tr>
            <tr>
                <td>@lang('form.type')</td>
                <td>@if($coupon->isAbsolute()) @lang('form.yes') @else @lang('form.no') @endif</td>
            </tr>
            <tr>
                <td>@lang('form.only_once')</td>
                <td>@if($coupon->isOnlyOnce()) @lang('form.yes') @else @lang('form.no') @endif</td>
            </tr>
            <tr>
                <td>@lang('form.in_use')</td>
                <td>{{ $coupon->orders->count() }}</td>
            </tr>
            @isset($coupon->expired_at)
                <tr>
                    <td>@lang('form.expired_at')</td>
                    <td>{{ $coupon->expired_at->format('d.m.Y') }}</td>
                </tr>
            @endisset
            </tbody>
        </table>
    </div>
@endsection
