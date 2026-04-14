<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpcomingProject extends Model
{
    protected $fillable = [
        'title',
        'description',
        'tech_stack',
        'progress_percentage',
        'expected_completion',
        'status',
        'current_phase',
        'milestones',
        'is_active'
    ];

    protected $casts = [
        'expected_completion' => 'date',
        'milestones' => 'array',
        'is_active' => 'boolean'
    ];

    // Simple helper methods
    public function getTechStackArrayAttribute()
    {
        return explode(',', $this->tech_stack);
    }

    public function getProgressColorAttribute()
    {
        if ($this->progress_percentage >= 80) return 'success';
        if ($this->progress_percentage >= 50) return 'warning';
        if ($this->progress_percentage >= 25) return 'info';
        return 'danger';
    }
}
