@extends('layouts.master')

@section('title', 'Товар '.$product->name)

@section('content')
    <h3>{{ $product->name }}</h3>

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
                <td>@lang('auth/products/show.category')</td>
                <td>{{ $product->category_id }}</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.price')</td>
                <td>{{ $product->price }} UAH</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.quantity')</td>
                <td>{{ $product->count }} pcs.</td>
            </tr>
            <tr>
                <td>@lang('auth/products/show.description')</td>
                <td>{{ $product->description }}</td>
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
                        <div class="label new-label">NEW!</div>
                    @endif
                    @if($product->isHit())
                        <div class="label top-sale-label">Top Sale</div>
                    @endif
                    @if($product->isRecommend())
                        <div class="label recommended-label">We recommend</div>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
