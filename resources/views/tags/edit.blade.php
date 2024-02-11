@extends('layouts.default')

@section('title', 'Edit Tag')

@section('content')
    <div class="container">
        <h1>Edit Tag: {{ $tag->name }}</h1>

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

        {{-- Tag edit form --}}
        <form action="{{ route('tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Laravel's way to specify the form should be treated as PUT request --}}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $tag->name) }}"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Update Tag</button>
        </form>
    </div>
@endsection
