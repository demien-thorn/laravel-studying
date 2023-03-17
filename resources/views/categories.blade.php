@extends('layouts.master', ['file' => 'categories'])

@section('title', __('main.titles.categories'))

@section('content')
    <h3>@lang('main.nav.categories')</h3>

    <div class="container px-4 py-5" id="featured-3">
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            @foreach($categories as $category)
                <div class="content-section">
                    <h4>
                        <a href="{{ route(name: 'category', parameters: $category->code) }}">{{ $category->__('name') }}</a>
                    </h4>
                    <img src="{{ Storage::url(path: $category->image) }}" alt="" width="200px">
                    <div class="content-txt">{{ $category->__('description') }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
