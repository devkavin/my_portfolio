@extends('layouts.default')

@section('title', 'Advanced Dashboard')

@section('content')
    <div class="container-fluid mt-4">
        <h1 class="mb-4">CMS Dashboard</h1>

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Projects</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $projectsCount ?? '' }}</h5>
                        <p class="card-text">Manage and view all your projects.</p>
                        <a href="{{ route('projects.index') }}" class="btn btn-dark">Go to Projects</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $categoriesCount ?? '' }}</h5>
                        <p class="card-text">Organize projects into categories.</p>
                        <a href="{{ route('categories.index') }}" class="btn btn-dark">Go to Categories</a>
                    </div>
                </div>
            </div>
            <!-- Add similar cards for Tags and Images -->
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Tags</div>
                    <div class="card-body">
                        <h5 class="card-title
                        ">{{ $tagsCount ?? '' }}</h5>
                        <p class="card-text">Label projects with tags for easy searching.</p>
                        <a href="{{ route('tags.index') }}" class="btn btn-dark">Go to Tags</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Images</div>
                    <div class="card-body">
                        <h5 class="card-title
                        ">{{ $imagesCount ?? '' }}</h5>
                        <p class="card-text">Upload and manage images for your projects.</p>
                        <a href="#" class="btn btn-dark">Go to Images</a>
                    </div>
                </div>
            </div>


            <!-- Recent Projects -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">Recent Projects</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @if ($recentProjects ?? '')
                                @foreach ($recentProjects as $project)
                                    <li class="list-group-item">
                                        {{ $project->title }}
                                        <span class="float-right">{{ $project->created_at->diffForHumans() }}</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Project Analytics -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">Project Analytics - SAMPLE DATA</div>
                    <div class="card-body">
                        <canvas id="projectsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script for Project Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('projectsChart').getContext('2d');
            var projectsChart = new Chart(ctx, {
                type: 'line', // or 'bar', 'pie', etc.
                data: {
                    labels: ['January', 'February', 'March', 'April'], // Example labels
                    datasets: [{
                        label: 'Projects per Month',
                        data: [10, 12, 8, 15], // Example data
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
