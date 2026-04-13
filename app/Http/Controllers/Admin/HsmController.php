<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHsmNodeRequest;
use App\Http\Requests\Admin\UpdateHsmNodeRequest;
use App\Models\HsmNode;
use App\Services\Admin\Hsm\HsmNodeService;
use Illuminate\Http\Request;

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

        return back()->with('enroll_command', $command)->with('success', "Node {$nodeName} registered! Please run the command above on your host machine.");
    }

    public function update(UpdateHsmNodeRequest $request, HsmNode $hsmNode)
    {
        $this->hsmNodeService->update($hsmNode, $request->validated());
        return back()->with('success', "Node {$hsmNode->name} updated successfully.");
    }

    public function destroy(HsmNode $hsmNode)
    {
        $name = $hsmNode->name;

        $this->hsmNodeService->deleteNode($hsmNode);

        return back()->with('success', "Node {$name} has been deleted permanently.");
    }

    public function sendCommand(Request $request, HsmNode $hsmNode)
    {
        $request->validate([
            'command' => ['required', 'string']
        ]);
    }
}
