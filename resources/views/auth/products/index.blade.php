@extends('layouts.master')

@section('title', 'Товары')

@section('content')
    <h3>Products</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ $product->price }} UAH</td>
                    <td>
                        <a href="{{ route(name: 'products.show', parameters: $product) }}" class="button_extra_small">
                            Open
                        </a>
                    </td>
                    <td>
                        <a href="{{ route(name: 'products.edit', parameters: $product) }}" class="button_extra_small">
                            Edit
                        </a>
                    </td>
                    <td>
                        <form action="{{ route(name: 'products.destroy', parameters: $product) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="button_extra_small">
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="8">
                    <a href="{{ route(name: 'products.create') }}" class="ordering">
                        Add a new product
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection
