<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    ProjectController,
    CategoryController,
    TagController,
    ImageController
};
use Illuminate\Support\Facades\Artisan;

// redirect / and /home to /dashboard
Route::redirect('/', '/dashboard');
Route::redirect('/home', '/dashboard');

Route::middleware(['auth'])->group(function () {
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


    // artisan migrate and artisan db:seed
    Route::get('/run-migration', function () {

        try {
            Artisan::call('optimize:clear');
            // print cache cleared message
            echo Artisan::output();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to clear cache: ' . $e->getMessage()], 500);
        }

        try {
            Artisan::call('migrate');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to migrate and seed: ' . $e->getMessage()], 500);
        }
        return 'Migration complete';
    });

    // seeder
    Route::get('/run-seeder', function () {
        try {
            Artisan::call('db:seed');
            // print db seed message
            echo Artisan::output();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to seed: ' . $e->getMessage()], 500);
        }
        return 'Seeding complete';
    });

    // fresh migration and seed
    Route::get('/run-fresh-migration', function () {
        try {
            Artisan::call('optimize:clear');
            Artisan::call('migrate:fresh --seed');
            // print db seed message
            echo Artisan::output();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to migrate and seed: ' . $e->getMessage()], 500);
        }
        return 'Migration and seeding complete';
    });
});
