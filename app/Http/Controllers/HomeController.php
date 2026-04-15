<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UpcomingProject;
use App\Models\Skill;
use App\Models\QaAchievement;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Get featured projects (max 4 for mobile) - ensure unique
            $projects = Project::where('is_active', true)
                              ->where('is_featured', true)
                              ->orderBy('sort_order')
                              ->distinct()
                              ->take(4)
                              ->get();

            // Get all projects for modal - ensure unique
            $allProjects = Project::where('is_active', true)
                                 ->orderBy('sort_order')
                                 ->distinct()
                                 ->get();

            // Get upcoming projects (max 4 for mobile)
            $upcomingProjects = UpcomingProject::where('is_active', true)
                                              ->orderBy('expected_completion')
                                              ->take(4)
                                              ->get();

            // Get skills grouped by category
            $skills = Skill::where('is_active', true)
                          ->orderBy('sort_order')
                          ->get();
            
            $skillsByCategory = $skills->groupBy('category');

            // Get featured QA achievements (max 6 for mobile)
            $qaAchievements = QaAchievement::where('is_active', true)
                                         ->where('is_featured', true)
                                         ->orderBy('sort_order')
                                         ->take(6)
                                         ->get();

            // Get settings
            $settings = $this->getSettings();

            return view('home', compact(
                'projects', 
                'allProjects', 
                'upcomingProjects', 
                'skills', 
                'skillsByCategory', 
                'qaAchievements', 
                'settings'
            ));
        } catch (\Exception $e) {
            // If database fails, return a simple error page or fallback
            return response()->json([
                'error' => 'Database connection failed',
                'message' => $e->getMessage(),
                'suggestion' => 'Please check the deployment logs and database configuration'
            ], 500);
        }
    }

    public function contact(Request $request)
    {
        // Simple validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000'
        ]);

        // In a real application, you would send an email here
        // For now, just return success
        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! I will get back to you soon.'
        ]);
    }

    private function getSettings()
    {
        try {
            // Get all settings from database
            $dbSettings = Setting::all()->pluck('value', 'key')->toArray();
        } catch (\Exception $e) {
            // If database fails, use empty array
            $dbSettings = [];
        }
        
        // Default settings
        $defaults = [
            'site_title' => 'Sandipan Bhunia - Full Stack Developer',
            'site_description' => 'Passionate full-stack developer skilled in PHP, Laravel, MySQL, and modern web technologies.',
            'hero_title' => 'Hi, I\'m Sandipan',
            'hero_subtitle' => 'Full Stack Developer & QA Engineer',
            'hero_description' => 'Passionate about building dynamic web applications, real-time billing systems, and secure dashboards.',
            'email' => 'sandipanbhunia18@gmail.com',
            'phone' => '+91 8972966158',
            'location' => 'Chaltatalya, Khejuri, Purba Medinipur, 721431',
            'github' => 'https://github.com/Sandip-2005',
            'linkedin' => 'https://linkedin.com/in/sandipan-bhunia/',
        ];

        return array_merge($defaults, $dbSettings);
    }
}
