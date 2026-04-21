<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Workspace;
use App\Models\License;
use App\Models\SubscriptionPlan;
use App\Http\Requests\Admin\UpdateWorkspacePlanRequest;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::with(['user', 'products', 'licenses'])->latest()->paginate(20);
        return view('admin.workspaces.index', compact('workspaces'));
    }

    public function show(Workspace $workspace)
    {
        $workspace->load('subscriptionPlan');
        $productsCount = Product::where('workspace_id', $workspace->id)->count();
        $licensesCount = License::where('workspace_id', $workspace->id)->count();
        $plans = SubscriptionPlan::all();

        return view('admin.workspaces.show', compact('workspace', 'productsCount', 'licensesCount', 'plans'));
    }

    public function changePlan(UpdateWorkspacePlanRequest $request, Workspace $workspace)
    {
        $validatedData = $request->validated();

        $workspace->update([
            'subscription_plan_id' => $validatedData['subscription_plan_id'],
        ]);

        return back()->with('success', 'Workspace subscription plan updated successfully.');
    }
}
