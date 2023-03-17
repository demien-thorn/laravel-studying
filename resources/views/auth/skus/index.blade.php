@extends('layouts.master')

@section('title', __('main.titles.skus'))

@section('content')
    <h3>@lang('main.titles.skus') "{{ $product->__('name') }}"</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('main.table_form.properties')</th>
                    <th colspan="4">@lang('main.table_form.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($skus as $sku)
                    <tr>
                        <td>{{ $sku->id }}</td>
                        <td>{{ $sku->propertyOptions->map->__('name')->implode(', ') }}</td>
                        <td><a class="button_extra_small" href="{{ route(
                            name: 'skus.show',
                            parameters: [$product, $sku]) }}">
                            @lang('main.buttons.open')
                        </a></td>
                        <td><a class="button_extra_small"
                            href="{{ route(
                            name: 'skus.edit',
                            parameters: [$product, $sku]) }}">
                            @lang('main.buttons.edit')
                        </a></td>
                        <td><form method="post" action="{{ route(
                            name: 'skus.destroy',
                            parameters: [$product, $sku]) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="@lang('main.buttons.delete')" class="button_extra_small">
                        </form></td>
                    </tr>
                @endforeach
                <tr><td colspan="6"><a href="{{ route(name: 'skus.create', parameters: $product) }}" class="ordering">
                    @lang('main.table_form.add_sku')
                </a></td></tr>
            </tbody>
        </table>
        {{ $skus->links('pagination::bootstrap-5') }}
    </div>
@endsection
