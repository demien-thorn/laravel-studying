@extends('layouts.master')

@section('title', 'Товар '.$product->name)

@section('content')
    <h3>{{ $product->name }}</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <td>Code</td>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>Category</td>
                <td>{{ $product->category_id }}</td>
            </tr>
            <tr>
                <td>Price</td>
                <td>{{ $product->price }} UAH</td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td>{{ $product->count }} pcs.</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>Image</td>
                <td>
                    <img src="{{ Storage::url(path: $product->image) }}" alt="" height="200">
                </td>
            </tr>
            <tr>
                <td>Lables</td>
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
