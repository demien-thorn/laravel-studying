@extends('layouts.master')

<?php /** @var App\Models\Merchant $merchants */ ?>

@section('title', __('title.merchants'))

@section('content')
    <h3>@lang('titles.merchants')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('form.name')</th>
                    <th>@lang('form.email')</th>
                    <th colspan="4">@lang('form.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($merchants as $merchant)
                    <tr>
                        <td>{{ $merchant->id }}</td>
                        <td>{{ $merchant->name }}</td>
                        <td>{{ $merchant->email }}</td>
                        <td><a class="button_extra_small"
                            href="{{ route(name: 'merchants.show', parameters: $merchant) }}">
                            @lang('buttons.open')
                        </a></td>
                        <td><a class="button_extra_small"
                            href="{{ route(name: 'merchants.edit', parameters: $merchant) }}">
                            @lang('buttons.edit')
                        </a></td>
                        <td><a class="button_extra_small"
                            href="{{ route(name: 'merchants.update_token', parameters: $merchant) }}">
                            @lang('buttons.update_token')
                        </a></td>
                        <td><form action="{{ route(name: 'merchants.destroy', parameters: $merchant) }}" method="post">
                            @csrf @method('DELETE')
                            <input type="submit" value="@lang('buttons.delete')" class="button_extra_small">
                        </form></td>
                    </tr>
                @endforeach
                <tr><td colspan="7"><a href="{{ route(name: 'merchants.create') }}" class="ordering">
                    @lang('buttons.add_merchant')
                </a></td></tr>
            </tbody>
        </table>
        {{ $merchants->links('pagination::bootstrap-5') }}
    </div>
@endsection
