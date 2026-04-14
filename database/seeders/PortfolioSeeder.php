<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\UpcomingProject;
use App\Models\Skill;
use App\Models\QaAchievement;
use App\Models\Setting;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Create Projects based on resume
        Project::create([
            'title' => 'Online Voting System',
            'description' => 'Built a full-stack web application for managing digital elections with separate Admin and Voter dashboards. Admin can create elections, manage candidates, and publish results. Displays live vote counts, percentages, and rankings.',
            'tech_stack' => 'PHP, HTML, CSS, Bootstrap-5.3, JavaScript, MySQL',
            'github_link' => 'https://github.com/Sandip-2005/Online_Voting',
            'features' => [
                'Separate Admin and Voter dashboards',
                'Election creation and management',
                'Live vote counting and results',
                'Candidate management system',
                'Real-time percentage calculations'
            ],
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1
        ]);

        Project::create([
            'title' => 'E-Billing System',
            'description' => 'Currently developing a full-stack Inventory & POS System using Laravel and MySQL. Features multi-shop management, real-time inventory updates, flexible billing module, and comprehensive CRM functionality.',
            'tech_stack' => 'PHP, Laravel, HTML, CSS, Bootstrap-5.3, JavaScript, MySQL',
            'github_link' => 'https://github.com/Sandip-2005/E-Billing.git',
            'features' => [
                'Multi-shop management system',
                'Real-time inventory updates',
                'Flexible billing module',
                'Customer management CRM',
                'Partial payment tracking'
            ],
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 2
        ]);

        // Create Upcoming Projects
        UpcomingProject::create([
            'title' => 'Advanced E-Commerce Platform',
            'description' => 'Building a comprehensive e-commerce solution with advanced features like AI-powered recommendations, real-time chat support, and integrated payment gateways.',
            'tech_stack' => 'Laravel, Vue.js, MySQL, Redis, Stripe API',
            'progress_percentage' => 65,
            'expected_completion' => now()->addMonths(3),
            'status' => 'in_progress',
            'current_phase' => 'Implementing payment integration and order management',
            'milestones' => [
                'User authentication - Completed',
                'Product catalog - Completed',
                'Shopping cart - Completed',
                'Payment integration - In Progress',
                'Order management - Pending'
            ],
            'is_active' => true
        ]);

        UpcomingProject::create([
            'title' => 'Portfolio Management Dashboard',
            'description' => 'Creating an advanced admin dashboard for managing multiple client portfolios with analytics, reporting, and automated content generation.',
            'tech_stack' => 'Laravel, Alpine.js, Chart.js, Tailwind CSS',
            'progress_percentage' => 30,
            'expected_completion' => now()->addMonths(4),
            'status' => 'planning',
            'current_phase' => 'Database design and API planning',
            'milestones' => [
                'Requirements analysis - Completed',
                'Database design - In Progress',
                'API development - Pending',
                'Frontend development - Pending'
            ],
            'is_active' => true
        ]);

        // Create Skills
        $skills = [
            // Backend
            ['name' => 'PHP', 'category' => 'backend', 'proficiency_level' => 5, 'icon' => '🐘', 'is_featured' => true],
            ['name' => 'Laravel', 'category' => 'backend', 'proficiency_level' => 5, 'icon' => '🔥', 'is_featured' => true],
            ['name' => 'MySQL', 'category' => 'database', 'proficiency_level' => 4, 'icon' => '🗄️', 'is_featured' => true],
            
            // Frontend
            ['name' => 'HTML', 'category' => 'frontend', 'proficiency_level' => 5, 'icon' => '🌐', 'is_featured' => true],
            ['name' => 'CSS', 'category' => 'frontend', 'proficiency_level' => 5, 'icon' => '🎨', 'is_featured' => true],
            ['name' => 'JavaScript', 'category' => 'frontend', 'proficiency_level' => 4, 'icon' => '⚡', 'is_featured' => true],
            ['name' => 'Bootstrap', 'category' => 'frontend', 'proficiency_level' => 4, 'icon' => '🅱️', 'is_featured' => false],
            ['name' => 'Tailwind CSS', 'category' => 'frontend', 'proficiency_level' => 4, 'icon' => '💨', 'is_featured' => false],
            
            // Tools & Others
            ['name' => 'Git', 'category' => 'tools', 'proficiency_level' => 4, 'icon' => '📚', 'is_featured' => true],
            ['name' => 'OOP', 'category' => 'backend', 'proficiency_level' => 4, 'icon' => '🏗️', 'is_featured' => false],
            ['name' => 'MVC', 'category' => 'backend', 'proficiency_level' => 4, 'icon' => '🏛️', 'is_featured' => false],
            
            // QA Skills
            ['name' => 'Manual Testing', 'category' => 'qa', 'proficiency_level' => 4, 'icon' => '🔍', 'is_featured' => true],
            ['name' => 'Test Case Design', 'category' => 'qa', 'proficiency_level' => 4, 'icon' => '📋', 'is_featured' => false],
            ['name' => 'Bug Reporting', 'category' => 'qa', 'proficiency_level' => 4, 'icon' => '🐛', 'is_featured' => false],
        ];

        foreach ($skills as $index => $skill) {
            Skill::create(array_merge($skill, [
                'sort_order' => $index,
                'is_active' => true
            ]));
        }

        // Create QA Achievements
        QaAchievement::create([
            'title' => 'Critical Security Bug Discovery',
            'description' => 'Identified and reported a critical SQL injection vulnerability in the user authentication system that could have compromised user data.',
            'tool_used' => 'Manual',
            'achievement_type' => 'bug_found',
            'bugs_found' => 1,
            'project_name' => 'E-Commerce Platform',
            'achievement_date' => now()->subMonths(2),
            'impact' => 'Prevented potential data breach affecting 1000+ users',
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1
        ]);

        QaAchievement::create([
            'title' => 'Payment Gateway Testing',
            'description' => 'Conducted comprehensive testing of payment integration including edge cases, error handling, and security validation.',
            'tool_used' => 'Postman',
            'achievement_type' => 'automation_created',
            'bugs_found' => 5,
            'project_name' => 'Online Voting System',
            'achievement_date' => now()->subMonths(1),
            'impact' => 'Improved payment success rate by 15%',
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 2
        ]);

        QaAchievement::create([
            'title' => 'Performance Optimization',
            'description' => 'Identified performance bottlenecks in database queries and implemented optimization strategies.',
            'tool_used' => 'Manual',
            'achievement_type' => 'performance_improved',
            'bugs_found' => 3,
            'project_name' => 'E-Billing System',
            'achievement_date' => now()->subWeeks(2),
            'impact' => 'Reduced page load time by 40%',
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 3
        ]);

        // Create Settings
        $settings = [
            ['key' => 'site_title', 'value' => 'Sandipan Bhunia - Full Stack Developer', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Passionate full-stack developer skilled in PHP, Laravel, MySQL, and modern web technologies.', 'group' => 'general'],
            ['key' => 'hero_title', 'value' => 'Hi, I\'m Sandipan', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'Full Stack Developer & QA Engineer', 'group' => 'hero'],
            ['key' => 'hero_description', 'value' => 'Passionate about building dynamic web applications, real-time billing systems, and secure dashboards.', 'group' => 'hero'],
            ['key' => 'email', 'value' => 'sandipanbhunia18@gmail.com', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '+91 8972966158', 'group' => 'contact'],
            ['key' => 'location', 'value' => 'Chaltatalya, Khejuri, Purba Medinipur, 721431', 'group' => 'contact'],
            ['key' => 'github', 'value' => 'https://github.com/Sandip-2005', 'group' => 'social'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/in/sandipan-bhunia/', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
