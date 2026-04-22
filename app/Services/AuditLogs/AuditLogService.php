<?php

namespace App\Services\AuditLogs;

use App\Models\AuditLog;
use App\Models\Workspace;

class AuditLogService
{
    public function getLogsPaginated(Workspace $workspace, string $startDate, string $endDate)
    {
        return AuditLog::where('workspace_id', $workspace->id)
            ->where('is_system_action', false)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->with(['auditable', 'user'])
            ->latest()
            ->paginate(20)
            ->appends([
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
    }

    public function exportCsv(Workspace $workspace, string $startDate, string $endDate)
    {
        $logs = AuditLog::where('workspace_id', $workspace->id)
            ->where('is_system_action', false)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->with('auditable', 'user')
            ->latest()
            ->get();
        $filename = "signet_audit_logs_{$startDate}_to_{$endDate}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
        $columns = ['Timestamp', 'Action', 'Target Type', 'Target Name', 'Target ID', 'Actor'];
        $callback = function () use ($logs, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($logs as $log) {
                $actorName = $log->user ? $log->user->name : 'System';
                fputcsv($file, [
                    $log->created_at->format('Y-m-d H:i:s'),
                    strtoupper($log->action),
                    class_basename($log->auditable_type),
                    $log->target_name,
                    $log->auditable_id,
                    $actorName,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
