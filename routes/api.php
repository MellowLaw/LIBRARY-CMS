<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LoanController;
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
Route::get('/books', [BookController::class, 'index'])->middleware('throttle:api');
Route::get('/books/{book}', [BookController::class, 'show'])->middleware('throttle:api');

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
    Route::apiResource('pages', PageController::class)->names([
        'index' => 'api.pages.index',
        'store' => 'api.pages.store',
        'show' => 'api.pages.show',
        'update' => 'api.pages.update',
        'destroy' => 'api.pages.destroy',
    ]);

    // Menus: Admin & Librarian
    Route::apiResource('menus', MenuController::class)->except(['index', 'show'])->names([
        'store' => 'api.menus.store',
        'update' => 'api.menus.update',
        'destroy' => 'api.menus.destroy',
    ]);
    Route::get('/menus', [MenuController::class, 'index'])->name('api.menus.index');
    Route::get('/menus/{menu}', [MenuController::class, 'show'])->name('api.menus.show');

    // Staff: Admin only usually, but let's stick to policies
    Route::apiResource('staff', StaffController::class)->names([
        'index' => 'api.staff.index',
        'store' => 'api.staff.store',
        'show' => 'api.staff.show',
        'update' => 'api.staff.update',
        'destroy' => 'api.staff.destroy',
    ]);

    // Resources
    Route::apiResource('resources', ResourceController::class)->names([
        'index' => 'api.resources.index',
        'store' => 'api.resources.store',
        'show' => 'api.resources.show',
        'update' => 'api.resources.update',
        'destroy' => 'api.resources.destroy',
    ]);

    // Books: Admin & Librarian
    Route::apiResource('books', BookController::class)->except(['index', 'show'])->names([
        'store' => 'api.books.store',
        'update' => 'api.books.update',
        'destroy' => 'api.books.destroy',
    ]);

    // Loans: Authenticated users can borrow, staff can manage
    Route::apiResource('loans', LoanController::class)->except(['update'])->names([
        'index' => 'api.loans.index',
        'store' => 'api.loans.store',
        'show' => 'api.loans.show',
        'destroy' => 'api.loans.destroy',
    ]);
    Route::post('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('api.loans.return');
});
