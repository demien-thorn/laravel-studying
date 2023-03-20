<h3>@lang('mail/order_created.dear') {{ $name }}!</h3>
<p>
    @lang('mail/order_created.order') #... @lang('mail/order_created.created').
    @lang('mail/order_created.order_cost') {{ $fullSum }} {{ $currencySymbol }}.
    @lang('mail/order_created.manager').
</p>

<table>
    <tbody>
    @foreach($order->skus as $sku)
        <tr>
            <td>
                <img src="{{ Storage::url(path: $sku->product->image) }}" alt="" width="50px">
            </td>
            <td>
                <a href="{{ route(
                    name: 'sku',
                    parameters: [$sku->product->category->code, $sku->product->code, $sku]) }}">
                    {{ $sku->product->__('name') }}
                </a>
            </td>
            <td>
                <div class="form-inline">
                    <span class="count-goods">{{ $sku->countInOrder }}</span>
                </div>
            </td>
            <td>{{ $sku->price }} {{ $currencySymbol }}</td>
            <td>{{ $sku->getPriceForCount() }} {{ $currencySymbol }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
