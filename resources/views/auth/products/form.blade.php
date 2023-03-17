@extends('layouts.master')

@isset($product)
    @section('title', __('main.titles.edit_product').' '.$product->__('name'))
@else
    @section('title', __('main.titles.add_product'))
@endisset

@section('content')
    @isset($product)
        <h3>@lang('main.titles.edit_product') "{{ $product->__('name') }}"</h3>
    @else
        <h3>@lang('main.titles.add_product')</h3>
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

            <label for="code">@lang('main.table_form.code'):</label>
            @include('layouts.error', ['fieldName' => 'code'])
            <input type="text" name="code" id="code" style="display: block"
                   value="@isset($product){{ $product->code }}@endisset">

            <label for="category_id">@lang('main.table_form.category'):</label>
            <select name="category_id" id="category_id" style="display: block">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            @isset($product)
                                @if($product->category_id == $category->id)
                                    selected
                                @endif
                            @endisset
                    >{{ $category->__('name') }}</option>
                @endforeach
            </select>

            <label for="name">@lang('main.table_form.name'):</label>
            @include('layouts.error', ['fieldName' => 'name'])
            <input type="text" name="name" id="name" style="display: block"
                   value="@isset($product){{ $product->name }}@endisset">

            <label for="name_ru">@lang('main.table_form.name_ru'):</label>
            @include('layouts.error', ['fieldName' => 'name'])
            <input type="text" name="name_ru" id="name_ru" style="display: block"
                   value="@isset($product){{ $product->name_ru }}@endisset">

            <label for="price">@lang('main.table_form.price'), <i class="fa-solid fa-hryvnia-sign"></i>:</label>
            @include('layouts.error', ['fieldName' => 'price'])
            <input type="text" name="price" id="price" style="display: block"
                   value="@isset($product){{ $product->price }}@endisset">

            <label for="count">@lang('main.table_form.quantity'), @lang('main.filter.pcs'):</label>
            @include('layouts.error', ['fieldName' => 'count'])
            <input type="text" name="count" id="count" style="display: block"
                   value="@isset($product){{ $product->count }}@endisset">

            <label for="description">@lang('main.table_form.description'):</label>
            @include('layouts.error', ['fieldName' => 'description'])
            <textarea name="description" id="description" cols="50" rows="5" style="display: block"
                >@isset($product){{ $product->description }}@endisset
            </textarea>

            <label for="description_ru">@lang('main.table_form.description_ru'):</label>
            @include('layouts.error', ['fieldName' => 'description'])
            <textarea name="description_ru" id="description_ru" cols="50" rows="5" style="display: block"
                >@isset($product){{ $product->description_ru }}@endisset
            </textarea>

            <label for="image">@lang('main.table_form.image'):</label>
            <input type="file" name="image" id="image" style="display: block" value="Upload">

            @foreach(['hit' => 'Top sale', 'new' => 'NEW', 'recommend' => 'Recommended'] as $field => $title)
                <label for="{{ $field }}">@lang('main.filter.'.$field)</label>
                <input type="checkbox" name="{{ $field }}" id="{{ $field }}"
                    @if(isset($product) && $product->$field === 1)
                        checked="checked"
                    @endif>
            @endforeach

            <input type="submit" style="display: block" class="btn btn-primary btn-lg px-4 fw-bold"
                   value="@lang('main.buttons.save')">
        </form>
    </div>
@endsection
