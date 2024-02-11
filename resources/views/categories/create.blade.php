@extends('layouts.default')

@section('title', 'Create New Category')

@section('content')
    <div class="container">
        <h1>Create New Category</h1>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Category creation form --}}
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf {{-- CSRF token for form security --}}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description (Optional)</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>
@endsection
