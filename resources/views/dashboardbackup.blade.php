{{-- Layouts/app.blade.php is the main layout that your dashboard extends --}}
@extends('layouts.default')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h1 class="mt-5">CMS Dashboard</h1>
        <p>Welcome to your Content Management System. Use the navigation to manage your portfolio.</p>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h2 class="card-title">Projects</h2>
                        <p class="card-text">Manage your projects.</p>
                        <div class="mt-auto align-self-end">
                            <a href="{{ route('projects.index') }}" class="btn btn-light">View Projects</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h2 class="card-title">Categories</h2>
                        <p class="card-text">Organize your projects into categories.</p>
                        <div class="mt-auto align-self-end">
                            <a href="{{ route('categories.index') }}" class="btn btn-light">View Categories</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-warning text-dark mb-4">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h2 class="card-title">Tags</h2>
                        <p class="card-text">Label your projects with tags for easy searching.</p>
                        <div class="mt-auto align-self-end">
                            <a href="{{ route('tags.index') }}" class="btn btn-dark">View Tags</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h2 class="card-title">Images</h2>
                        <p class="card-text">Upload and manage images for your projects.</p>
                        <div class="mt-auto align-self-end">
                            <a href="#" class="btn btn-light">Manage Images</a> {{-- Update the href with the route for image management --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
