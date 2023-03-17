@extends('layouts.master')

@section('title', __('main.titles.sku').' '.$sku->product->__('name'))

@section('content')
    <h3>@lang('main.titles.sku') "{{ $sku->product->__('name') }}"</h3>
    <h4>{{ $sku->propertyOptions->map->__('name')->implode(', ')  }}</h4>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
                <tr>
                    <th>@lang('main.table_form.field')</th>
                    <th>@lang('main.table_form.value')</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>{{ $sku->id }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.price')</td>
                    <td>{{ $sku->price }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.quantity')</td>
                    <td>{{ $sku->count }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
