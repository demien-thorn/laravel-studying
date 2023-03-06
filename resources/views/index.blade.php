@extends('layouts.master', ['file' => 'index'])

@section('title', 'Main')

@section('content')
    <h3>@lang('main.main.title')</h3>
    <div class="undertitle">
        @lang('main.main.undertitle')
    </div>

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

        <input type="submit" value="@lang('main.filter.filter')">
        <a href="{{ route(name: 'index') }}" class="button_extra_small">@lang('main.filter.reset')</a>
    </form>

    <div class="content-main clearfix">
        @foreach($products as $product)
            @include('layouts.card', compact(var_name: 'product'))
        @endforeach
    </div>
    {{ $products->links('pagination::bootstrap-5') }}
@endsection
