@extends('layouts.master')

@section('title', 'Categories')

@section('content')
    <h3>@lang('auth/categories/main.title')</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('auth/categories/main.code')</th>
                <th>@lang('auth/categories/main.name')</th>
                <th colspan="3">@lang('auth/categories/main.actions')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a
                            href="{{ route(name: 'categories.show', parameters: $category) }}"
                            class="button_extra_small">
                            @lang('auth/categories/main.open')
                        </a>
                    </td>
                    <td>
                        <a
                            href="{{ route(name: 'categories.edit', parameters: $category) }}"
                            class="button_extra_small">
                            @lang('auth/categories/main.edit')
                        </a>
                    </td>
                    <td>
                        <form action="{{ route(name: 'categories.destroy', parameters: $category) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="@lang('auth/categories/main.delete')" class="button_extra_small">
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6">
                    <a href="{{ route(name: 'categories.create') }}" class="ordering">
                        @lang('auth/categories/main.add')
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection
