<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UpcomingProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\QaAchievementController;

// Simple health check route
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'timestamp' => now(),
        'message' => 'Application is running'
    ]);
});

// Database cleanup route (temporary)
Route::get('/cleanup-duplicates', function () {
    try {
        $projects = \App\Models\Project::all();
        $duplicates = $projects->groupBy('title')->filter(function ($group) {
            return $group->count() > 1;
        });
        
        $removed = 0;
        foreach ($duplicates as $title => $group) {
            // Keep the first one, remove the rest
            $keep = $group->first();
            $toRemove = $group->skip(1);
            
            foreach ($toRemove as $duplicate) {
                $duplicate->delete();
                $removed++;
            }
        }
        
        return response()->json([
            'status' => 'OK',
            'duplicates_found' => $duplicates->count(),
            'duplicates_removed' => $removed,
            'remaining_projects' => \App\Models\Project::count()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'ERROR',
            'message' => $e->getMessage()
        ], 500);
    }
});

// Debug route for troubleshooting
Route::get('/debug', function () {
    try {
        return response()->json([
            'status' => 'OK',
            'app_key' => env('APP_KEY') ? 'SET' : 'NOT SET',
            'db_connection' => env('DB_CONNECTION'),
            'database_url' => env('DATABASE_URL') ? 'SET' : 'NOT SET',
            'app_env' => env('APP_ENV'),
            'laravel_version' => app()->version(),
            'php_version' => PHP_VERSION,
            'storage_writable' => is_writable(storage_path()),
            'cache_writable' => is_writable(storage_path('framework/cache')),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'ERROR',
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
});

// Public Routes with error handling
Route::get('/', function () {
    try {
        return app(HomeController::class)->index();
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Application Error',
            'message' => $e->getMessage(),
            'debug_url' => url('/debug')
        ], 500);
    }
})->name('home');

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
