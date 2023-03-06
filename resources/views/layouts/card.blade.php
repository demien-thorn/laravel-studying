<div class="content-section">
    @if($product->isNew())
        <div class="label new-label">@lang('main.filter.new')</div>
    @endif
    @if($product->isHit())
        <div class="label top-sale-label">@lang('main.filter.hit')</div>
    @endif
    @if($product->isRecommend())
        <div class="label recommended-label">@lang('main.filter.recommend')</div>
    @endif

    <h4><a href="#">{{ $product->name }}</a></h4>
    <img src="{{ Storage::url(path: $product->image) }}" alt="" width="200px">

    <div class="content-txt">@lang('card.price') {{ $product->price }} UAH</div>

    <form action="{{ route(name: 'basket-add', parameters: $product) }}" method="post">
        @csrf
        @if($product->isAvailable())
            <button type="submit" role="button" class="button_extra_small">@lang('card.basket')</button>
        @else
            <button disabled class="button_extra_small">@lang('card.unavailable')</button>
        @endif
        <a
            href="{{ route(
            name: 'product',
            parameters: [isset($category) ? $category->code : $product->category->code, $product->code]) }}"
            role="button"
            class="button_extra_small">
            @lang('card.more')
        </a>
    </form>
</div>
