<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastSeen
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $userName = Auth::user()->name;
            $expiresAt = now()->addMinutes(5);

            // Set cache untuk online status
            Cache::put('user-is-online-' . $userId, true, $expiresAt);

            // Log - HAPUS SETELAH TESTING
            Log::info("UpdateLastSeen: {$userName} (ID: {$userId}) accessed {$request->path()}");

            // Update last_seen di database setiap 2 menit
            if (!Cache::has('user-last-seen-updated-' . $userId)) {
                Auth::user()->update(['last_seen' => now()]);
                Cache::put('user-last-seen-updated-' . $userId, true, now()->addMinutes(2));

                Log::info("UpdateLastSeen: {$userName} last_seen updated to " . now());
            }
        }

        return $next($request);
    }
}
