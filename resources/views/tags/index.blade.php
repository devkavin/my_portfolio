@extends('layouts.default')

@section('title', 'Tags')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Tags</h1>
            <a href="{{ route('tags.create') }}" class="btn btn-primary">Add New Tag</a>
        </div>

        @include('includes.alerts')

        <div class="mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tags as $tag)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->description }}</td>
                            <td>
                                <a href="{{ route('tags.edit', $tag) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('tags.destroy', $tag) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Tags found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
