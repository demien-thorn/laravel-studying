@extends('layouts.master')

@section('title', __('main.titles.category').' '.$category->__('name'))

@section('content')
    <h3>@lang('main.titles.category') "{{ $category->__('name') }}"</h3>

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
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.code')</td>
                    <td>{{ $category->code }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.name')</td>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.name_ru')</td>
                    <td>{{ $category->name_ru }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.description')</td>
                    <td>{{ $category->description }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.description_ru')</td>
                    <td>{{ $category->description_ru }}</td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.image')</td>
                    <td><img src="{{ Storage::url(path: $category->image) }}" alt="" height="200"></td>
                </tr>
                <tr>
                    <td>@lang('main.table_form.count')</td>
                    <td>{{ $category->products->count() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
