@extends('layouts.master')

<?php /** @var App\Models\Property $properties */ ?>

@section('title', __('title.properties'))

@section('content')
    <h3>@lang('titles.properties')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('form.name')</th>
                    <th colspan="4">@lang('form.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                    <tr>
                        <td>{{ $property->id }}</td>
                        <td>{{ $property->__('name') }}</td>
                        <td><a class="button_extra_small"
                            href="{{ route(name: 'properties.show', parameters: $property) }}">
                            @lang('buttons.open')
                        </a></td>
                        <td><a class="button_extra_small"
                            href="{{ route(name: 'properties.edit', parameters: $property) }}">
                            @lang('buttons.edit')
                        </a></td>
                        <td><a class="button_extra_small"
                            href="{{ route(name: 'property-options.index', parameters: $property) }}">
                            @lang('buttons.property_option')
                        </a></td>
                        <td><form action="{{ route(name: 'properties.destroy', parameters: $property) }}" method="post">
                            @csrf @method('DELETE')
                            <input type="submit" value="@lang('buttons.delete')" class="button_extra_small">
                        </form></td>
                    </tr>
                @endforeach
                <tr><td colspan="6"><a href="{{ route(name: 'properties.create') }}" class="ordering">
                    @lang('buttons.add_property')
                </a></td></tr>
            </tbody>
        </table>
        {{ $properties->links('pagination::bootstrap-5') }}
    </div>
@endsection
