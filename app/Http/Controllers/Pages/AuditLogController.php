<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        $isSuperAdmin = method_exists($user, 'roles') && $user->roles->contains('name', 'super-admin');

        if ($isSuperAdmin) {
            return redirect()->route('admin.workspaces.index')
                ->with('info', 'You are logged in as Super Admin. Select a Client Workspace from this list and then use the "Login As" feature or settings menu to view their logs.');
        }

        $workspace = $user->workspaces()->first();

        if (!$workspace) {
            return view('pages.logs.index', [
                'logs'          => collect(),
                'hasWorkspace'  => false,
                'startDate'     => null,
                'endDate'       => null,
            ]);
        }

        $filters = $request->validated();

        $startDate = $filters['start_date'] ?? now()->subDays(7)->format('Y-m-d');
        $endDate = $filters['end_date'] ?? now()->format('Y-m-d');

        $isExport = method_exists($request, 'wantsExport') ? $request->wantsExport() : $request->has('export');

        if ($isExport) {
            return $this->auditLogService->exportCsv($workspace, $startDate, $endDate);
        }

        $logs = $this->auditLogService->getLogsPaginated($workspace, $startDate, $endDate);

        return view('pages.logs.index', compact('user', 'workspace', 'logs', 'startDate', 'endDate') + [
            'hasWorkspace' => true
        ]);
    }
}
