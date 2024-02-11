@extends('layouts.default')

@section('title', 'Categories')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Categories</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
        </div>

        @include('includes.alerts')

        <div class="mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
