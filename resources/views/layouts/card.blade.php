<div class="feature col content-section">
    <div class="lables-section">
        @if($product->isNew())
            <div class="label new-label">@lang('main.filter.new')</div>
        @endif
        @if($product->isHit())
            <div class="label top-sale-label">@lang('main.filter.hit')</div>
        @endif
        @if($product->isRecommend())
            <div class="label recommended-label">@lang('main.filter.recommend')</div>
        @endif
    </div>

    <div class="d-inline-flex align-items-center justify-content-center fs-2 mb-3">
        <img src="{{ Storage::url(path: $product->image) }}" alt="" width="200px">
    </div>

    <h3 class="fs-2">{{ $product->__('name') }}</h3>

    <p>@lang('card.price') {{ $product->price }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</p>
        <form action="{{ route(name: 'basket-add', parameters: $product) }}" method="post">
            @csrf
            @if($product->isAvailable())
                <button type="submit" role="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">
                    @lang('main.buttons.basket')
                </button>
            @else
                <button disabled class="btn btn-outline-secondary btn-lg px-4">
                    @lang('main.buttons.unavailable')
                </button>
            @endif
            <a role="button" class="btn btn-outline-secondary btn-lg px-4"
                href="{{ route(
                    name: 'product',
                    parameters: [isset($category) ? $category->code : $product->category->code, $product->code]) }}">
                @lang('main.buttons.more')
            </a>
        </form>
</div>
