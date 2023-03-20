@extends('layouts.master', ['file' => 'product'])

@section('title', __('main.titles.product'))

@section('content')
    <h3>{{ $skus->product->__('name') }}</h3>
    <div class="undertitle">@lang('product.undertitle') {{ $skus->product->category->__('name') }}</div>

    <div class="container px-4 py-5" id="featured-3">
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="content-section-middle">
                <img src="{{ Storage::url(path: $skus->product->image) }}" alt="" width="200">
                <div class="content-txt">
                    <b>@lang('product.code')</b>
                    {{ $skus->product->code }}
                </div>

                <div class="content-txt">
                    <b>@lang('product.description')</b>
                    {{ $skus->product->__('description') }}
                </div>

                <div class="content-txt">
                    <b>@lang('product.price')</b>
                    {{ $skus->price }} {{ $currencySymbol }}
                </div>

                @isset($skus->product->properties)
                    @foreach($skus->propertyOptions as $propertyOption)
                        <div class="content-txt">
                            <b>{{ $propertyOption->property->__('name') }}: </b>
                            {{ $propertyOption->__('name') }}
                        </div>
                    @endforeach
                @endisset

                <div class="content-txt">
                    <b>@lang('product.quantity')</b>
                    {{ $skus->count }}
                    @lang('main.filter.pcs')
                </div>

                @if($skus->isAvailable())
                    <form method="post" class="form-container"
                        action="{{ route(name: 'basket-add', parameters: $skus->product) }}">
                        @csrf
                        <input type="submit" name="basket" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold"
                               value="@lang('product.basket')">
                    </form>
                @else
                    <button disabled class="btn btn-outline-secondary btn-lg px-4">
                        @lang('product.unavailable')
                    </button>
                    <button disabled class="btn btn-outline-secondary btn-lg px-4">
                        @lang('product.notification')
                    </button>
                    <div class="alert">
                        @if($errors->get('email'))
                            {!! $errors->get('email')[0] !!}
                        @endif
                    </div>
                    <form method="post" class="form-container"
                        action="{{ route(name: 'subscription', parameters: $skus) }}">
                        @csrf
                        <input type="email" name="email">
                        <input type="submit" class="btn btn-outline-secondary btn-lg px-4"
                               value="@lang('product.send')">
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
