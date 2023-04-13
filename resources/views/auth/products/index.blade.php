@extends('layouts.master')

<?php /** @var App\Models\Category $products */ ?>

@section('title', __('title.products'))

@section('content')
    <h3>@lang('titles.products')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('form.code')</th>
                <th>@lang('form.name')</th>
                <th>@lang('form.category')</th>
                <th>@lang('form.sku_quantity')</th>
                <th colspan="4">@lang('form.actions')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->__('name') }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td></td>
                    <td><a href="{{ route(name: 'products.show', parameters: $product) }}" class="button_extra_small">
                        @lang('buttons.open')
                    </a></td>
                    <td><a href="{{ route(name: 'skus.index', parameters: $product) }}" class="button_extra_small">
                        @lang('buttons.skus')
                    </a></td>
                    <td><a href="{{ route(name: 'products.edit', parameters: $product) }}" class="button_extra_small">
                        @lang('buttons.edit')
                    </a></td>
                    <td><form action="{{ route(name: 'products.destroy', parameters: $product) }}" method="post">
                        @csrf @method('DELETE')
                        <input type="submit" value="@lang('buttons.delete')" class="button_extra_small">
                    </form></td>
                </tr>
            @endforeach
            <tr><td colspan="9"><a href="{{ route(name: 'products.create') }}" class="ordering">
                @lang('buttons.add_product')
            </a></td></tr>
            </tbody>
        </table>
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection
