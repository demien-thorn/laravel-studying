@extends('layouts.master')

@section('title', __('title.coupons'))

@section('content')
    <h3>@lang('titles.coupons')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('form.code')</th>
                <th>@lang('form.description')</th>
                <th colspan="4">@lang('form.actions')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->description }}</td>
                    <td><a href="{{ route(name: 'coupons.show', parameters: $coupon) }}" class="button_extra_small">
                        @lang('buttons.open')
                    </a></td>
                    <td><a href="{{ route(name: 'coupons.edit', parameters: $coupon) }}" class="button_extra_small">
                        @lang('buttons.edit')
                    </a></td>
                    <td><form action="{{ route(name: 'coupons.destroy', parameters: $coupon) }}" method="post">
                        @csrf @method('DELETE')
                        <input type="submit" value="@lang('buttons.delete')" class="button_extra_small">
                    </form></td>
                </tr>
            @endforeach
            <tr><td colspan="9"><a href="{{ route(name: 'coupons.create') }}" class="ordering">
                @lang('buttons.add_coupon')
            </a></td></tr>
            </tbody>
        </table>
        {{ $coupons->links('pagination::bootstrap-5') }}
    </div>
@endsection
