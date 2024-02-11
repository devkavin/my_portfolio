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
Route::prefix('v1')->group(function () {
    // Get projects
    Route::get('/get-projects', [ProjectApiController::class, 'index']);

    // Get a single project details
    Route::get('/get-project/{id}', [ProjectApiController::class, 'show']);

    // Get categories
    Route::get('/get-categories', [CategoryApiController::class, 'index']);

    // Get tags
    Route::get('/get-tags', [TagApiController::class, 'index']);
});
