@extends('layouts.app')

@section('buttons')
<a class="btn btn-primary" href="{{ route('keywords.create') }}" role="button">Add New keywords</a>
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
            @forelse ($keywords as $keyword)
                <tr>
                    <td>{{ $keyword->id }}</td>
                    <td>{{ $keyword->name }}</td>
                    <td class="Actions">
                        <a href="{{ action('KeywordsController@edit', ['keyword' => $keyword->id ])}}"
                            alt="edit"
                            title="edit">
                            Edit
                        </a>
                        <form style="display: inline-flex !important;" action="{{ action('KeywordsController@destroy', ['keyword' => $keyword->id ])}}" method="POST">
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
    {{ $keywords->links() }}
@endsection