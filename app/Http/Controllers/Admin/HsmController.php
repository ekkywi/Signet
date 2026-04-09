<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHsmNodeRequest;
use App\Models\HsmNode;
use App\Services\Admin\Hsm\HsmNodeService;

class HsmController extends Controller
{
    public function __construct(
        protected HsmNodeService $hsmNodeService
    ) {}

    public function index()
    {
        $nodes = HsmNode::orderBy('name')->get();
        return view('admin.hsm.index', compact('nodes'));
    }

    public function store(StoreHsmNodeRequest $request)
    {
        $result = $this->hsmNodeService->registerNode($request->validated());
        $nodeName = $result['node']->name;
        $command = "docker exec -it signet-hsm-bridge node enroll.js {$result['enrollment_token']}";

        return back()->with('enroll_command', $command)->with('success', "Node {$nodeName} registered! Please run the command below on your host machine.");
    }
}
