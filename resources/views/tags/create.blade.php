@extends('layouts.default')

@section('title', 'Create New Tag')

@section('content')
    <div class="container">
        <h1>Create New Tag</h1>

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

        {{-- Tag creation form --}}
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf {{-- CSRF token for form security --}}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Tag</button>
        </form>
    </div>
@endsection
