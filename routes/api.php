<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\ResourceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public Authentication Routes
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:register');
});

// Public Content Routes
Route::get('/pages/published', [PageController::class, 'published'])->middleware('throttle:api');

// Protected API Routes
Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    // Auth Management
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
    });

    // Page Management Actions (AJAX/API)
    Route::post('/pages/{page}/publish', [PageController::class, 'publish'])->can('update', 'page');
    Route::post('/pages/{page}/schedule', [PageController::class, 'schedule'])->can('update', 'page');

    // CMS Resources
    // Pages: Admin & Librarian full access, strictly controlled via policies
    Route::apiResource('pages', PageController::class);

    // Menus: Admin & Librarian
    Route::apiResource('menus', MenuController::class)->except(['index', 'show']);
    Route::get('/menus', [MenuController::class, 'index']); // Public/Auth readable
    Route::get('/menus/{menu}', [MenuController::class, 'show']);

    // Staff: Admin only usually, but let's stick to policies
    Route::apiResource('staff', StaffController::class);

    // Resources
    Route::apiResource('resources', ResourceController::class);
});
