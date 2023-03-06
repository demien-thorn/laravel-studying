@extends('layouts.master', ['file' => 'product'])

@section('title', 'Product')

@section('content')
    <h3>{{ $product->__('name') }}</h3>
    <div class="undertitle">@lang('product.undertitle') {{ $product->category->__('name') }}</div>

    <div class="content-main clearfix">
        <div class="content-section-middle">
            <img src="{{ Storage::url(path: $product->image) }}" alt="" width="200">
            <div class="content-txt"><b>@lang('product.code')</b> {{ $product->code }}</div>
            <div class="content-txt"><b>@lang('product.description')</b> {{ $product->__('description') }}</div>
            <div class="content-txt"><b>@lang('product.price')</b> {{ $product->price }} UAH</div>
            <div class="content-txt"><b>@lang('product.quantity')</b> {{ $product->count }} pcs.</div>
                @if($product->isAvailable())
                    <form
                        action="{{ route(name: 'basket-add', parameters: $product) }}"
                        method="post"
                        class="form-container">
                        @csrf
                        <input type="submit" name="basket" value="@lang('product.basket')">
                    </form>
                @else
                    <button disabled class="button_extra_small">@lang('product.unavailable')</button>
                    <button disabled class="button_extra_small">@lang('product.notification')</button>
            <div class="alert">
                @if($errors->get('email'))
                    {!! $errors->get('email')[0] !!}
                @endif
            </div>
                    <form
                        action="{{ route(name: 'subscription', parameters: $product) }}"
                        method="post"
                        class="form-container">
                        @csrf
                        <input type="email" name="email">
                        <input type="submit" value="@lang('product.send')">
                    </form>
                @endif
        </div>
    </div>
@endsection
