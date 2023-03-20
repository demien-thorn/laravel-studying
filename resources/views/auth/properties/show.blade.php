@extends('layouts.master')

@section('title', __('title.property').': '.$property->__('name'))

@section('content')
    <h3>@lang('titles.property'): "{{ $property->__('name') }}"</h3>

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
                    <td>{{ $property->id }}</td>
                </tr>
                <tr>
                    <td>@lang('form.name')</td>
                    <td>{{ $property->name }}</td>
                </tr>
                <tr>
                    <td>@lang('form.name_ru')</td>
                    <td>{{ $property->name_ru }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
