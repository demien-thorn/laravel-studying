@extends('layouts.master')

@isset($property)
    @section('title', __('main.titles.edit_property').' '.$property->__('name'))
@else
    @section('title', __('main.titles.add_property'))
@endisset

@section('content')
    @isset($property)
        <h3>@lang('main.titles.edit_property') "{{ $property->__('name') }}"</h3>
    @else
        <h3>@lang('main.titles.add_property')</h3>
    @endisset

    <div class="content-main clearfix">
        <form
            @isset($property)
                action="{{ route(name: 'properties.update', parameters: $property) }}"
            @else
                action="{{ route(name: 'properties.store') }}"
            @endisset
            method="post" enctype="multipart/form-data" class="form-container">
            @isset($property)
                @method('PUT')
            @endisset
            @csrf

            <label for="name">@lang('main.table_form.name'):</label>
            @include('layouts.error', ['fieldName' => 'name'])
            <input type="text" name="name" id="name" style="display: block"
               value="@isset($property){{ $property->name }}@endisset">

            <label for="name_ru">@lang('main.table_form.name_ru'):</label>
            @include('layouts.error', ['fieldName' => 'name_ru'])
            <input type="text" name="name_ru" id="name_ru" style="display: block"
               value="@isset($property){{ $property->name_ru }}@endisset">

            <input type="submit" value="@lang('main.buttons.save')"
               style="display: block" class="btn btn-primary btn-lg px-4 fw-bold">
        </form>
    </div>
@endsection
