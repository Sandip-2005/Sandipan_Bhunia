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
            // Get featured projects (max 4 for mobile) - PostgreSQL compatible
            $projects = Project::where('is_active', true)
                              ->where('is_featured', true)
                              ->orderBy('sort_order')
                              ->orderBy('id') // Add secondary sort for consistency
                              ->take(4)
                              ->get()
                              ->unique('title'); // Remove duplicates in PHP instead of SQL

            // Get all projects for modal - PostgreSQL compatible
            $allProjects = Project::where('is_active', true)
                                 ->orderBy('sort_order')
                                 ->orderBy('id')
                                 ->get()
                                 ->unique('title'); // Remove duplicates in PHP

            // Get upcoming projects (max 4 for mobile)
            $upcomingProjects = UpcomingProject::where('is_active', true)
                                              ->orderBy('expected_completion')
                                              ->take(4)
                                              ->get();

            // Get skills grouped by category - PROPERLY SORTED BY ORDER
            $skills = Skill::where('is_active', true)
                          ->orderBy('sort_order', 'asc')
                          ->orderBy('id', 'asc')
                          ->get();
            
            // Group by category while maintaining sort order within each category
            $skillsByCategory = $skills->groupBy('category')->map(function ($categorySkills) {
                return $categorySkills->sortBy('sort_order');
            });

            // Get featured QA achievements (max 6 for mobile)
            $qaAchievements = QaAchievement::where('is_active', true)
                                         ->where('is_featured', true)
                                         ->orderBy('sort_order')
                                         ->take(6)
                                         ->get();

            // Get settings
            $settings = $this->getSettings();

            // Get public CVs
            $publicCvs = \App\Models\Cv::where('is_public', true)
                                      ->orderBy('sort_order')
                                      ->orderBy('id', 'desc')
                                      ->get();

            return view('home', compact(
                'projects', 
                'allProjects', 
                'upcomingProjects', 
                'skills', 
                'skillsByCategory', 
                'qaAchievements', 
                'settings',
                'publicCvs'
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

        $settings = $this->getSettings();
        // Use the configured email, fallback to a default if not found
        $adminEmail = $settings['email'] ?? 'sandipanbhunia18@gmail.com';

        try {
            // Send the email to the admin
            \Illuminate\Support\Facades\Mail::raw(
                "New message from your portfolio website:\n\nName: {$request->name}\nEmail: {$request->email}\n\nMessage:\n{$request->message}",
                function ($message) use ($request, $adminEmail) {
                    $message->to($adminEmail)
                            ->subject('Portfolio Contact: ' . $request->subject)
                            ->replyTo($request->email, $request->name);
                }
            );

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! It has been sent successfully.'
            ]);
        } catch (\Exception $e) {
            // Log the error in a real app, here we return a friendly error message
            return response()->json([
                'success' => false,
                'message' => 'Sorry, we could not send your message right now. Please try again later or email me directly at ' . $adminEmail . '.'
            ], 500);
        }
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
