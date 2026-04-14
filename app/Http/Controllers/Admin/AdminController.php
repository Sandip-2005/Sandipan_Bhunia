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
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Create uploads directory if it doesn't exist
            $uploadPath = public_path('uploads/profile');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $filename);
            
            // Save to settings
            Setting::updateOrCreate(
                ['key' => 'profile_photo'],
                ['value' => $filename, 'type' => 'image', 'group' => 'profile']
            );

            return response()->json([
                'success' => true,
                'message' => 'Profile photo updated successfully!',
                'photo_url' => asset('uploads/profile/' . $filename)
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No file uploaded']);
    }
}
