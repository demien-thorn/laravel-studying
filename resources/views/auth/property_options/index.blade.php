@extends('layouts.master')

@section('title', __('main.titles.property_options'))

@section('content')
    <h3>@lang('main.titles.property_options') "{{ $property->__('name') }}"</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('main.table_form.name')</th>
                    <th colspan="3">@lang('main.table_form.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($propertyOptions as $propertyOption)
                    <tr>
                        <td>{{ $propertyOption->id }}</td>
                        <td>{{ $propertyOption->__('name') }}</td>
                        <td><a class="button_extra_small" href="{{ route(
                            name: 'property-options.show',
                            parameters: [$property, $propertyOption]) }}">
                            @lang('main.buttons.open')
                        </a></td>
                        <td><a class="button_extra_small" href="{{ route(
                            name: 'property-options.edit',
                            parameters: [$property, $propertyOption]) }}">
                            @lang('main.buttons.edit')
                        </a></td>
                        <td><form method="post"
                            action="{{ route(
                                name: 'property-options.destroy',
                                parameters: [$property, $propertyOption]) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="@lang('main.buttons.delete')" class="button_extra_small">
                        </form></td>
                    </tr>
                @endforeach
                <tr><td colspan="6">
                    <a class="ordering" href="{{ route(
                        name: 'property-options.create',
                        parameters: $property) }}">
                        @lang('main.table_form.add_property_option')
                    </a>
                </td></tr>
            </tbody>
        </table>
        {{ $propertyOptions->links('pagination::bootstrap-5') }}
    </div>
@endsection