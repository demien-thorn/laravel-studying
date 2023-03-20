@extends('layouts.master')

@isset($sku)
    @section('title', __('title.edit_sku').' '.$sku->product->__('name'))
@else
    @section('title', __('title.add_sku'))
@endisset

@section('content')
    @isset($sku)
        <h3>@lang('titles.edit_sku') "{{ $sku->product->__('name') }}"</h3>
    @else
        <h3>@lang('titles.add_sku')</h3>
    @endisset

    <div class="content-main clearfix">
        <form method="post" class="form-container"
            @isset($sku)
                action="{{ route(name: 'skus.update', parameters: [$product, $sku]) }}"
            @else
                action="{{ route(name: 'skus.store', parameters: $product) }}"
            @endisset>
            @isset($sku)
                @method('PUT')
            @endisset
            @csrf

            <label for="price">@lang('form.price'), <i class="fa-solid fa-hryvnia-sign"></i>:</label>
            @include('layouts.error', ['fieldName' => 'price'])
            <input type="text" name="price" id="price" style="display: block"
                   value="@isset($sku){{ $sku->price }}@endisset">

            <label for="count">@lang('form.quantity'), @lang('main.filter.pcs'):</label>
            @include('layouts.error', ['fieldName' => 'count'])
            <input type="text" name="count" id="count" style="display: block"
                   value="@isset($sku){{ $sku->count }}@endisset">

            @foreach($product->properties as $property)
                <label for="property_id[{{ $property->id }}]">{{ $property->name }}:</label>
                @include('layouts.error', ['fieldName' => 'property_id'])
                <select style="display: block"
                    name="property_id[{{ $property->id }}]" id="property_id[{{ $property->id }}]">
                    @foreach($property->propertyOptions as $propertyOption)
                        <option value="{{ $propertyOption->id }}"
                            @isset($sku)
                            @if($sku->propertyOptions->contains($propertyOption->id))
                                selected
                            @endif
                            @endisset
                        >{{ $propertyOption->__('name') }}</option>
                    @endforeach
                </select>
            @endforeach

            <input type="submit" value="@lang('buttons.save')"
               style="display: block" class="btn btn-primary btn-lg px-4 fw-bold">
        </form>
    </div>
@endsection
