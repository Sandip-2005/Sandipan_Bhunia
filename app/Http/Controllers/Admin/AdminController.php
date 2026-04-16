<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\UpcomingProject;
use App\Models\Skill;
use App\Models\QaAchievement;
use App\Models\Visit;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Add authentication middleware here if needed
        // $this->middleware('auth');
    }

    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'upcoming_projects' => UpcomingProject::count(),
            'skills' => Skill::count(),
            'qa_achievements' => QaAchievement::count(),
            'featured_projects' => Project::where('is_featured', true)->count(),
            'active_projects' => Project::where('is_active', true)->count(),
            
            // Visit statistics
            'total_visits' => Visit::getTotalVisits(),
            'unique_visitors' => Visit::getUniqueVisitors(),
            'today_visits' => Visit::getTodayVisits(),
            'monthly_visits' => Visit::getMonthlyVisits(),
        ];

        $recentProjects = Project::latest()->take(5)->get();
        $recentUpcoming = UpcomingProject::latest()->take(5)->get();
        
        // Recent visits for admin
        $recentVisits = Visit::latest('visited_at')->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentUpcoming', 'recentVisits'));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Simple authentication - in production, use proper authentication
        if ($request->username === 'SandipanBhunia2005' && $request->password === '@SandipanBhunia2005') {
            session(['admin_authenticated' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['credentials' => 'Invalid credentials']);
    }

    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect()->route('admin.login');
    }

    public function settings()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($request->settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Settings updated successfully!');
    }

    public function uploadProfilePhoto(Request $request)
    {
        try {
            // Enhanced validation with better error messages
            $request->validate([
                'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120' // 5MB max
            ], [
                'profile_photo.required' => 'Please select a photo to upload.',
                'profile_photo.image' => 'The file must be an image.',
                'profile_photo.mimes' => 'Only JPEG, PNG, JPG, GIF, and WebP images are allowed.',
                'profile_photo.max' => 'The image size must not exceed 5MB.'
            ]);

            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                
                // Check if file is valid
                if (!$file->isValid()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The uploaded file is corrupted or invalid.'
                    ], 400);
                }
                
                $filename = 'profile_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Create uploads directory if it doesn't exist with proper permissions
                $uploadPath = public_path('uploads/profile');
                if (!file_exists($uploadPath)) {
                    if (!mkdir($uploadPath, 0755, true)) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Failed to create upload directory. Please check permissions.'
                        ], 500);
                    }
                }
                
                // Check if directory is writable
                if (!is_writable($uploadPath)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Upload directory is not writable. Please check permissions.'
                    ], 500);
                }
                
                // Delete old profile photo if exists
                $oldPhoto = Setting::where('key', 'profile_photo')->first();
                if ($oldPhoto && $oldPhoto->value) {
                    $oldPath = public_path('uploads/profile/' . $oldPhoto->value);
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                
                // Move the new file
                if ($file->move($uploadPath, $filename)) {
                    // Save to settings
                    Setting::updateOrCreate(
                        ['key' => 'profile_photo'],
                        [
                            'value' => $filename, 
                            'type' => 'image', 
                            'group' => 'profile'
                        ]
                    );

                    return response()->json([
                        'success' => true,
                        'message' => 'Profile photo updated successfully!',
                        'photo_url' => asset('uploads/profile/' . $filename)
                    ]);
                } else {
                    return response()->json([
                        'success' => false, 
                        'message' => 'Failed to save the uploaded file. Please try again.'
                    ], 500);
                }
            }

            return response()->json([
                'success' => false, 
                'message' => 'No file was uploaded. Please select a photo.'
            ], 400);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(' ', array_map(function($errors) {
                    return implode(' ', $errors);
                }, $e->errors()))
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Profile photo upload error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
