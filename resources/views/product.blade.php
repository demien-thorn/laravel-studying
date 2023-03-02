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
            <form action="{{ route(name: 'basket-add', parameters: $product) }}" method="post">
                @csrf
                @if($product->isAvailable())
                    <button type="submit" role="button" class="button_extra_small">To the basket</button>
                @else
                    <button disabled class="button_extra_small">Unavailable</button>
                @endif
            </form>
        </div>
    </div>
@endsection
