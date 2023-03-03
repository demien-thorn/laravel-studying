Hi there.
Product "{{ $product->name }}" has appeared.

<a href="{{ route(name: 'product', parameters: [$product->category->code, $product->code]) }}">Let's go!</a>
