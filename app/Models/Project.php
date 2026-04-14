<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'tech_stack',
        'github_link',
        'live_link',
        'image',
        'features',
        'sort_order',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Simple helper methods
    public function getTechStackArrayAttribute()
    {
        return explode(',', $this->tech_stack);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('uploads/projects/' . $this->image) : null;
    }
}
