<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\ResourceController;
use Illuminate\Support\Facades\Route;

// Public routes with rate limiting
Route::post('/auth/register', [AuthController::class, 'register'])
    ->middleware('throttle:10,1'); // 10 attempts per minute

Route::post('/auth/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1'); // 5 attempts per minute (brute force protection)

// Public endpoint for viewing published content
Route::get('/pages/published', [PageController::class, 'published'])
    ->middleware('throttle:60,1'); // 60 requests per minute

// Protected routes
Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/user', [AuthController::class, 'user']);

    // Pages - require librarian or admin role
    Route::middleware('role:admin,librarian')->group(function () {
        Route::post('/pages', [PageController::class, 'store']);
        Route::put('/pages/{page}', [PageController::class, 'update']);
        Route::post('/pages/{page}/publish', [PageController::class, 'publish']);
        Route::post('/pages/{page}/schedule', [PageController::class, 'schedule']);
    });

    // Pages - admin only for delete
    Route::middleware('role:admin')->group(function () {
        Route::delete('/pages/{page}', [PageController::class, 'destroy']);
    });

    // Pages - view endpoints (authenticated users)
    Route::get('/pages', [PageController::class, 'index']);
    Route::get('/pages/{page}', [PageController::class, 'show']);

    // Menus - require librarian or admin role
    Route::middleware('role:admin,librarian')->group(function () {
        Route::resource('menus', MenuController::class)->except(['index', 'show']);
        Route::post('/menus/reorder', [MenuController::class, 'reorder']);
    });

    // Menus - view endpoints
    Route::get('/menus', [MenuController::class, 'index']);
    Route::get('/menus/{menu}', [MenuController::class, 'show']);

    // Staff - require admin role
    Route::middleware('role:admin')->group(function () {
        Route::resource('staff', StaffController::class);
    });

    // Resources - require librarian or admin role
    Route::middleware('role:admin,librarian')->group(function () {
        Route::resource('resources', ResourceController::class)->except(['index', 'show']);
    });

    // Resources - view endpoints
    Route::get('/resources', [ResourceController::class, 'index']);
    Route::get('/resources/{resource}', [ResourceController::class, 'show']);
});
