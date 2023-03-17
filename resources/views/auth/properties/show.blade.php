@extends('layouts.master')

@section('title', __('main.titles.property').' '.$property->__('name'))

@section('content')
    <h3>@lang('main.titles.property') "{{ $property->__('name') }}"</h3>

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
                    <td>{{ $property->id }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.name')</td>
                    <td>{{ $property->name }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.name_ru')</td>
                    <td>{{ $property->name_ru }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
