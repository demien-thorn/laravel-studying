@extends('layouts.master')

<?php /** @var App\Models\PropertyOption $propertyOption */ ?>

@isset($propertyOption)
    @section('title', __('title.edit_property_option').' '.$propertyOption->__('name'))
@else
    @section('title', __('title.add_property_option'))
@endisset

@section('content')
    @isset($propertyOption)
        <h3>@lang('titles.edit_property_option') "{{ $propertyOption->__('name') }}"</h3>
    @else
        <h3>@lang('titles.add_property_option') "{{ $property->__('name') }}"</h3>
    @endisset

    <div class="content-main clearfix">
        <form method="post" class="form-container"
            @isset($propertyOption)
                action="{{ route(name: 'property-options.update', parameters: [$property, $propertyOption]) }}"
            @else
                action="{{ route(name: 'property-options.store', parameters: $property) }}"
            @endisset>

            @isset($propertyOption)
                @method('PUT')
            @endisset
            @csrf

            <label for="name">@lang('form.name'):</label>
            @include('layouts.error', ['fieldName' => 'name'])
            <input type="text" name="name" id="name" style="display: block"
               value="@isset($propertyOption){{ $propertyOption->name }}@endisset">

            <label for="name_ru">@lang('form.name_ru'):</label>
            @include('layouts.error', ['fieldName' => 'name_ru'])
            <input type="text" name="name_ru" id="name_ru" style="display: block"
               value="@isset($propertyOption){{ $propertyOption->name_ru }}@endisset">

            <input type="submit" value="@lang('buttons.save')"
               style="display: block" class="btn btn-primary btn-lg px-4 fw-bold">
        </form>
    </div>
@endsection
