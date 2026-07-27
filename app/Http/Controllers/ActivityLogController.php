<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityLogController extends Controller
{
    /**
     * Display activity log ledger dashboard.
     */
    public function index(Request $request)
    {
        $query = ActivityLog::with('user');

        // Search description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%");
            });
        }

        // Filter by Module
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by Date
        if ($request->filled('date')) {
            $query->whereDate('created_at', Carbon::parse($request->date));
        }

        // Statistics
        $totalLogs = ActivityLog::count();
        $loginsToday = ActivityLog::where('action', 'login')
            ->whereDate('created_at', Carbon::today())
            ->count();
        $adminActions = ActivityLog::where('module', 'admin')->count();

        $logs = $query->orderBy('id', 'desc')->paginate(15)->withQueryString();

        return view('admin.activity_logs.index', compact('logs', 'totalLogs', 'loginsToday', 'adminActions'));
    }

    /**
     * Display a specific activity log payload details.
     */
    public function show($id)
    {
        $log = ActivityLog::with('user')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $log->id,
                'user' => $log->user->name ?? 'System Guest / Unknown',
                'action' => ucfirst(str_replace('_', ' ', $log->action)),
                'module' => ucfirst($log->module),
                'description' => $log->description,
                'ip_address' => $log->ip_address,
                'browser' => $log->browser,
                'device' => $log->device,
                'operating_system' => $log->operating_system,
                'status' => strtoupper($log->status),
                'created_at' => $log->created_at->toDateTimeString(),
            ]
        ]);
    }

    /**
     * Stream CSV log export.
     */
    public function exportCsv(Request $request)
    {
        $query = ActivityLog::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%");
            });
        }

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', Carbon::parse($request->date));
        }

        $logs = $query->orderBy('id', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="system_activity_logs_' . date('Ymd_His') . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            
            // CSV Header row
            fputcsv($file, [
                'Log ID', 'User Name', 'Action', 'Module', 'Description', 
                'IP Address', 'Browser', 'Device', 'OS', 'Status', 'Timestamp'
            ]);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->user->name ?? 'Guest',
                    $log->action,
                    $log->module,
                    $log->description,
                    $log->ip_address,
                    $log->browser,
                    $log->device,
                    $log->operating_system,
                    $log->status,
                    $log->created_at->toDateTimeString()
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
