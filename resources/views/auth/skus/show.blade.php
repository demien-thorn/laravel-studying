@extends('layouts.master')

<?php /** @var App\Models\Sku $sku */ ?>

@section('title', __('title.sku').' '.$sku->product->__('name'))

@section('content')
    <h3>@lang('titles.sku') "{{ $sku->product->__('name') }}"</h3>
    <h4>{{ $sku->propertyOptions->map->__('name')->implode(', ')  }}</h4>

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
                    <td>{{ $sku->id }}</td>
                </tr>
                <tr>
                    <td>@lang('form.price')</td>
                    <td>{{ $sku->price }}</td>
                </tr>
                <tr>
                    <td>@lang('form.quantity')</td>
                    <td>{{ $sku->count }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
