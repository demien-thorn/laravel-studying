@extends('layouts.master')

@section('title', __('main.titles.products_a'))

@section('content')
    <h3>@lang('main.titles.products_a')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('main.table_form.code')</th>
                <th>@lang('main.table_form.name')</th>
                <th>@lang('main.table_form.category')</th>
                <th>@lang('main.table_form.sku_quantity')</th>
                <th colspan="4">@lang('main.table_form.actions')</th>
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
                    <td>
                        <a href="{{ route(name: 'products.show', parameters: $product) }}" class="button_extra_small">
                            @lang('main.buttons.open')
                        </a>
                    </td>
                    <td>
                        <a href="{{ route(name: 'skus.index', parameters: $product) }}" class="button_extra_small">
                            @lang('main.buttons.skus')
                        </a>
                    </td>
                    <td>
                        <a href="{{ route(name: 'products.edit', parameters: $product) }}" class="button_extra_small">
                            @lang('main.buttons.edit')
                        </a>
                    </td>
                    <td>
                        <form action="{{ route(name: 'products.destroy', parameters: $product) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="@lang('main.buttons.delete')" class="button_extra_small">
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr><td colspan="9"><a href="{{ route(name: 'products.create') }}" class="ordering">
                @lang('main.table_form.add_product')
            </a></td></tr>
            </tbody>
        </table>
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection
