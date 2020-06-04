@extends('layouts.app')
@section('content')
<div class="col">
    <h1>Edit Category</h1>
    <hr>
    <form action="{{ route('categories.update',['category' => $category] ) }}" method="POST">
        @method('PUT')
        <div class="form-group row">
            <div class="col-sm-12">
                <input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') ?? $category->name ?? '' }}"/>
                <small class="form-text text-muted">Name of category.</small>
                @if ($errors->has('name'))
                <p class="alert alert-danger">
                    {{ $errors->first('name') }}
                </p>
            @endif
            </div>
        </div>
        @csrf
        <div class="form-group row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
            <div class="col-sm-10">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
</form>
    
@endsection