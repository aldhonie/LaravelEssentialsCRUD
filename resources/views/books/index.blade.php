@extends('layouts.app')

@section('buttons')
<a class="btn btn-primary" href="{{ route('books.create') }}" role="button">Add New Books</a>
@endsection

@section('content')
@if ($errors->any())
    @foreach($errors->all() as $error)
    <p class="alert alert-danger">
        {{ $error }}
    </p>
    @endforeach
@endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Keywords</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Publisher</th>
                <th class="Actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ (strlen($book->description) > 100) ? mb_substr($book->description,0, 100-3).'...' : $book->description }}</td>
                    <td>
                        @foreach ($book->categories as $i => $category)
                            {{ $i > 0 ? ', ' :''}}{{ $category->name}}
                        @endforeach
                    </td>
                    <td>
                        @foreach ($book->keywords as $i => $keyword)
                            {{ $i > 0 ? ', ' :''}}{{ $keyword->name }}
                        @endforeach
                    </td>
                    <td>{{ $book->price }}</td>
                    <td>{{ $book->quantity}}</td>
                    <td>{{ $book->publisher }}</td>
                    <td class="Actions">
                        <a href="{{ action('BooksController@edit', ['book' => $book->id ])}}"
                            alt="edit"
                            title="edit">
                            Edit
                        </a>
                        <form style="display: inline-flex !important;" action="{{ action('BooksController@destroy', ['book' => $book->id ])}}" method="POST">
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
    {{ $books->links() }}
@endsection