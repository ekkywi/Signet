<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\License\OfflineLicenseRequest;
use App\Services\Licenses\OfflineLicenseService;
use Exception;

class OfflineLicenseController extends Controller
{
    protected OfflineLicenseService $offlineLicenseService;

    public function __construct(OfflineLicenseService $offlineLicenseService)
    {
        $this->offlineLicenseService = $offlineLicenseService;
    }

    public function index()
    {
        return view('pages.offline-licenses.index');
    }

    public function store(OfflineLicenseRequest $request)
    {
        try {
            $validated = $request->validated();

            $result = $this->offlineLicenseService->generate(
                $validated['license_key'],
                $validated['hardware_id']
            );

            return response()->streamDownload(function () use ($result) {
                echo $result['fileData'];
            }, $result['fileName'], [
                'Content-Type' => 'application/json',
                'Content-Disposition' => 'attachment; filename="' . $result['fileName'] . '"',
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['hardware_id' => $e->getMessage()])->withInput();
        }
    }
}
