@extends('layouts.master')

@isset($category)
    @section('title', 'Edit the category '.$category->name)
@else
    @section('title', 'Add a new category')
@endisset

@section('content')
    @isset($category)
        <h3>@lang('auth/categories/form.title_edit') "{{ $category->name }}"</h3>
    @else
        <h3>@lang('auth/categories/form.title_add')</h3>
    @endisset

    <div class="content-main clearfix">
        <form
            @isset($category)
                action="{{ route(name: 'categories.update', parameters: $category) }}"
            @else
                action="{{ route(name: 'categories.store') }}"
            @endisset
            method="post" enctype="multipart/form-data" class="form-container">
            @isset($category)
                @method('PUT')
            @endisset
            @csrf

            <label for="code">@lang('auth/categories/form.code'):</label>
            @include('layouts.error', ['fieldName' => 'code'])
            <input type="text" name="code" id="code"
                value="{{ old(key: 'code', default: isset($category) ? $category->code : null) }}">

            <label for="name">@lang('auth/categories/form.name'):</label>
            @include('layouts.error', ['fieldName' => 'name'])
            <input type="text" name="name" id="name" value="@isset($category){{ $category->name }}@endisset">

            <label for="description">@lang('auth/categories/form.description'):</label>
            @include('layouts.error', ['fieldName' => 'description'])
            <textarea name="description" id="description" cols="30" rows="10"
                >@isset($category){{ $category->description }}@endisset
            </textarea>

            <label for="image">@lang('auth/categories/form.image'):</label>
            <input type="file" name="image" id="image" value="Upload">

            <input type="submit" name="" value="@lang('auth/categories/form.send')">
        </form>
    </div>
@endsection
