<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UpcomingProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\QaAchievementController;
use App\Http\Controllers\Admin\CvController;

// Simple health check route
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'timestamp' => now(),
        'message' => 'Application is running'
    ]);
});

// Test route to check projects without distinct
Route::get('/test-projects', function () {
    try {
        $projects = \App\Models\Project::where('is_active', true)
                                      ->where('is_featured', true)
                                      ->orderBy('sort_order')
                                      ->orderBy('id')
                                      ->take(4)
                                      ->get();
        
        return response()->json([
            'status' => 'OK',
            'projects_count' => $projects->count(),
            'projects' => $projects->map(function($project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'is_active' => $project->is_active,
                    'is_featured' => $project->is_featured
                ];
            })
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

// Cleanup route for removing duplicates - IMPROVED VERSION
Route::get('/cleanup-duplicates', function () {
    try {
        $results = [
            'projects' => [],
            'skills' => [],
            'qa_achievements' => [],
            'upcoming_projects' => [],
            'settings' => []
        ];
        
        // Clean Projects - Keep the one with lowest ID (first created)
        $projects = \App\Models\Project::all();
        $projectGroups = $projects->groupBy('title');
        $projectDuplicatesRemoved = 0;
        
        foreach ($projectGroups as $title => $group) {
            if ($group->count() > 1) {
                // Keep the first one (lowest ID), delete the rest
                $keep = $group->sortBy('id')->first();
                $duplicates = $group->reject(fn($item) => $item->id === $keep->id);
                foreach ($duplicates as $duplicate) {
                    $duplicate->delete();
                    $projectDuplicatesRemoved++;
                }
            }
        }
        
        $results['projects'] = [
            'duplicates_found' => $projectGroups->filter(fn($group) => $group->count() > 1)->count(),
            'duplicates_removed' => $projectDuplicatesRemoved,
            'remaining' => \App\Models\Project::count()
        ];
        
        // Clean Skills - Keep the one with lowest ID
        $skills = \App\Models\Skill::all();
        $skillGroups = $skills->groupBy(function($skill) {
            return $skill->name . '|' . $skill->category; // Group by name AND category
        });
        $skillDuplicatesRemoved = 0;
        
        foreach ($skillGroups as $key => $group) {
            if ($group->count() > 1) {
                // Keep the first one (lowest ID), delete the rest
                $keep = $group->sortBy('id')->first();
                $duplicates = $group->reject(fn($item) => $item->id === $keep->id);
                foreach ($duplicates as $duplicate) {
                    $duplicate->delete();
                    $skillDuplicatesRemoved++;
                }
            }
        }
        
        $results['skills'] = [
            'duplicates_found' => $skillGroups->filter(fn($group) => $group->count() > 1)->count(),
            'duplicates_removed' => $skillDuplicatesRemoved,
            'remaining' => \App\Models\Skill::count()
        ];
        
        // Clean QA Achievements - Keep the one with lowest ID
        $qaAchievements = \App\Models\QaAchievement::all();
        $qaGroups = $qaAchievements->groupBy('title');
        $qaDuplicatesRemoved = 0;
        
        foreach ($qaGroups as $title => $group) {
            if ($group->count() > 1) {
                // Keep the first one (lowest ID), delete the rest
                $keep = $group->sortBy('id')->first();
                $duplicates = $group->reject(fn($item) => $item->id === $keep->id);
                foreach ($duplicates as $duplicate) {
                    $duplicate->delete();
                    $qaDuplicatesRemoved++;
                }
            }
        }
        
        $results['qa_achievements'] = [
            'duplicates_found' => $qaGroups->filter(fn($group) => $group->count() > 1)->count(),
            'duplicates_removed' => $qaDuplicatesRemoved,
            'remaining' => \App\Models\QaAchievement::count()
        ];
        
        // Clean Upcoming Projects - Keep the one with lowest ID
        $upcomingProjects = \App\Models\UpcomingProject::all();
        $upcomingGroups = $upcomingProjects->groupBy('title');
        $upcomingDuplicatesRemoved = 0;
        
        foreach ($upcomingGroups as $title => $group) {
            if ($group->count() > 1) {
                // Keep the first one (lowest ID), delete the rest
                $keep = $group->sortBy('id')->first();
                $duplicates = $group->reject(fn($item) => $item->id === $keep->id);
                foreach ($duplicates as $duplicate) {
                    $duplicate->delete();
                    $upcomingDuplicatesRemoved++;
                }
            }
        }
        
        $results['upcoming_projects'] = [
            'duplicates_found' => $upcomingGroups->filter(fn($group) => $group->count() > 1)->count(),
            'duplicates_removed' => $upcomingDuplicatesRemoved,
            'remaining' => \App\Models\UpcomingProject::count()
        ];
        
        // Clean Settings - Keep the latest one (highest updated_at)
        $settings = \App\Models\Setting::all();
        $settingGroups = $settings->groupBy('key');
        $settingDuplicatesRemoved = 0;
        
        foreach ($settingGroups as $key => $group) {
            if ($group->count() > 1) {
                // Keep the latest one, delete the rest
                $keep = $group->sortByDesc('updated_at')->first();
                $duplicates = $group->reject(fn($item) => $item->id === $keep->id);
                foreach ($duplicates as $duplicate) {
                    $duplicate->delete();
                    $settingDuplicatesRemoved++;
                }
            }
        }
        
        $results['settings'] = [
            'duplicates_found' => $settingGroups->filter(fn($group) => $group->count() > 1)->count(),
            'duplicates_removed' => $settingDuplicatesRemoved,
            'remaining' => \App\Models\Setting::count()
        ];
        
        $totalRemoved = $projectDuplicatesRemoved + $skillDuplicatesRemoved + $qaDuplicatesRemoved + $upcomingDuplicatesRemoved + $settingDuplicatesRemoved;
        
        return response()->json([
            'status' => 'SUCCESS',
            'message' => "Cleanup completed! Removed {$totalRemoved} duplicate entries.",
            'details' => $results,
            'timestamp' => now()->toISOString()
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

// Artisan command route for cleanup (can be called via URL)
Route::get('/artisan/cleanup', function () {
    try {
        \Artisan::call('db:seed', ['--class' => 'PortfolioSeeder', '--force' => true]);
        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Database reseeded successfully with duplicate prevention',
            'output' => \Artisan::output()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'ERROR',
            'message' => $e->getMessage()
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

// Public CV routes - Enhanced with viewing capability
Route::get('/cv/download', function () {
    $cv = \App\Models\Cv::where('is_public', true)->orderBy('sort_order')->orderBy('id', 'desc')->first();
    if (!$cv) { abort(404, 'CV not available.'); }
    return redirect()->route('cv.download.multi', $cv->id);
})->name('cv.download');

Route::get('/cv/view/{cv}', function (\App\Models\Cv $cv) {
    if (!$cv->is_public) { abort(403, 'This CV is private.'); }
    $filePath = public_path('uploads/cv/' . $cv->filename);
    if (!file_exists($filePath)) { abort(404, 'CV file not found.'); }
    
    $extension = strtolower(pathinfo($cv->filename, PATHINFO_EXTENSION));
    
    // Return the file for inline viewing
    return response()->file($filePath, [
        'Content-Type' => $extension === 'pdf' ? 'application/pdf' : mime_content_type($filePath),
        'Content-Disposition' => 'inline; filename="' . $cv->original_name . '"'
    ]);
})->name('cv.view');

Route::get('/cv/download/{cv}', function (\App\Models\Cv $cv) {
    if (!$cv->is_public) { abort(403, 'This CV is private.'); }
    $filePath = public_path('uploads/cv/' . $cv->filename);
    if (!file_exists($filePath)) { abort(404, 'CV file not found.'); }
    return response()->download($filePath, $cv->original_name);
})->name('cv.download.multi');

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
        Route::resource('cvs', CvController::class, ['as' => 'admin'])->except(['create', 'show', 'edit']);
    });
});
