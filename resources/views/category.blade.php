@extends('layouts.master', ['file' => 'category'])

@section('title', 'Category '. $category->name)

@section('content')
    <h3>{{ $category->name }}</h3>
    <div class="undertitle">{{ $category->description }}</div>

    <div class="content-main clearfix">
        @foreach($category->products as $product)
            @include('layouts.card', compact(var_name: 'product'))
        @endforeach
    </div>

    <div class="content-txt">Total products in this category: {{ $category->products->count() }}</div>
@endsection