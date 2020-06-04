@extends('layouts.app')
@section('content')
<div class="col">
    <h2>Add New Category</h2>
    <hr>
    <form action="{{ route('categories.store') }}" method="POST">
        <div class="form-group row">
            <div class="col-sm-12">
            <input name="name" type="text" class="form-control" placeholder="Name"/>
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
            <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <div class="col-sm-11">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
    </div>
@endsection