<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\StaffController;
use App\Http\Controllers\Web\ResourceController;
use App\Http\Controllers\Public\PageController as PublicPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\LibraryController;
use App\Http\Controllers\Auth\RegisterController;

// Public routes
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/public', [PublicPageController::class, 'home'])->name('public.home');
Route::get('/public/{slug}', [PublicPageController::class, 'show'])->name('public.page');

// Authentication routes
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Pages routes
    Route::resource('pages', PageController::class);
    
    // Menus routes
    Route::resource('menus', MenuController::class);
    
    // Staff routes
    Route::resource('staff', StaffController::class);
    
    // Resources routes
    Route::resource('resources', ResourceController::class);
    
    // API routes for AJAX calls (publish, schedule)
    Route::prefix('api')->name('api.')->group(function () {
        Route::post('/pages/{page}/publish', [\App\Http\Controllers\Api\PageController::class, 'publish'])->name('pages.publish');
        Route::post('/pages/{page}/schedule', [\App\Http\Controllers\Api\PageController::class, 'schedule'])->name('pages.schedule');
    });
});
Route::prefix('library')->name('library.')->group(function() {
    Route::get('/', [LibraryController::class, 'index'])->name('index');
    Route::get('/explore', [LibraryController::class, 'explore'])->name('explore');
    Route::get('/details/{id}', [LibraryController::class, 'details'])->name('details');
    Route::get('/author/{id}', [LibraryController::class, 'author'])->name('author');
    Route::get('/create', [LibraryController::class, 'create'])->name('create');
    Route::post('/store', [LibraryController::class, 'store'])->name('store');
});
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');