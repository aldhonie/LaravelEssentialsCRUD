@extends('layouts.app')
@section('content')
<div class="col">
    <h1>Edit Book</h1>
    <hr>
    <form action="{{ route('books.update',['book' => $book] ) }}" method="POST">
        @method('PUT')
        <div class="form-group row">
            <div class="col-sm-12">
                <input name="title" type="text" class="form-control" placeholder="Title" value="{{ old('title') ?? $book->title ?? '' }}"/>
                <small class="form-text text-muted">Title of the book.</small>
                @if ($errors->has('title'))
                    <p class="alert alert-danger">
                        {{ $errors->first('title') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
                <input name="description" type="text" class="form-control" placeholder="Description" value="{{ old('description') ?? $book->description ?? '' }}"/>
                <small class="form-text text-muted">Description of the book.</small>                
                @if ($errors->has('description'))
                <p class="alert alert-danger">
                    {{ $errors->first('description') }}
                </p>
            @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">Categories</div>
            <div class="col-sm-10">
                @forelse ($categories as $category)
                <div class="form-check">
                    <input name="categories[]" type="checkbox" class="form-check-input" value="{{ $category->id }}" {{ !$category->checked ?: 'checked' }} />
                    <label class="form-check-label" for="start">{{ $category->name }}</label>
                </div>
                @empty
                    
                @endforelse
                @if ($errors->has('categories'))
                    <p class="alert alert-danger">
                        {{ $errors->first('categories') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">Keywords</div>
            <div class="col-sm-10">
                @forelse ($keywords as $keyword)
                <div class="form-check">
                <input name="keywords[]" type="checkbox" class="form-check-input" value="{{ $keyword->id}}" {{ !$keyword->checked ?: 'checked' }} />
                    <label class="form-check-label" for="start">{{ $keyword->name }}</label>
                </div>
                @empty
                    
                @endforelse
                @if ($errors->has('keywords'))
                    <p class="alert alert-danger">
                        {{ $errors->first('keywords') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12">
                <input name="price" type="text" class="form-control" placeholder="Price" value="{{ old('price') ?? $book->price ?? '' }}"/>
                <small class="form-text text-muted">Price of the book.</small>
                @if ($errors->has('price'))
                    <p class="alert alert-danger">
                        {{ $errors->first('price') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <input name="quantity" type="text" class="form-control" placeholder="Quantity" value="{{ old('quantity') ?? $book->quantity ?? '' }}"/>
                <small class="form-text text-muted">Quantity of the book.</small>
                @if ($errors->has('quantity'))
                <p class="alert alert-danger">
                    {{ $errors->first('quantity') }}
                </p>
            @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <input name="publisher" type="text" class="form-control" placeholder="Publisher" value="{{ old('publisher') ?? $book->publisher ?? '' }}"/>
                <small class="form-text text-muted">Publisher of the book.</small>
                @if ($errors->has('publisher'))
                <p class="alert alert-danger">
                    {{ $errors->first('publisher') }}
                </p>
            @endif
            </div>
        </div>
        @csrf
        <div class="form-group row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Update Book</button>
            </div>
            <div class="col-sm-10">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
</form>
    
@endsection