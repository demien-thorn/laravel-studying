@extends('layouts.master', ['file' => 'product'])

@section('title', 'Product')

@section('content')
    <h3>{{ $product->name }}</h3>
    <div class="undertitle">Category: {{ $product->category->name }}</div>

    <div class="content-main clearfix">
        <div class="content-section-middle">
            <img src="{{ Storage::url(path: $product->image) }}" alt="" width="200">
            <div class="content-txt"><b>Code:</b> {{ $product->code }}</div>
            <div class="content-txt"><b>Description:</b> {{ $product->description }}</div>
            <div class="content-txt"><b>Price:</b> {{ $product->price }} UAH</div>
            <div class="content-txt"><b>Quantity available:</b> {{ $product->count }} pcs.</div>
                @if($product->isAvailable())
                <form action="{{ route(name: 'basket-add', parameters: $product) }}" method="post">
                    @csrf
                    <button type="submit" role="button" class="button_extra_small">To the basket</button>
                </form>
                @else
                <button disabled class="button_extra_small">Unavailable</button>
                <button disabled class="button_extra_small">Tell me when product appears</button>
                <form action="" method="post" class="form-container">
                    @csrf
                    <input type="email" name="email">
                    <input type="submit" value="Send">
                </form>
                @endif
        </div>
    </div>
@endsection
