<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'action',
    'module',
    'description',
    'ip_address',
    'browser',
    'device',
    'operating_system',
    'status'
])]
class ActivityLog extends Model
{
    /**
     * Enforce log immutability by blocking updates and deletions.
     */
    protected static function booted()
    {
        static::updating(function ($log) {
            return false; // Prevent update
        });

        static::deleting(function ($log) {
            return false; // Prevent delete
        });
    }

    /**
     * Get user associated with the activity log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
