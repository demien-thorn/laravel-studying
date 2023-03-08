<h3>@lang('mail/order_created.dear') {{ $name }}!</h3>
<p>
    @lang('mail/order_created.order') #... @lang('mail/order_created.created').
    @lang('mail/order_created.order_cost') {{ $fullSum }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}.
    @lang('mail/order_created.manager').
</p>

<table>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>
                <img src="{{ Storage::url(path: $product->image) }}" alt="" width="50px">
            </td>
            <td>
                <a href="{{ route(name: 'product', parameters: [$product->category->code, $product->code]) }}">
                    {{ $product->__('name') }}
                </a>
            </td>
            <td>
                <div class="form-inline">
                    <span class="count-goods">{{ $product->pivot->count }}</span>
                </div>
            </td>
            <td>{{ $product->price }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</td>
            <td>{{ $product->getPriceForCount() }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
