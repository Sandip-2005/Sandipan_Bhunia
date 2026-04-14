<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_title', 'value' => 'Sandipan Bhunia - Full Stack Developer', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Full Stack Developer & QA Engineer', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Passionate full-stack developer skilled in PHP, Laravel, MySQL, and modern web technologies.', 'type' => 'textarea', 'group' => 'general'],
            
            // Contact Information
            ['key' => 'email', 'value' => 'sandipanbhunia18@gmail.com', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '+91 8972966158', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'location', 'value' => 'Chaltatalya, Khejuri, Purba Medinipur, 721431, West Bengal, India', 'type' => 'text', 'group' => 'contact'],
            
            // Social Links
            ['key' => 'github', 'value' => 'https://github.com/sandipanbhunia', 'type' => 'url', 'group' => 'social'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/in/sandipanbhunia', 'type' => 'url', 'group' => 'social'],
            
            // About Section
            ['key' => 'about_me', 'value' => 'Passionate full-stack developer with expertise in Laravel, PHP, and modern web technologies. Currently pursuing BCA and specializing in quality assurance and testing methodologies.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'experience_years', 'value' => '2', 'type' => 'number', 'group' => 'about'],
            ['key' => 'education', 'value' => 'BCA Student (2023-2026) - MAKAUT', 'type' => 'text', 'group' => 'about'],
            
            // Hero Section
            ['key' => 'hero_title', 'value' => "Hi, I'm Sandipan", 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'Full Stack Developer & QA Engineer', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_description', 'value' => 'Passionate about building dynamic web applications, real-time billing systems, and secure dashboards.', 'type' => 'textarea', 'group' => 'hero'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}