<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\StaffController;
use App\Http\Controllers\Web\ResourceController;
use App\Http\Controllers\Public\PageController as PublicPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Web\LibraryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Public routes
// Public routes
Route::get('/', [PublicPageController::class, 'home'])->name('public.home');

Route::get('/storage/{path}', function (string $path) {
    if (str_contains($path, '..')) {
        abort(404);
    }

    $disk = Storage::disk('public');
    if (!$disk->exists($path)) {
        abort(404);
    }

    $mimeType = $disk->mimeType($path) ?? 'application/octet-stream';
    $contents = $disk->get($path);

    return response($contents, 200)
        ->header('Content-Type', $mimeType)
        ->header('Cache-Control', 'public, max-age=31536000');
})->where('path', '.*');


// Public Viewing Routes
Route::get('/public', [PublicPageController::class, 'home'])->name('public.index');
Route::get('/public/news', [\App\Http\Controllers\Public\NewsController::class, 'index'])->name('public.news.index');
Route::get('/public/news/{slug}', [\App\Http\Controllers\Public\NewsController::class, 'show'])->name('public.news.show');
Route::get('/public/staff', [\App\Http\Controllers\Public\StaffController::class, 'index'])->name('public.staff.index');
Route::get('/public/resources', [\App\Http\Controllers\Web\ResourceController::class, 'index'])->name('public.resources.index'); // Reusing Web? verify.
Route::get('/public/{slug}', [PublicPageController::class, 'show'])->name('public.page');

// Authentication Routes with Rate Limiting
Route::middleware('throttle:login')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('throttle:register')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
    Route::get('/register/success', function () {
        return view('auth.register-success');
    })->name('register.success');
});

// Protected Administrative Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Core CMS Resources
    Route::post('/menus/reorder', [MenuController::class, 'reorder'])->name('menus.reorder');
    Route::post('/news/editor-upload', [\App\Http\Controllers\Web\NewsController::class, 'uploadEditorImage'])->name('news.editor-upload');
    Route::get('/news/{news}/preview', [\App\Http\Controllers\Web\NewsController::class, 'preview'])->name('news.preview');
    Route::resources([
        'pages' => PageController::class,
        'menus' => MenuController::class,
        'staff' => StaffController::class,
        'resources' => ResourceController::class,
        'news' => \App\Http\Controllers\Web\NewsController::class,
    ]);
});