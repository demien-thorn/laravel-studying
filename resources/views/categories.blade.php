@extends('layouts.master', ['file' => 'categories'])

@section('title', 'All categories')

@section('content')
<h3>Categories</h3>

<div class="content-main clearfix">
    @foreach($categories as $category)
        <div class="content-section">
            <h4><a href="{{ route(name: 'category', parameters: $category->code) }}">{{ $category->name }}</a></h4>
            <img src="{{ \Illuminate\Support\Facades\Storage::url(path: $category->image) }}" alt="" width="200px">
            <div class="content-txt">{{ $category->description }}</div>
        </div>
    @endforeach
</div>
@endsection
