@extends('layouts.master')

@isset($coupon)
    @section('title', __('title.edit_coupon').': '.$coupon->code)
@else
    @section('title', __('title.add_coupon'))
@endisset

@section('content')
    @isset($coupon)
        <h3>@lang('titles.edit_coupon') "{{ $coupon->code }}"</h3>
    @else
        <h3>@lang('titles.add_coupon')</h3>
    @endisset

    <div class="content-main clearfix">
        <form method="post" class="form-container"
            @isset($coupon)
                action="{{ route(name: 'coupons.update', parameters: $coupon) }}"
            @else
                action="{{ route(name: 'coupons.store') }}"
            @endisset>
            @isset($coupon)
                @method('PUT')
            @endisset
            @csrf

            <label for="code">@lang('form.code'):</label>
            @include('layouts.error', ['fieldName' => 'code'])
            <input type="text" name="code" id="code" style="display: block"
                value="@isset($coupon){{ $coupon->code }}@endisset">

            <label for="value">@lang('form.denomination'):</label>
            @include('layouts.error', ['fieldName' => 'value'])
            <input type="text" name="value" id="value" style="display: block"
                value="@isset($coupon){{ $coupon->value }}@endisset">

            <label for="description">@lang('form.description'):</label>
            @include('layouts.error', ['fieldName' => 'description'])
            <textarea name="description" id="description" cols="50" rows="5" style="display: block"
                >@isset($coupon){{ $coupon->description }}@endisset
            </textarea>

            <label for="expired_at">@lang('form.expired_at'):</label>
            @include('layouts.error', ['fieldName' => 'expired_at'])
            <input type="date" name="expired_at" id="expired_at" style="display: block"
                value="@if(isset($coupon) && !is_null($coupon->expired_at))
                {{ $coupon->expired_at->format('Y-m-d') }}@endif">

            <label for="currency_id">@lang('form.currency'):</label>
            @include('layouts.error', ['fieldName' => 'currency_id'])
            <select name="currency_id" id="currency_id" style="display: block">
                <option value="">@lang('form.no_currency')</option>
                @foreach($currencies as $currency)
                    <option value="{{ $currency->id }}"
                        @isset($coupon)
                            @if($coupon->currency_id == $currency->id)
                                selected
                            @endif
                        @endisset
                    >{{ $currency->code }}</option>
                @endforeach
            </select>

            @foreach(['type' => 'Абсолютное значение', 'only_once' => 'Одноразовый купон'] as $field => $title)
                <label for="{{ $field }}">@lang('form.'.$field)</label>
                <input type="checkbox" name="{{ $field }}" id="{{ $field }}"
                    @if(isset($coupon) && $coupon->$field === 1)
                        checked="checked"
                    @endif>
            @endforeach

            <input type="submit" style="display: block" class="btn btn-primary btn-lg px-4 fw-bold"
                value="@lang('buttons.save')">
        </form>
    </div>
@endsection
