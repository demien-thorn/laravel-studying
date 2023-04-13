@extends('layouts.master')

<?php /** @var App\Models\Category $product */ ?>

@section('title', __('title.product').': '.$product->__('name'))

@section('content')
    <h3>{{ $product->__('name') }}</h3>

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
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <td>@lang('form.code')</td>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <td>@lang('form.name')</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>@lang('form.name_ru')</td>
                <td>{{ $product->name_ru }}</td>
            </tr>
            <tr>
                <td>@lang('form.category')</td>
                <td>{{ $product->category_id }}</td>
            </tr>
            <tr>
                <td>@lang('form.sku_quantity')</td>
                <td></td>
            </tr>
            <tr>
                <td>@lang('form.description')</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>@lang('form.description_ru')</td>
                <td>{{ $product->description_ru }}</td>
            </tr>
            <tr>
                <td>@lang('form.image')</td>
                <td>
                    <img src="{{ Storage::url(path: $product->image) }}" alt="" height="200">
                </td>
            </tr>
            <tr>
                <td>@lang('form.labels')</td>
                <td>
                    @if($product->isNew())
                        <div class="label new-label">@lang('main.filter.new')</div>
                    @endif
                    @if($product->isHit())
                        <div class="label top-sale-label">@lang('main.filter.hit')</div>
                    @endif
                    @if($product->isRecommend())
                        <div class="label recommended-label">@lang('main.filter.recommend')</div>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
