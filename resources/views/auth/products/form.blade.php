@extends('layouts.master')

@isset($product)
    @section('title', 'Edit product '.$product->name)
@else
    @section('title', 'Create a new product')
@endisset

@section('content')
    @isset($product)
        <h3>@lang('auth/products/form.title_update') "{{ $product->name }}"</h3>
    @else
        <h3>@lang('auth/products/form.title_add')</h3>
    @endisset

    <div class="content-main clearfix">
        <form
            @isset($product)
                action="{{ route(name: 'products.update', parameters: $product) }}"
            @else
                action="{{ route(name: 'products.store') }}"
            @endisset
            method="post" enctype="multipart/form-data" class="form-container">
            @isset($product)
                @method('PUT')
            @endisset
            @csrf

            <label for="code">@lang('auth/products/form.code'):</label>
            @include('layouts.error', ['fieldName' => 'code'])
            <input type="text" name="code" id="code" value="@isset($product){{ $product->code }}@endisset">

            <label for="category_id">@lang('auth/products/form.category'):</label>
            <select name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            @isset($product)
                                @if($product->category_id == $category->id)
                                    selected
                                @endif
                            @endisset
                    >{{ $category->name }}</option>
                @endforeach
            </select>

            <label for="name">@lang('auth/products/form.name'):</label>
            @include('layouts.error', ['fieldName' => 'name'])
            <input type="text" name="name" id="name" value="@isset($product){{ $product->name }}@endisset">

            <label for="price">@lang('auth/products/form.price'), UAH:</label>
            @include('layouts.error', ['fieldName' => 'price'])
            <input type="text" name="price" id="price" value="@isset($product){{ $product->price }}@endisset">

            <label for="count">@lang('auth/products/form.quantity'), pcs.:</label>
            @include('layouts.error', ['fieldName' => 'count'])
            <input type="text" name="count" id="count" value="@isset($product){{ $product->count }}@endisset">

            <label for="description">@lang('auth/products/form.description'):</label>
            @include('layouts.error', ['fieldName' => 'description'])
            <textarea name="description" id="description" cols="30" rows="10"
                >@isset($product){{ $product->description }}@endisset
            </textarea>

            <label for="image">@lang('auth/products/form.image'):</label>
            <input type="file" name="image" id="image" value="Upload">

            @foreach([
                'hit' => 'Top sale',
                'new' => 'NEW',
                'recommend' => 'Recommended',
            ] as $field => $title)
                <label for="{{ $field }}">@lang('main.filter.'.$field)</label>
                <input
                    type="checkbox"
                    name="{{ $field }}" id="{{ $field }}"
                    @if(isset($product) && $product->$field === 1)
                     checked="checked"
                    @endif>
            @endforeach

            <input type="submit" name="" value="@lang('auth/products/form.send')">
        </form>
    </div>
@endsection
