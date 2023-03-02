@extends('layouts.master')

@isset($product)
    @section('title', 'Edit product '.$product->name)
@else
    @section('title', 'Create a new product')
@endisset

@section('content')
    @isset($product)
        <h3>Editing of the product "{{ $product->name }}"</h3>
    @else
        <h3>Adding a new product</h3>
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

            <label for="code">Code:</label>
            @include('layouts.error', ['fieldName' => 'code'])
            <input type="text" name="code" id="code" value="@isset($product){{ $product->code }}@endisset">

            <label for="category_id">Category:</label>
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

            <label for="name">Name:</label>
            @include('layouts.error', ['fieldName' => 'name'])
            <input type="text" name="name" id="name" value="@isset($product){{ $product->name }}@endisset">

            <label for="price">Price, UAH:</label>
            @include('layouts.error', ['fieldName' => 'price'])
            <input type="text" name="price" id="price" value="@isset($product){{ $product->price }}@endisset">

            <label for="description">Description:</label>
            @include('layouts.error', ['fieldName' => 'description'])
            <textarea name="description" id="description" cols="30" rows="10"
                >@isset($product){{ $product->description }}@endisset
            </textarea>

            <label for="image">Image:</label>
            <input type="file" name="image" id="image" value="Upload">

            @foreach([
                'hit' => 'Top sale',
                'new' => 'NEW',
                'recommend' => 'Recommended',
            ] as $field => $title)
                <label for="{{ $field }}">{{ $title }}</label>
                <input
                    type="checkbox"
                    name="{{ $field }}" id="{{ $field }}"
                    @if(isset($product) && $product->$field === 1)
                     checked="checked"
                    @endif>
            @endforeach

            <input type="submit" name="" value="Save">
        </form>
    </div>
@endsection
