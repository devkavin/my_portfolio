<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    ProjectController,
    CategoryController,
    TagController,
    ImageController
};

// redirect / to dashboard
Route::redirect('/', '/dashboard');

// Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Project Management
Route::resource('projects', ProjectController::class);

// Category Management
Route::resource('categories', CategoryController::class);

// Tag Management
Route::resource('tags', TagController::class);

// Image Management
Route::post('images/upload', [ImageController::class, 'upload'])->name('images.upload');
Route::delete('images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');
// require __DIR__ . '/auth.php'; // Laravel Breeze, Fortify, or Jetstream routes for authentication