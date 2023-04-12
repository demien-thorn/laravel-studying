<?php /** @var App\Models\Sku $sku */ ?>

<div class="feature col content-section">
    <div class="labels-section">
        @if($sku->product->isNew())
            <div class="label new-label">@lang('main.filter.new')</div>
        @endif
        @if($sku->product->isHit())
            <div class="label top-sale-label">@lang('main.filter.hit')</div>
        @endif
        @if($sku->product->isRecommend())
            <div class="label recommended-label">@lang('main.filter.recommend')</div>
        @endif
    </div>

    <div class="d-inline-flex align-items-center justify-content-center fs-2 mb-3">
        <img src="{{ Storage::url(path: $sku->product->image) }}" alt="" width="200px">
    </div>

    <h3 class="fs-2">{{ $sku->product->__('name') }}</h3>

    @isset($sku->product->properties)
        @foreach($sku->propertyOptions as $propertyOption)
            <h6>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h6>
        @endforeach
    @endisset

    <p>@lang('form.price'): {{ $sku->price }} {{ $currencySymbol }}</p>

    <form action="{{ route(name: 'basket-add', parameters: $sku) }}" method="post">
        @csrf
        @if($sku->isAvailable())
            <button type="submit" role="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">
                @lang('buttons.basket')
            </button>
        @else
            <button disabled class="btn btn-outline-secondary btn-lg px-4">
                @lang('buttons.unavailable')
            </button>
        @endif
        <a role="button" class="btn btn-outline-secondary btn-lg px-4"
            href="{{ route(
                name: 'sku',
                parameters: [isset($category)
                    ? $category->code
                    : $sku->product->category->code, $sku->product->code, $sku->id]) }}">
            @lang('buttons.more')
        </a>
    </form>
</div>
