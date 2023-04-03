@extends('layouts.master')

<?php /** @var App\Models\Merchant $merchant */ ?>

@isset($merchant)
    @section('title', __('title.edit_merchant').' '.$merchant->name)
@else
    @section('title', __('title.add_merchant'))
@endisset

@section('content')
    @isset($merchant)
        <h3>@lang('titles.edit_merchant') "{{ $merchant->name }}"</h3>
    @else
        <h3>@lang('titles.add_merchant')</h3>
    @endisset

    <div class="content-main clearfix">
        <form
            @isset($merchant)
                action="{{ route(name: 'merchants.update', parameters: $merchant) }}"
            @else
                action="{{ route(name: 'merchants.store') }}"
            @endisset
            method="post" enctype="multipart/form-data" class="form-container">
            @isset($merchant)
                @method('PUT')
            @endisset
            @csrf

            <label for="name">@lang('form.name'):</label>
            @include('layouts.error', ['fieldName' => 'name'])
            <input type="text" name="name" id="name" style="display: block"
               value="@isset($merchant){{ $merchant->name }}@endisset">

            <label for="email">@lang('form.email'):</label>
            @include('layouts.error', ['fieldName' => 'email'])
            <input type="email" name="email" id="email" style="display: block"
               value="@isset($merchant){{ $merchant->email }}@endisset">

            <input type="submit" value="@lang('buttons.save')"
               style="display: block" class="btn btn-primary btn-lg px-4 fw-bold">
        </form>
    </div>
@endsection
