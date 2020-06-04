@extends('layouts.app')

@section('buttons')
<a class="btn btn-primary" href="{{ route('categories.create') }}" role="button">Add New Categories</a>
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th class="Actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="Actions">
                        <a href="{{ action('CategoriesController@edit', ['category' => $category->id ])}}"
                            alt="edit"
                            title="edit">
                            Edit
                        </a>
                        <form style="display: inline-flex !important;" action="{{ action('CategoriesController@destroy', ['category' => $category->id ])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-link" title="Delete" value="DELETE">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
    {{ $categories->links() }}
@endsection