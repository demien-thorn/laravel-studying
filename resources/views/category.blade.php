@extends('layouts.master', ['file' => 'category'])

@section('title', 'Category '. $category->__('name'))

@section('content')
    <h3>{{ $category->__('name') }}</h3>
    <div class="undertitle">{{ $category->__('description') }}</div>

    <div class="container px-4 py-5" id="featured-3">
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        @foreach($category->products as $product)
            @include('layouts.card', compact(var_name: 'product'))
        @endforeach
        </div>
    </div>

    <div class="content-txt">Total products in this category: {{ $category->products->count() }}</div>
@endsection
