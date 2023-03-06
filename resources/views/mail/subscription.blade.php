@lang('mail/subscription.hi').
@lang('mail/subscription.product') "{{ $product->name }}" @lang('mail/subscription.appeared').

<a href="{{ route(name: 'product', parameters: [$product->category->code, $product->code]) }}">
    @lang('mail/subscription.link')!
</a>
