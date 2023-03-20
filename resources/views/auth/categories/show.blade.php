@extends('layouts.master')

@section('title', __('title.category').': '.$category->__('name'))

@section('content')
    <h3>@lang('titles.category'): "{{ $category->__('name') }}"</h3>

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
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <td>@lang('form.code')</td>
                    <td>{{ $category->code }}</td>
                </tr>
                <tr>
                    <td>@lang('form.name')</td>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <td>@lang('form.name_ru')</td>
                    <td>{{ $category->name_ru }}</td>
                </tr>
                <tr>
                    <td>@lang('form.description')</td>
                    <td>{{ $category->description }}</td>
                </tr>
                <tr>
                    <td>@lang('form.description_ru')</td>
                    <td>{{ $category->description_ru }}</td>
                </tr>
                <tr>
                    <td>@lang('form.image')</td>
                    <td><img src="{{ Storage::url(path: $category->image) }}" alt="" height="200"></td>
                </tr>
                <tr>
                    <td>@lang('form.count')</td>
                    <td>{{ $category->products->count() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
