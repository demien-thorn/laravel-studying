@extends('layouts.master', ['file' => 'index'])

@section('title', 'Main')

@section('content')
    <h3>All products</h3>
    <div class="undertitle">
        Here you can take a look at all products presented at our e-shop
    </div>

    <form action="{{ route(name: 'index') }}" method="get" class="form-container">
        <label for="price_from">Price from</label>
        <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from }}">

        <label for="price_to">to</label>
        <input type="text" name="price_to" id="price_to" size="6" value="{{ request()->price_to }}">


        <label for="hit">Hit</label>
        <input type="checkbox" name="hit" id="hit" @if(request()->has(key: 'hit')) checked @endif>

        <label for="new">NEW</label>
        <input type="checkbox" name="new" id="new" @if(request()->has(key: 'new')) checked @endif>

        <label for="recommend">Recommend</label>
        <input type="checkbox" name="recommend" id="recommend" @if(request()->has(key: 'recommend')) checked @endif>

        <input type="submit" value="Filter">
        <a href="{{ route(name: 'index') }}" class="button_extra_small">Reset</a>
    </form>

    <div class="content-main clearfix">
        @foreach($products as $product)
            @include('layouts.card', compact(var_name: 'product'))
        @endforeach
    </div>
    {{ $products->links('pagination::bootstrap-5') }}
@endsection
