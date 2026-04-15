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
        $results = [];
        
        // Clean up duplicate projects
        $projects = \App\Models\Project::all();
        $projectDuplicates = $projects->groupBy('title')->filter(function ($group) {
            return $group->count() > 1;
        });
        
        $projectsRemoved = 0;
        foreach ($projectDuplicates as $title => $group) {
            // Keep the first one, remove the rest
            $keep = $group->first();
            $toRemove = $group->skip(1);
            
            foreach ($toRemove as $duplicate) {
                $duplicate->delete();
                $projectsRemoved++;
            }
        }
        $results['projects'] = [
            'duplicates_found' => $projectDuplicates->count(),
            'duplicates_removed' => $projectsRemoved,
            'remaining' => \App\Models\Project::count()
        ];
        
        // Clean up duplicate skills
        $skills = \App\Models\Skill::all();
        $skillDuplicates = $skills->groupBy('name')->filter(function ($group) {
            return $group->count() > 1;
        });
        
        $skillsRemoved = 0;
        foreach ($skillDuplicates as $name => $group) {
            $keep = $group->first();
            $toRemove = $group->skip(1);
            
            foreach ($toRemove as $duplicate) {
                $duplicate->delete();
                $skillsRemoved++;
            }
        }
        $results['skills'] = [
            'duplicates_found' => $skillDuplicates->count(),
            'duplicates_removed' => $skillsRemoved,
            'remaining' => \App\Models\Skill::count()
        ];
        
        // Clean up duplicate QA achievements
        $qaAchievements = \App\Models\QaAchievement::all();
        $qaDuplicates = $qaAchievements->groupBy('title')->filter(function ($group) {
            return $group->count() > 1;
        });
        
        $qaRemoved = 0;
        foreach ($qaDuplicates as $title => $group) {
            $keep = $group->first();
            $toRemove = $group->skip(1);
            
            foreach ($toRemove as $duplicate) {
                $duplicate->delete();
                $qaRemoved++;
            }
        }
        $results['qa_achievements'] = [
            'duplicates_found' => $qaDuplicates->count(),
            'duplicates_removed' => $qaRemoved,
            'remaining' => \App\Models\QaAchievement::count()
        ];
        
        // Clean up duplicate upcoming projects
        $upcomingProjects = \App\Models\UpcomingProject::all();
        $upcomingDuplicates = $upcomingProjects->groupBy('title')->filter(function ($group) {
            return $group->count() > 1;
        });
        
        $upcomingRemoved = 0;
        foreach ($upcomingDuplicates as $title => $group) {
            $keep = $group->first();
            $toRemove = $group->skip(1);
            
            foreach ($toRemove as $duplicate) {
                $duplicate->delete();
                $upcomingRemoved++;
            }
        }
        $results['upcoming_projects'] = [
            'duplicates_found' => $upcomingDuplicates->count(),
            'duplicates_removed' => $upcomingRemoved,
            'remaining' => \App\Models\UpcomingProject::count()
        ];
        
        // Clean up duplicate settings
        $settings = \App\Models\Setting::all();
        $settingDuplicates = $settings->groupBy('key')->filter(function ($group) {
            return $group->count() > 1;
        });
        
        $settingsRemoved = 0;
        foreach ($settingDuplicates as $key => $group) {
            $keep = $group->first();
            $toRemove = $group->skip(1);
            
            foreach ($toRemove as $duplicate) {
                $duplicate->delete();
                $settingsRemoved++;
            }
        }
        $results['settings'] = [
            'duplicates_found' => $settingDuplicates->count(),
            'duplicates_removed' => $settingsRemoved,
            'remaining' => \App\Models\Setting::count()
        ];
        
        $totalRemoved = $projectsRemoved + $skillsRemoved + $qaRemoved + $upcomingRemoved + $settingsRemoved;
        
        return response()->json([
            'status' => 'SUCCESS',
            'message' => "Cleanup completed! Removed {$totalRemoved} duplicate entries.",
            'details' => $results,
            'timestamp' => now()
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
