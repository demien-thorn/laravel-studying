@extends('layouts.master')

@section('title', __('main.titles.categories'))

@section('content')
    <h3>@lang('main.titles.categories')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('main.table_form.code')</th>
                    <th>@lang('main.table_form.name')</th>
                    <th colspan="3">@lang('main.table_form.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->code }}</td>
                        <td>{{ $category->__('name') }}</td>
                        <td>
                            <a
                                href="{{ route(name: 'categories.show', parameters: $category) }}"
                                class="button_extra_small">
                                @lang('main.buttons.open')
                            </a>
                        </td>
                        <td>
                            <a
                                href="{{ route(name: 'categories.edit', parameters: $category) }}"
                                class="button_extra_small">
                                @lang('main.buttons.edit')
                            </a>
                        </td>
                        <td>
                            <form action="{{ route(name: 'categories.destroy', parameters: $category) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="@lang('main.buttons.delete')" class="button_extra_small">
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6">
                        <a href="{{ route(name: 'categories.create') }}" class="ordering">
                            @lang('main.table_form.add_category')
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection
