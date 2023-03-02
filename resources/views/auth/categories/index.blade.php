@extends('layouts.master')

@section('title', 'Categories')

@section('content')
    <h3>Categories</h3>

    <div class="content-main clearfix">
        <table class="order-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route(name: 'categories.show', parameters: $category) }}" class="button_extra_small">
                            Open
                        </a>
                    </td>
                    <td>
                        <a href="{{ route(name: 'categories.edit', parameters: $category) }}" class="button_extra_small">
                            Edit
                        </a>
                    </td>
                    <td>
                        <form action="{{ route(name: 'categories.destroy', parameters: $category) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="button_extra_small">
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6">
                    <a href="{{ route(name: 'categories.create') }}" class="ordering">
                        Add a new category
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection
