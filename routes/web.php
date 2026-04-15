<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UpcomingProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\QaAchievementController;

// Debug route for troubleshooting
Route::get('/debug', function () {
    return response()->json([
        'status' => 'OK',
        'app_key' => env('APP_KEY') ? 'SET' : 'NOT SET',
        'db_connection' => env('DB_CONNECTION'),
        'db_host' => env('DB_HOST'),
        'app_env' => env('APP_ENV'),
        'laravel_version' => app()->version(),
        'php_version' => PHP_VERSION,
    ]);
});

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact');

// Secret Admin Routes (hidden path)
Route::prefix('secret-gateway')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    // Protected Admin Routes
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Settings Routes
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
        Route::post('/upload-profile-photo', [AdminController::class, 'uploadProfilePhoto'])->name('admin.upload.profile');
        
        // Resource Routes
        Route::resource('projects', ProjectController::class, ['as' => 'admin']);
        Route::resource('upcoming-projects', UpcomingProjectController::class, ['as' => 'admin']);
        Route::resource('skills', SkillController::class, ['as' => 'admin']);
        Route::resource('qa-achievements', QaAchievementController::class, ['as' => 'admin']);
    });
});
