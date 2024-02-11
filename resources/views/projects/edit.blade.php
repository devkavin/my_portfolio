@extends('layouts.default')

@section('title', 'Edit Project')

@section('content')
    <div class="container">
        <h1>Edit Project</h1>

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

        {{-- Project edit form --}}
        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Specify the method to use for the form (PUT for update) --}}

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $project->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">Select a Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Optionally, include a section for tags if the project has associated tags --}}
            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control" id="tags" name="tags[]" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                            {{ collect(old('tags', $project->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>
                            {{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Optionally, include a file input for project images if applicable --}}
            <div class="form-group">
                <label for="project_image">Project Image</label>
                <input type="file" class="form-control-file" id="project_image" name="project_image">
                {{-- Display the current image if available --}}
                @if ($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="Project Image" class="img-thumbnail mt-2"
                        width="200">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Project</button>
        </form>
    </div>
@endsection
