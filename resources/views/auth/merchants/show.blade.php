@extends('layouts.master')

<?php /** @var App\Models\Merchant $merchant */ ?>

@section('title', __('title.merchant').': '.$merchant->name)

@section('content')
    <h3>@lang('titles.merchant'): "{{ $merchant->name }}"</h3>

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
                    <td>{{ $merchant->id }}</td>
                </tr>
                <tr>
                    <td>@lang('form.name')</td>
                    <td>{{ $merchant->name }}</td>
                </tr>
                <tr>
                    <td>@lang('form.email')</td>
                    <td>{{ $merchant->email }}</td>
                </tr>
                <tr>
                    <td>@lang('form.token')</td>
                    <td>{{ $merchant->api_token }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
