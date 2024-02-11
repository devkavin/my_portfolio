<?php

// Routes in routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProjectApiController;
use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\TagApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Grouping routes with a prefix for versioning
Route::prefix('v1')->middleware('throttle:60,1')->group(function () {
    // Get projects
    Route::get('/get-projects/{page}/{limit}', [ProjectApiController::class, 'getProjectsList']);

    // Get a specific project by ID
    Route::get('/get-project/{id}', [ProjectApiController::class, 'show']);

    // Get categories
    Route::get('/get-categories', [CategoryApiController::class, 'getCategories']);

    // Get a specific category by ID
    Route::get('/get-category/{id}', [CategoryApiController::class, 'getCategoryById']);

    // Get tags
    Route::get('/get-tags', [TagApiController::class, 'getTags']);

    // Get a specific tag by ID
    Route::get('/get-tag/{id}', [TagApiController::class, 'getTagById']);
});
