<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuditLog\AuditLogIndexRequest;
use App\Services\AuditLogs\AuditLogService;

class AuditLogController extends Controller
{
    protected $auditLogService;

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }

    public function index(AuditLogIndexRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $workspace = $user->workspaces()->first();
        $filters = $request->validated();
        $startDate = $filters['start_date'];
        $endDate = $filters['end_date'];

        if ($request->wantsExport()) {
            return $this->auditLogService->exportCsv($workspace, $startDate, $endDate);
        }

        $logs = $this->auditLogService->getLogsPaginated($workspace, $startDate, $endDate);

        return view('pages.logs.index', compact('user', 'workspace', 'logs', 'startDate', 'endDate'));
    }
}
