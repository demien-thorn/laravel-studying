@extends('layouts.master')

@isset($category)
    @section('title', __('main.titles.edit_category').' '.$category->__('name'))
@else
    @section('title', __('main.titles.add_category'))
@endisset

@section('content')
    @isset($category)
        <h3>@lang('main.titles.edit_category') "{{ $category->__('name') }}"</h3>
    @else
        <h3>@lang('main.titles.add_category')</h3>
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

            <label for="code">@lang('main.table_form.code'):</label>
            @include('layouts.error', ['fieldName' => 'code'])
            <input type="text" name="code" id="code" style="display: block"
                value="{{ old(key: 'code', default: isset($category) ? $category->code : null) }}">

            <label for="name">@lang('main.table_form.name'):</label>
            @include('layouts.error', ['fieldName' => 'name'])
            <input type="text" name="name" id="name" style="display: block"
                   value="@isset($category){{ $category->name }}@endisset">

            <label for="name_ru">@lang('main.table_form.name_ru'):</label>
            @include('layouts.error', ['fieldName' => 'name_ru'])
            <input type="text" name="name_ru" id="name_ru" style="display: block"
                   value="@isset($category){{ $category->name_ru }}@endisset">

            <label for="description">@lang('main.table_form.description'):</label>
            @include('layouts.error', ['fieldName' => 'description'])
            <textarea name="description" id="description" cols="50" rows="5" style="display: block"
                >@isset($category){{ $category->description }}@endisset
            </textarea>

            <label for="description_ru">@lang('main.table_form.description_ru'):</label>
            @include('layouts.error', ['fieldName' => 'description_ru'])
            <textarea name="description_ru" id="description_ru" cols="50" rows="5" style="display: block"
                >@isset($category){{ $category->description_ru }}@endisset
            </textarea>

            <label for="image">@lang('main.table_form.image'):</label>
            <input type="file" name="image" id="image" style="display: block" value="Upload">

            <input type="submit" value="@lang('main.buttons.save')"
                   style="display: block" class="btn btn-primary btn-lg px-4 fw-bold">
        </form>
    </div>
@endsection
