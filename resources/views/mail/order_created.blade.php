<h3>Dear {{ $name }}!</h3>
<p>
    Your order #... has been created successfully.
    Total cost is: {{ $fullSum }} UAH.
    Our manager will connect you soon for the further instructions.
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
                    {{$product->name}}
                </a>
            </td>
            <td>
                <div class="form-inline">
                    <span class="count-goods">{{ $product->pivot->count }}</span>
                </div>
            </td>
            <td>{{ $product->price }} UAH</td>
            <td>{{ $product->getPriceForCount() }} UAH</td>
        </tr>
    @endforeach
    </tbody>
</table>
