@extends('layouts.master')

@section('title', 'Товары')

@section('content')
    <h3>@lang('auth/products/main.title')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('auth/products/main.code')</th>
                <th>@lang('auth/products/main.name')</th>
                <th>@lang('auth/products/main.category')</th>
                <th>@lang('auth/products/main.price')</th>
                <th>@lang('auth/products/main.quantity')</th>
                <th colspan="3">@lang('auth/products/main.actions')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->__('name') }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ $product->price }} UAH</td>
                    <td>{{ $product->count }} pcs</td>
                    <td>
                        <a href="{{ route(name: 'products.show', parameters: $product) }}" class="button_extra_small">
                            @lang('auth/products/main.open')
                        </a>
                    </td>
                    <td>
                        <a href="{{ route(name: 'products.edit', parameters: $product) }}" class="button_extra_small">
                            @lang('auth/products/main.edit')
                        </a>
                    </td>
                    <td>
                        <form action="{{ route(name: 'products.destroy', parameters: $product) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="@lang('auth/products/main.delete')" class="button_extra_small">
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="8">
                    <a href="{{ route(name: 'products.create') }}" class="ordering">@lang('auth/products/main.add')</a>
                </td>
            </tr>
            </tbody>
        </table>
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection
