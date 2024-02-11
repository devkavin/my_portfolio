@extends('layouts.default')

@section('title', 'Edit Category')

@section('content')
    <div class="container">
        <h1>Edit Category: {{ $category->name }}</h1>

        {{-- Display any validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Category edit form --}}
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Laravel's way to specify the form should be treated as PUT request --}}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $category->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
@endsection
