@extends('layouts.master', ['file' => 'categories'])

@section('title', 'All categories')

@section('content')
    <h3>@lang('main.nav.categories')</h3>

    <div class="content-main clearfix">
        @foreach($categories as $category)
            <div class="content-section">
                <h4>
                    <a href="{{ route(name: 'category', parameters: $category->code) }}">
                        {{ $category->__('name') }}
                    </a>
                </h4>
                <img src="{{ Storage::url(path: $category->image) }}" alt="" width="200px">
                <div class="content-txt">{{ $category->__('description') }}</div>
            </div>
        @endforeach
    </div>
@endsection
