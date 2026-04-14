<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'page',
        'visited_at'
    ];

    protected $casts = [
        'visited_at' => 'datetime'
    ];

    // Get total visits count
    public static function getTotalVisits()
    {
        return static::count();
    }

    // Get unique visitors count
    public static function getUniqueVisitors()
    {
        return static::distinct('ip_address')->count();
    }

    // Get today's visits
    public static function getTodayVisits()
    {
        return static::whereDate('visited_at', today())->count();
    }

    // Get this month's visits
    public static function getMonthlyVisits()
    {
        return static::whereMonth('visited_at', now()->month)
                    ->whereYear('visited_at', now()->year)
                    ->count();
    }
}
