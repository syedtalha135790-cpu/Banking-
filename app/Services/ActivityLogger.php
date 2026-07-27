<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    /**
     * Record dynamic activity log entry.
     */
    public static function log($action, $module, $description, $userId = null, $status = 'success')
    {
        try {
            $agent = Request::header('User-Agent') ?? '';
            
            $os = self::getOS($agent);
            $browser = self::getBrowser($agent);
            $device = self::getDevice($agent);

            return ActivityLog::create([
                'user_id' => $userId ?? Auth::id(),
                'action' => $action,
                'module' => $module,
                'description' => $description,
                'ip_address' => Request::ip(),
                'browser' => $browser,
                'device' => $device,
                'operating_system' => $os,
                'status' => $status,
            ]);
        } catch (\Exception $e) {
            // Silence logger errors to prevent blocking transaction commits
            \Illuminate\Support\Facades\Log::error("Failed to write activity log: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Extract Operating System from agent string.
     */
    private static function getOS($agent)
    {
        if (preg_match('/windows|win32/i', $agent)) return 'Windows';
        if (preg_match('/macintosh|mac os x/i', $agent)) return 'macOS';
        if (preg_match('/linux/i', $agent)) return 'Linux';
        if (preg_match('/iphone|ipad/i', $agent)) return 'iOS';
        if (preg_match('/android/i', $agent)) return 'Android';
        return 'Unknown OS';
    }

    /**
     * Extract Browser name from agent string.
     */
    private static function getBrowser($agent)
    {
        if (preg_match('/edg/i', $agent)) return 'Edge';
        if (preg_match('/chrome/i', $agent)) return 'Chrome';
        if (preg_match('/firefox/i', $agent)) return 'Firefox';
        if (preg_match('/safari/i', $agent)) return 'Safari';
        if (preg_match('/opera|opr/i', $agent)) return 'Opera';
        return 'Unknown Browser';
    }

    /**
     * Extract Device type from agent string.
     */
    private static function getDevice($agent)
    {
        if (preg_match('/ipad/i', $agent)) return 'Tablet';
        if (preg_match('/mobile|iphone|android/i', $agent)) return 'Mobile';
        return 'Desktop';
    }
}
