<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track visits to the main portfolio page
        if ($request->is('/') || $request->is('home')) {
            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();
            $page = $request->path();

            // Check if this IP has visited in the last hour to avoid spam
            $recentVisit = Visit::where('ip_address', $ipAddress)
                               ->where('visited_at', '>', now()->subHour())
                               ->first();

            if (!$recentVisit) {
                Visit::create([
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                    'page' => $page,
                    'visited_at' => now()
                ]);
            }
        }

        return $next($request);
    }
}
