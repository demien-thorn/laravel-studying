@extends('layouts.master')

@section('title', __('title.property_option').': '.$propertyOption->__('name'))

@section('content')
    <h3>@lang('titles.property_option') "{{ $propertyOption->__('name') }}"</h3>

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
                    <td>{{ $propertyOption->id }}</td>
                </tr>
                <tr>
                    <td>@lang('form.property')</td>
                    <td>{{ $propertyOption->property->__('name') }}</td>
                </tr>
                <tr>
                    <td>@lang('form.name')</td>
                    <td>{{ $propertyOption->name }}</td>
                </tr>
                <tr>
                    <td>@lang('form.name_ru')</td>
                    <td>{{ $propertyOption->name_ru }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
