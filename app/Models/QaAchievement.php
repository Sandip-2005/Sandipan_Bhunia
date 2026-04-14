<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QaAchievement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'tool_used',
        'achievement_type',
        'bugs_found',
        'project_name',
        'achievement_date',
        'impact',
        'evidence_link',
        'sort_order',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'achievement_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Simple helper methods
    public function getToolIconAttribute()
    {
        $icons = [
            'Selenium' => '🤖',
            'Postman' => '📮',
            'Manual' => '🔍',
            'Jest' => '🃏',
            'Cypress' => '🌲'
        ];

        return $icons[$this->tool_used] ?? '🛠️';
    }
}
