<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ClearUserOnlineStatus
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        if ($event->user) {
            $userId = $event->user->id;
            $userName = $event->user->name;

            // Hapus cache online status
            Cache::forget('user-is-online-' . $userId);
            Cache::forget('user-last-seen-updated-' . $userId);

            // Update last_seen ke waktu logout
            $event->user->update(['last_seen' => now()]);

            // Log untuk debugging
            Log::info("User logged out - Status cleared: {$userName} (ID: {$userId})");
        }
    }
}
