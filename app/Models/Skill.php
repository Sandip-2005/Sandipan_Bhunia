<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'category',
        'proficiency_level',
        'icon',
        'description',
        'experience_text',
        'projects_text',
        'sort_order',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Simple helper methods
    public function getProficiencyStarsAttribute()
    {
        return str_repeat('★', $this->proficiency_level) . str_repeat('☆', 5 - $this->proficiency_level);
    }

    public function getProficiencyPercentageAttribute()
    {
        return ($this->proficiency_level / 5) * 100;
    }
}
