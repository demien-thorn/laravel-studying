@extends('layouts.master')

@section('title', 'Товар '.$product->__('name'))

@section('content')
    <h3>{{ $product->__('name') }}</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>@lang('auth/products/show.field')</th>
                <th>@lang('auth/products/show.value')</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.code')</td>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.name')</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.name_ru')</td>
                <td>{{ $product->name_ru }}</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.category')</td>
                <td>{{ $product->category_id }}</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.price')</td>
                <td>{{ $product->price }} <i class="fa-solid fa-hryvnia-sign"></i></td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.quantity')</td>
                <td>{{ $product->count }} @lang('main.filter.pcs')</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.description')</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.description_ru')</td>
                <td>{{ $product->description_ru }}</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.image')</td>
                <td>
                    <img src="{{ Storage::url(path: $product->image) }}" alt="" height="200">
                </td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.lables')</td>
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
