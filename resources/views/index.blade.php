@extends('layouts.master', ['file' => 'index'])

@section('title', __('main.titles.main'))

@section('content')
    <h3 class="pb-2 border-bottom">@lang('main.main.title')</h3>
    <div class="undertitle">@lang('main.main.undertitle')</div>

    <form action="{{ route(name: 'index') }}" method="get" class="form-container">
        <label for="price_from">@lang('main.filter.price_from')</label>
        <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from }}">

        <label for="price_to">@lang('main.filter.price_to')</label>
        <input type="text" name="price_to" id="price_to" size="6" value="{{ request()->price_to }}">

        <label for="hit">@lang('main.filter.hit')</label>
        <input type="checkbox" name="hit" id="hit" @if(request()->has(key: 'hit')) checked @endif>

        <label for="new">@lang('main.filter.new')</label>
        <input type="checkbox" name="new" id="new" @if(request()->has(key: 'new')) checked @endif>

        <label for="recommend">@lang('main.filter.recommend')</label>
        <input type="checkbox" name="recommend" id="recommend" @if(request()->has(key: 'recommend')) checked @endif>

        <input type="submit" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold" value="@lang('main.filter.filter')">
        <a href="{{ route(name: 'index') }}" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">
            @lang('main.filter.reset')
        </a>
    </form>

    <div class="container px-4 py-5" id="featured-3">
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            @foreach($products as $product)
                @include('layouts.card', compact(var_name: 'product'))
            @endforeach
        </div>
    </div>

    {{ $products->links('pagination::bootstrap-5') }}
@endsection
