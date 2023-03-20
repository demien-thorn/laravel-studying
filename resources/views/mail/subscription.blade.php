@lang('mail/subscription.hi').
@lang('mail/subscription.product') "{{ $sku->__('name') }}" @lang('mail/subscription.appeared').

<a href="{{ route(name: 'product', parameters: [$sku->category->code, $sku->code]) }}">
    @lang('mail/subscription.link')!
</a>
