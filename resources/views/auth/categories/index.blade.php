@extends('layouts.master')

<?php /** @var App\Models\Category $category */ ?>

@section('title', __('title.categories'))

@section('content')
    <h3>@lang('titles.categories')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('form.code')</th>
                    <th>@lang('form.name')</th>
                    <th colspan="3">@lang('form.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->code }}</td>
                        <td>{{ $category->__('name') }}</td>
                        <td><a class="button_extra_small"
                            href="{{ route(name: 'categories.show', parameters: $category) }}">
                            @lang('buttons.open')
                        </a></td>
                        <td><a class="button_extra_small"
                            href="{{ route(name: 'categories.edit', parameters: $category) }}">
                            @lang('buttons.edit')
                        </a></td>
                        <td><form action="{{ route(name: 'categories.destroy', parameters: $category) }}" method="post">
                            @csrf @method('DELETE')
                            <input type="submit" value="@lang('buttons.delete')" class="button_extra_small">
                        </form></td>
                    </tr>
                @endforeach
                <tr><td colspan="6"><a href="{{ route(name: 'categories.create') }}" class="ordering">
                    @lang('buttons.add_category')
                </a></td></tr>
            </tbody>
        </table>
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection
