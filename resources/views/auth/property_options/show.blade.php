@extends('layouts.master')

@section('title', __('main.titles.property_option').' '.$propertyOption->__('name'))

@section('content')
    <h3>@lang('main.titles.property_option') "{{ $propertyOption->__('name') }}"</h3>

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
                    <td>{{ $propertyOption->id }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.property')</td>
                    <td>{{ $propertyOption->property->__('name') }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.name')</td>
                    <td>{{ $propertyOption->name }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.name_ru')</td>
                    <td>{{ $propertyOption->name_ru }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
