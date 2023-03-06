@extends('layouts.master')

@section('title', 'Категория '.$category->__('name'))

@section('content')
    <h3>@lang('auth/categories/show.title') {{ $category->__('name') }}</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>@lang('auth/categories/show.field')</th>
                <th>@lang('auth/categories/show.value')</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $category->id }}</td>
            </tr>
            <tr>
                <td>@lang('auth/categories/show.code')</td>
                <td>{{ $category->code }}</td>
            </tr>
            <tr>
                <td>@lang('auth/categories/show.name')</td>
                <td>{{ $category->name }}</td>
            </tr>
            <tr>
                <td>@lang('auth/categories/show.name_ru')</td>
                <td>{{ $category->name_ru }}</td>
            </tr>
            <tr>
                <td>@lang('auth/categories/show.description')</td>
                <td>{{ $category->description }}</td>
            </tr>
            <tr>
                <td>@lang('auth/categories/show.description_ru')</td>
                <td>{{ $category->description_ru }}</td>
            </tr>
            <tr>
                <td>@lang('auth/categories/show.image')</td>
                <td>
                    <img src="{{ Storage::url(path: $category->image) }}" alt="" height="200">
                </td>
            </tr>
            <tr>
                <td>@lang('auth/categories/show.count')</td>
                <td>{{ $category->products->count() }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
